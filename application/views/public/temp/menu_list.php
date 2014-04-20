<?php
//open login form
	echo form_open('site/validasi');
		$username = array('name' => 'username', 'type' => 'text', 'value' => 'admin');
		echo form_input($username);
		
		$password = array('name' => 'password', 'type' => 'password', 'value' => 'admin');
		echo form_password($password);
	
		$subkan = array('type' => 'submit', 'name' => 'submit', 'value' => 'Login');
		echo form_submit($subkan);
		
	echo form_close();
//close login form
?>
