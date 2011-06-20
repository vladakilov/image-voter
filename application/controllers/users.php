<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

	public function index($id)
	{
		$this->load->helper('url');
    $db = $this->mongo->test_app->users;
  	$users = $db->findOne(array('login' => $id));
    $data = array('users' => $users);
		$this->load->view('users/main', $data);		
		//$this->output->set_output($output);
	}
	
}
