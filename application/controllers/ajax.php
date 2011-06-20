<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends App_controller {

	public function index()
	{
		if (isset($_POST['imageID'])):
		      $gridfs->update(array('_id' => new MongoId($_POST['imageID'])), 
			                  array('$push' => array('likes.' . $_POST['voteType'] . '_votes' => $_POST['userID'])));
		endif;
	}
	
}
