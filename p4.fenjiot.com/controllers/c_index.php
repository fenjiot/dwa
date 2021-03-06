<?php

class index_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	/*-------------------------------------------------------------------------------------------------
	Access via http://yourapp.com/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
		$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
		$this->template->title = "Home";
	
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
		$client_files = Array(
					"/js/responsiveslides.min.js",
					"/js/responsive-slides.js",
					"/css/responsive-slides.css",
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);   
	      		
		# Render the view
		echo $this->template;

	}	
	public function about() {
	
		# Setup view
		$this->template->content 	= View::instance('v_index_about');
		$this->template->title		= "About Project";
		
		# Render template
		echo $this->template;

	} // end of about fct
	
	public function bespoke() {
	
		# Setup view
		$this->template->content 	= View::instance('v_index_bespoke');
		$this->template->title		= "Bespoke";
		
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
		$client_files = Array(
					""
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);
	
		# Render template
		echo $this->template;

	} // end of bespoke fct
	
	public function philosophy() {
	
		# Setup view
		$this->template->content 	= View::instance('v_index_philosophy');
		$this->template->title		= "Philosophy";
		
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
		$client_files = Array(
					""
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);
	
		# Render template
		echo $this->template;

	} // end of bespoke fct
	
	public function aesthetic() {
	
		# Setup view
		$this->template->content 	= View::instance('v_index_aesthetic');
		$this->template->title		= "Æsthetic";
		
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
		$client_files = Array(
					""
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);
		
		# Render template
		echo $this->template;

	} // end of bespoke fct
	
	public function connect_() {
	
		# Setup view
		$this->template->content 	= View::instance('v_index_connect');
		$this->template->title		= "Connect";
		
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
			$client_files = Array(
						""
	                    );
	    
	    	$this->template->client_files = Utils::load_client_files($client_files);
		
		# Render template
		echo $this->template;

	} // end of bespoke fct
	
	public function raerden() {
	
		# Setup view
		$this->template->content 	= View::instance('v_index_raerden');
		$this->template->title		= "Project -- Raerden";
		
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
		$client_files = Array(
					"/js/responsiveslides.min.js",
					"/js/responsive-slides.js",
					"/css/responsive-slides.css",
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);
	
		# Render template
		echo $this->template;

	} // end of raerden fct
	
	
		
} // end class
