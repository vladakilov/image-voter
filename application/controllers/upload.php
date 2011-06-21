<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

	public function index()
	{
		$this->load->helper('form');
		$logged_in = $this->session->userdata('logged_in');
		if ($logged_in)
		{
			$data = array('username' => $this->session->userdata('username'));
      $this->load->view('upload/asset', $data);
		}
		else
		{
			redirect('/', 'refresh');
		}  
	}
	
	public function do_upload()
	{
		$username = $this->input->post('username');
		$description = $this->input->post('description');		
		
    if (is_uploaded_file($_FILES['file']['tmp_name']))
    {
	    $grid = $this->mongo->images_test->getGridFS();
      $id = $grid->storeUpload('file');
      echo $id;
      $grid->update(array('_id' => $id), 
                    array('$set' => array('submitted_by' => $username, 'description' => $description,
                    'tags' => array(), 'likes' => array('up_votes' => '', 'down_votes' => ''))));
    }
	}
	
}
