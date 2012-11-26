<?php
class dmg_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
		echo "dmg_controller construct called<br><br>";
	}
	
	public function index() {
		echo "Welcome to dmg";
	}
	
	public function signup() {
		echo "This is the signup page";
	}

	public function login() {
		echo "This is the login page";
	}

	public function logout() {
		echo "This is the logout page";
	}	
		
	public function profile($user_name = NULL)
		
} // end of dmg class