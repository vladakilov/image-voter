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
		$this->load->view('upload/asset');
	}
	
	public function do_upload()
	{		
    if (is_uploaded_file($_FILES['file']['tmp_name']))
    {
	    $grid = $this->mongo->images_test->getGridFS();
      $id = $grid->storeUpload('file');
      echo $id;
      $grid->update(array('_id' => $id), 
                    array('$set' => array('submitted_by' => 'submitters name', 'description' => 'A brief description of the image',
                    'tags' => array(), 'likes' => array('up_votes' => '', 'down_votes' => ''))));
    }
	}
	
}
