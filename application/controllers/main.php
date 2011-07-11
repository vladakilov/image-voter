<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

  var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

  public function index()
  {
    $db = $this->mongo->images_test->getGridFS();
    $users = $db->find();
    $data = array(
      'documents' => array(),
      'username' => $this->session->userdata('username'),
      'logged_in' => $this->session->userdata('logged_in')
      );
    
    // While we have results
    while($users->hasNext())
    {
      // Get the next result
      $documents = $users->getNext();
      
      //Checking to see if the user has already voted up on a particular post
      if(in_array($this->session->userdata('username'), $documents->file['likes']['up_votes']))
      {
        $already_voted_up = true;
      }
      else
      {
        $already_voted_up = false;
      }
      
      //Checking to see if the user has already voted down on a particular post
      if(in_array($this->session->userdata('username'), $documents->file['likes']['down_votes']))
      {
        $already_voted_down = true;
      }
      else
      {
        $already_voted_down = false;
      }
      
      //Sending variables to the view
      $data['documents'][] = array(
        '_id' => $documents->file['_id'],
        'already_voted_up' => $already_voted_up,
        'already_voted_down' => $already_voted_down,
        'up_votes' => count($documents->file['likes']['up_votes']),
        'down_votes' => count($documents->file['likes']['down_votes']),
        'tags' => $documents->file['tags'],
        'submitted_by' => $documents->file['submitted_by']
        );
    }
    
      $this->load->view('default/header');
      $this->load->view('default/form');
      $this->load->view('main/content', $data);
      $this->load->view('default/footer');
  }

  public function image($id)
  {
    $db = $this->mongo->images_test->getGridFS();
    $image = $db->findOne(array('_id' => new MongoId($id)));
    // Stream image to browser
    header('Content-type: image/jpeg');
    echo $image->getBytes();
  }
  
  // Doesn't really work yet
  public function login()
  {
    $this->load->view('main/login');
  }
  
  //works but is now implemented in ajax controller
  public function logout()
  {
    $this->session->sess_destroy(); // Destroy session
    redirect(base_url(), 'refresh');
  }
  
}
