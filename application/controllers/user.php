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
  	$user = $db->findOne(array('submitted_by' => $username));
    if ($user)
    {
      $data = array('user' => $user);
			$this->load->view('user/main', $data);
    }
    else
    {
      echo 'Load 404 error';
    }
	}
	
}
