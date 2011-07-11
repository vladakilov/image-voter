<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    
    var $mongo;
    var $logged_in;

    function __construct() {
        parent::__construct();
        $this->mongo = new Mongo();
        $this->logged_in = $this->session->userdata('logged_in');
    }

    public function index() 
    {
        
    }

    // Ajax call to login user
    public function login()
    {
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');    
        $email = $this->input->post('email');    
            
        $user = $this->mongo->test_app->users->findOne(array('username' => $username, 'password' => md5($password)));
        if(!$user)
        {
            echo 'Wrong username or password';
        }
        else
        {
            $session_data = array(
                'username'  => $username,
                'logged_in' => TRUE
                );
            $this->session->set_userdata($session_data);
            redirect('/', 'refresh');
        }
    }
    
    // Ajax call to logout current user
    public function logout()
    {
        $this->session->sess_destroy(); // Destroy session
        redirect('/', 'refresh');
    }
    
    // Ajax call to register a new user to the app
    public function register()
    {
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        
        // Check db if username already exists
        $query = $this->mongo->test_app->users->findOne(array('username' => $username));
        if ($query)
        {
            echo 'The username ' . $username . " is taken!";
        }
        else
        {
            $this->mongo->test_app->users->insert(array('username' => trim($username), 
                'password' => md5($password),
                'email' => $email,
                'image_votes' => array(),
                'images_uploaded' => array(), 
                'created' => new MongoDate()
                ));
            $session_data = array(
                'username'  => $username,
                'logged_in' => TRUE
                );
            $this->session->set_userdata($session_data);
        }
    }
    
		/**
		 * This function is called when a user has voting on a particular post.
		 * It returns a string to the ajax response
     *
		 * @return string
		 */
    public function vote()
    {
        if ($this->logged_in)
        {
            $_id = $this->input->post('_id');
            $vote_type = $this->input->post('vote_type');
            $username = $this->session->userdata('username');
            $gridfs = $this->mongo->images_test->getGridFS();
            
            // String must be either up or down, otherwise new document is
            // created in db, must be a better way of doing this.
            if($vote_type === 'up' or $vote_type === 'down'){
                
                $opposite_vote = ($vote_type === 'up') ? 'down' : 'up';
                
                $entry_exists = $gridfs->findOne(array('_id' => new MongoId($_id),
                    'likes.' . $vote_type . '_votes' => $username)); 
            
                // If user didn't already vote on post
                if(!$entry_exists)
                {
                    // Add meta data in image collection that user just voted
                    $gridfs->update(array('_id' => new MongoId($_id)), 
                        array('$push' => array('likes.' . $vote_type . '_votes' => $username)));
                
                    // Add meta data to user collection that user just voted on image
                    $this->mongo->test_app->users->update(array('username' => $username),
                        array('$push' => array('image_votes' => array('up' => $_id))));
                    
                    // Remove meta data in image collection that user removed voted    
                    $gridfs->update(array('_id' => new MongoId($_id)), 
                        array('$pop' => array('likes.' . $opposite_vote . '_votes' => $username)));
                        
                    // Remove meta data in user collection that user removed voted
                    $this->mongo->test_app->users->update(array('username' => $username),
                        array('$pop' => array('image_votes' => $opposite_vote.'_'.$_id)));
                  
                    // Return 'vote' to js response
                    echo 'vote';
                }
                else
                {
                    // Update meta data in image collection that user removed voted
                    $gridfs->update(array('_id' => new MongoId($_id)), 
                        array('$pop' => array('likes.' . $vote_type . '_votes' => $username)));
                        
                    // Update user collection that user removed vote
                    $this->mongo->test_app->users->update(array('username' => $username),
                        array('$pop' => array('image_votes' => $vote_type.'_'.$_id)));
                
                    // Return 'remove_vote' to js response
                    echo 'remove_vote';
                }
                
            }
            else
            {
                exit;
            }
            
        }
        else
        {
            echo 'login';
        }
    }
        
}
