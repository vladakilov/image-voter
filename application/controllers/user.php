<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

	public function index($username)
	{
    $db = $this->mongo->images_test->getGridFS();
  	$image = $db->findOne(array('submitted_by' => $username));
    $user = $this->mongo->test_app->users->findOne(array('username' => $username));
    if ($user)
    {
      $data['image_data'] = array('image' => $image);
      $data['user_data'] = array('user' => $user);

			$this->load->view('user/main', $data);
    }
    else
    {
      echo 'Load 404 error';
    }
	}
	
}
