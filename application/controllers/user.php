<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

  var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

  /**
   * Single user page get general info about user
   * Returns an array to the view with user_data and image_data
   *
   * @param string $username
   *
   * @return array $data
   */
  public function index($username)
  {
    $username = (isset($username))?$username:null;
    $image_data = $this->mongo->images_test->getGridFS()->findOne(array('submitted_by' => $username));
    $user_data = $this->mongo->test_app->users->findOne(array('username' => $username));
    $logged_in = $this->session->userdata('logged_in');
    $username = $this->session->userdata('username');
    if ($user_data)
    {
      $data = array(
        'image_data' => array($image_data),
        'user_data' => array($user_data),
        'username' => $username,
        'logged_in' => $logged_in
      );
      
      $this->load->view('default/header');
      $this->load->view('user/main', $data);
      $this->load->view('default/footer');
      
    }
    else
    {
      echo 'Load 404 error';
    }
  }
  
  
  /**
   * Get all items 'liked' by user
   * Returns an array to the view with content
   *
   * @param string $user
   *
   * @return array $data
   */
  public function liked()
  {
		$user = $this->uri->segment(2, 0);;
  }

  /**
   * Get all items 'disliked' by user
   * Returns an array to the view with content
   *
   * @param string $user
   *
   * @return array $data
   */
  public function disliked()
  {
		$user = $this->uri->segment(2, 0);;
  }

  
}
