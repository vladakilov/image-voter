<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asset extends CI_Controller {

	var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

	public function index($id)
	{
    $db = $this->mongo->images_test->getGridFS();
  	$image = $db->findOne(array('_id' => new MongoId($id)));

    if ($image)
    {
      $data = array(
		  '_id' => $image->file['_id'],
	    'likes' => $image->file['likes'],
	    'submitted_by' => $image->file['submitted_by'],
	    'description' => $image->file['description'],
	    'tags' => $image->file['tags'],
	    'uploadDate' => $image->file['uploadDate']
	
		  );
		$this->load->view('asset/index', $data);
	  }
    else
    {
      echo 'Load 404 error';
    }

	}
}
