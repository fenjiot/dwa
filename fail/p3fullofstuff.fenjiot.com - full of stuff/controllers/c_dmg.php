<?php

#	Taken from p2.fenjiot.com c_users
#	Fix and expand
#	Well you might actually want to use it for p4
#	
#
#

class dmg_controller extends base_controller {
	
	public function __contstruct() {
		parent::__construct();
		echo "dmg_controller construct called <br><br>";
	
	} // end __construct
	
	
	public function index() {

		Router::redirect("/");
	
	} // end index fct
	
	
} // end of the class

