<?php
class shop_controller extends base_controller	{

	public function __construct() {
		parent::__construct();
		
		# To make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a> or <a href='/users/signup'>Signup</a>");
		}

	} // end __construct	
	
	
	public function news() {
		
	} // end of news fct
	
	
} // end of the class

?>