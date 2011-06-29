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
			$data['documents'][] = array(
				'_id' => $documents->file['_id'],
				'up_votes' => count($documents->file['likes']['up_votes']),
				'down_votes' => count($documents->file['likes']['down_votes']),
				'tags' => $documents->file['tags'],
				'submitted_by' => $documents->file['submitted_by']
				);
		}
		
		$logged_in = $this->session->userdata('logged_in');
		if ($logged_in)
		{
			$this->load->view('main/header');
			$this->load->view('main/content', $data);
		}
		else
		{
			$this->load->view('main/header');
			$this->load->view('main/form');
			$this->load->view('main/content', $data);
		}
	}

	public function image($id)
	{
		$db = $this->mongo->images_test->getGridFS();
		$image = $db->findOne(array('_id' => new MongoId($id)));
		$photo = array('photo' => $image);
		$this->load->view('main/photo', $photo);
	}
	
	public function login()
	{
		$this->load->view('main/login');
	}
	
	public function logout()
	{
		$this->session->sess_destroy(); // Destroy session
		redirect(base_url(), 'refresh');
	}
	
}
