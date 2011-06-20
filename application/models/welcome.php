<?php
class Welcome extends CI_Model {

	var $mongo = '';
  function connect_db(){
	$this->mongo = new Mongo();
	return $this->mongo->test->users->find();
}  
}