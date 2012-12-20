<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
	
		# Instantiate User class
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();			
							
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
		
# ====== ADDITION TO BASE ======= v
		# Build an associative array of links and their urls
		$navigation = Array(
			"bespoke"		=> "/bespoke",
			"prototypes"	=> "/prototypes",
			"philosophy"	=> "/philosophy",
			"Æsthetic"		=> "/aesthetic",
			"connect"		=> "/connect",
			"about this project"	=> "/about",
		);

		$manage_nav = Array(
			"manage index"	=> "/manage",
			"product"		=> "/manage/product",
			"add"			=> "/manage/addproduct",
			"edit"			=> "/manage/editproduct",
		);
			
		# Pass navigation array to the template.
		$this->template->navigation = $navigation;
		$this->template->manage_nav = $manage_nav;  

# ====== ADDITION TO BASE ======= ^
			
	}
	
} # eoc
