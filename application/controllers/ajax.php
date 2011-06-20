<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

	public function index() 
	{

	}
	
	public function login()
	{
		echo 'test';
    $user = $this->mongo->test_app->users->findOne(array('login' => md5($_POST['login'])));
    if(!$user)
    {
      echo 'Wrong username or password';
    }
    else
    {
      echo '//create session for user';
    }
	}
	
	public function register()
	{
    if (isset($_POST['register']))
    {
      $username = $this->mongo->test_app->users->findOne(array('username' => $_POST['username']));
      if ($username)
      {
        echo 'The username ' . $_POST['username'] . " is taken!";
      }
      else
      {
        $this->mongo->test_app->users->insert(array('username' => $_POST['username'], 'password' => md5($_POST['password'])));
        //create session for new user
      }
    }
    else
    {
	    echo 'redirect to homepage';
    }
	}
	
}
