<?php
	class javascript_controller extends base_controller {

		public function __construct() {
			parent::__construct();
		}

		public function class1() {
		
			$this->template->content 	= View::instance("v_javascript_class1");
			$this->template->title		= "Class1 notes";
			
			$client_files = Array(
				"/js/class1.js");
				
			# Render the view
			echo $this->template;
		}
		
	}

?>