<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_controller extends CI_Controller {

	var $mongo;

  function __construct() {
    parent::__construct();  
    $this->mongo = new Mongo();
  }

}
