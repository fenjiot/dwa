<?php
class javascripts_controller extends base_controller	{

	public function __construct() {
		parent::__construct();
		

	} // end __construct


	public function lucyandricardo() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_javascripts_lucyandricardo');
		$this->template->title 		= "Lucy and Ricardo";
		
		# Load CSS / JS
		$client_files = Array(
				"/css/lucyandricardo.css",
				"/js/lucyandricardo.js",
	            );
	
        $this->template->client_files = Utils::load_client_files($client_files);
        
		# Pass data to the view

		
		# Render the view
		echo $this->template;
		
	} // end lucyandricardo fct


	public function cardgenerator() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_javascripts_cardgenerator');
		$this->template->title 		= "Card Generator";
		
		# Load CSS / JS
		$client_files = Array(
				"/css/cardgenerator.css",
				"/js/cardgenerator.js",
	            );
	
        $this->template->client_files = Utils::load_client_files($client_files);
        
		# Pass data to the view

		
		# Render the view
		echo $this->template;
		
	} // end cardgen fct
	
	
	public function memorygame() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_javascripts_memorygame');
		$this->template->title 		= "Memory Game";
		
		# Load CSS / JS
		$client_files = Array(
				"/css/memorygame.css",
				"/js/memorygame.js",
	            );
	
        $this->template->client_files = Utils::load_client_files($client_files);		
		
		# Pass data to the view

		
		# Render the view
		echo $this->template;
		
	} // end memorygame fct
	
	
	public function dmg() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_javascripts_dmg');
		$this->template->title 		= "Drink Mix Generator";
		
		# Load CSS / JS
		$client_files = Array(
				"/css/dmg.css",
				"/js/dmg.js",
	            );
	
        $this->template->client_files = Utils::load_client_files($client_files);		
		
		# Pass data to the view

		
		# Render the view
		echo $this->template;
		
	} // end dmg fct
	
	public function damage() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_javascripts_damage');
		$this->template->title 		= "Drink Mix Generator";
		
		# Load CSS / JS
		$client_files = Array(
				"/css/damage.css",
				"/js/damage.js",
	            );
	
        $this->template->client_files = Utils::load_client_files($client_files);		
		
		# Pass data to the view

		
		# Render the view
		echo $this->template;
		
	} // end dmg fct
	
	
} // end of the class

?>