<?php

class prototypes_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 	
	
	public function index() {
	
		# Setup the view
		$this->template->content	= View::instance('v_prototypes_index');
		$this->template->title		= "Prototypes";
		
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
				p.material_description, t.product_id, t.thumb_name, 
				t.thumb_path";
		
		# Now build our query to grab the posts
		$q = "SELECT " . $select . "
			FROM products AS p
			JOIN thumbs AS t USING (product_id)
			WHERE p.product_id IN (" . $all_products_string . ")"; // this is where we're using the string of product_ids we created

		# Run our query and store the results in the variable $posts
		$products = DB::instance(DB_NAME)->select_rows($q);
		// NOTE: THIS IS ONLY RETURNING PRODUCTS WITH IMAGES CONNECTED TO THEM DUE TO THE $q ABOVE
	
		# Pass the data to the view
		$this->template->content->products 	= $products;
		
		# Render the view
		echo $this->template;
		
	} // end of index fct

	public function product($product_id = NULL) {
		
$product_id=22; // WANT IT PASSED IN
		# Setup the view
		$this->template->content 	= View::instance('v_prototypes_product');
		$this->template->title 		= $this->products->product_name;
      
		$q = "SELECT *
			FROM products
			WHERE product_id =".$product_id;
		
		# Run our query and store the results in the variable $posts
		$product_info = DB::instance(DB_NAME)->select_rows($q);
		
		# Pass the data to the view
		$this->template->content->product_info 	= $product_info;
    	
    	# Build subnavigation NNED TO BUILD DYNAMICALLY
    	$navigation = Array(
/*			"posts"    => "/posts/",
			"add post" => "/posts/add/",
			"logout"   => "/users/logout/",
*/		);
				
		# Pass that array to the template.
		$this->template->content->navigation = $navigation;	
	      		
		# Render the view
		echo $this->template;

	}


		
		
} // end class
