<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

	public function index()
	{
		$this->load->helper('url');
    $db = $this->mongo->images_test->getGridFS();
  	$users = $db->find();
    $data = array(
		 'documents' => array()
		 );
		 // While we have results
		 while($users->hasNext())
		 {
		   // Get the next result
		   $documents = $users->getNext();
		   $data['documents'][] = array(
			 '_id'      => $documents->file['_id'],
		   'image_id' => $documents->file['image_id'],
		   'likes'    => $documents->file['likes'],
		   'md5'      => $documents->file['md5']
		   );
		 }
		$output  = $this->load->view('main/header', $data, true);
		$output .= $this->load->view('main/content', $data, true);
		
		$this->output->set_output($output);
	}

	public function image($id)
	{
		$this->load->helper('url');
    $db = $this->mongo->images_test->getGridFS();
  	$image = $db->findOne(array('md5' => $id));
    $photo = array('photo' => $image);
		$this->load->view('main/photo', $photo);
	}
	
	public function login()
	{
		$this->load->view('main/login');
	}
	
	public function logout()
	{
    //Logout functionality goes here
	}
	
}
