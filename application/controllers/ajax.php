<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	var $mongo;

  function __construct() {
    parent::__construct();
		$this->load->library('session');
    $this->mongo = new Mongo();
  }

	public function index() 
	{

	}
	
	public function login()
	{
		$username = $this->input->post('username');
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
			//redirect to home page
    }
	}
	
	public function register()
	{
	  $username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		
	  $query = $this->mongo->test_app->users->findOne(array('username' => $username));
	  if ($query)
	  {
	    echo 'The username ' . $username . " is taken!";
	  }
	  else
	  {
	    $this->mongo->test_app->users->insert(array('username' => $username, 'password' => md5($password), 'email' => $email));
	    $session_data = array(
		                  'username'  => $username,
		                  'logged_in' => TRUE
		                  );
		$this->session->set_userdata($session_data);
		//redirect to home page
	   }
  }


  public function vote()
  {
	  $_id = $this->input->post('_id');
		$username = $this->input->post('username');
		$vote_type = $this->input->post('vote_type');
		
    $gridfs->update(array('_id' => new MongoId($_id)), 
	                  array('$push' => array('likes.' . $vote_type . '_votes' => $username)));
  }

	
	
}
