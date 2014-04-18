<?php

/**
 *
 */
class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('musers');
	}

	function index() {
		$this -> load -> view('teskombo');
	}

	function read() {
		echo json_encode($this -> musers -> getAll());
	}

	function create() {
		if (!empty($_POST)) {
			echo $this -> musers -> create();
			//echo 'New user created successfully!';
		}
	}

}
