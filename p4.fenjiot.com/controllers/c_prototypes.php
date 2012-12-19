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
					""
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);   
    
    
# MAKE IT FIT vvvvvvv  thinl about creating a library function for this.... 	
    	# Build our qurey of products -- want to display all products in system
		$q = "SELECT *
			FROM products";
			
		# Execute out qurey, storing results in a variable $all_products
		$all_products = DB::instance(DB_NAME)->select_rows($q);

		# In order to query for the posts we need, we're going to need a string of user id's, separated by commas
		# To create this, loop through our connections array
		$all_products_string = ""; // empty at first
		
		foreach($all_products as $key => $product) {
			$all_products_string .= $product['product_id'] . ",";
		}

		# Added to fix error that arises when following no one
		# This avoids the issue later with having nothing in the '$q = "SELECT * ... IN ()";' syntax error with the empty ()
		if($all_products_string == "") {
			# If $connections_string is empty (i.e. when the user isn't following anyone) set to user_id_followed 0
			$all_products_string = "0,";	
		}
		
		# Remove final comma in $connections_string
		$all_products_string = substr($all_products_string, 0, -1);

		# Selecting specific information we want $post to contain later on 
		# We don't want to pass token, user.password, user.created, user.modified, etc
		# Using DB table: posts AS p, users AS u		
		$select = "p.product_id, p.created, p.modified, p.user_id, 
				p.product_name, p.product_category, p.product_description, 
				p.product_story, p.material_name, p.material_color, 
				p.material_description, i.image_id, i.product_id, i.image_name, 
				i.image_path";
		
		# Now build our query to grab the posts
		$q = "SELECT " . $select . "
			FROM products AS p
			JOIN images AS i USING (product_id)
			WHERE p.product_id IN (" . $all_products_string . ")"; // this is where we're using the string of product_ids we created

		# Run our query and store the results in the variable $posts
		$products = DB::instance(DB_NAME)->select_rows($q);
// NOTE: THIS IS ONLY RETURNING PRODUCTS WITH IMAGES CONNECTED TO THEM DUE TO THE $q ABOVE
	
		# Pass the data to the view
		$this->template->content->products 	= $products;
# MAKE IT FIT ^^^^^^^		
		
    	
    	# Build subnavigation
    	$navigation = Array(
			"posts"    => "/posts/",
			"add post" => "/posts/add/",
			"logout"   => "/users/logout/",
		);
					
		# Pass that array to the template.
		$this->template->navigation = $navigation;	
	      		
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
