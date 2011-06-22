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
		if ($this->logged_in)
		{
			$_id = $this->input->post('_id');
			$vote_type = $this->input->post('vote_type');
			$username = $this->session->userdata('username');
			
			$gridfs = $this->mongo->images_test->getGridFS();
			$gridfs->update(array('_id' => new MongoId($_id)), 
				array('$push' => array($vote_type . '_votes' => $username)));
		}
		else
		{
			echo 'You must be logged in to vote';
		}
	}

}
