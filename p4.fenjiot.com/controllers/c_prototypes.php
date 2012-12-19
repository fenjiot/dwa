<?php

class prototypes_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
		$this->template->content = View::instance('v_prototypes_index');
			
		# Now set the <title> tag
		$this->template->title = "Prototypes";
	
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
		$client_files = Array(
					"/js/prototypes.js",
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);   
	      		
		# Render the view
		echo $this->template;

	}
	
	public function product() {
	
		# Setup view
		$this->template->content 	= View::instance('v_prototypes_product');
		$this->template->title		= "name of product"; // set to var
		
		$selected_item = 0; // need to define
		
		$this->template->product	= View::instance("'v_prototypes_'".$selected_item."'");
		
		# Render template
		echo $this->template;

	} // end of about fct
		
		
} // end class
