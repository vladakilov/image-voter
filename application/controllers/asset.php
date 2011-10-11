<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asset extends CI_Controller {

  var $mongo;

  function __construct()
  {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

  public function index($id)
  {
    $db = $this->mongo->images_test->getGridFS();
    $image = $db->findOne(array('_id' => new MongoId($id)));
    $logged_in  = $this->session->userdata('logged_in');

    //Checking to see if the user has already voted up/down on a particular post
    $already_voted_up = in_array($this->session->userdata('username'), $image->file['likes']['up_votes'])?true:false;
    $already_voted_down = in_array($this->session->userdata('username'), $image->file['likes']['down_votes'])?true:false;

    if ($image)
    {
      $data = array(
        '_id' => $image->file['_id'],
        'up_votes' => count($image->file['likes']['up_votes']),
        'down_votes' => count($image->file['likes']['down_votes']),
        'already_voted_up' => $already_voted_up,
        'already_voted_down' => $already_voted_down,
        'submitted_by' => $image->file['submitted_by'],
        'description' => $image->file['description'],
        'tags' => $image->file['tags'],
        'uploadDate' => $image->file['uploadDate'],
        'username' => $this->session->userdata('username'),
        'logged_in' => $this->session->userdata('logged_in')
        );

        $this->load->view('default/header');
        $this->load->view('default/form');
        $this->load->view('asset/index', $data);
        $this->load->view('default/footer');
      }
    else
    {
      echo 'Load 404 error';
    }
  }
  
}
