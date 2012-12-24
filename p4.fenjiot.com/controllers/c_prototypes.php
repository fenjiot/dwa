<?php

class prototypes_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 	
	
	public function index() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_manage_index');
		$this->template->title		= "Manage Products";
		
		# Build our qurey of all products -- want to display all products in system
		$q = "SELECT *
			FROM products";
		
		# Run our query and store the results in the variable $products
		$all_products = DB::instance(DB_NAME)->select_rows($q);
		
		# In order to query for the products we need, we're going to need a string of product id's, separated by commas
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
			
		
		# BEGIN ADDING MATERIALS ARRAY INFO
		# Selection for products_materials
		$select = "m.name, m.description, m.color, p.product_id";
		
		# Build material query
		$q = "SELECT ".$select."
			FROM materials AS m
			JOIN products_materials AS p_m ON p_m.material_id = m.material_id
			JOIN products AS p ON p.product_id = p_m.product_id
			WHERE p.product_id IN (".$all_products_string.")";
		
		$all_materials = DB::instance(DB_NAME)->select_rows($q);
	

		# Build array to pass to view
		# Insert $all_materials arrays into proper place in $all_products array
		foreach($all_products as $key => $product) {
			$i=0; // will be used in materials foreach if statement
			$product['materials'] = "";
			foreach($all_materials as $keyy => $material) {
				if($product['product_id'] == $material['product_id']) {
					$material_x = 'material-'.$i;
					$product['materials'][$material_x] = $material;
					$i++;
				} // end if
			} // end forech materials
			$all_products[$key] = $product;
		} // end foreach products
		# END ADDING MATERIALS ARRAY INFO


		# BEGIN ADDING IMAGES ARRAY INFO
		# Selection for products_images
		$select = "i.name, i.path, i.thumb_name, i.thumb_path, p.product_id";

		# Build image query
		$q = "SELECT ".$select."
			FROM images AS i
			JOIN products_images AS p_i ON p_i.image_id = i.image_id
			JOIN products AS p ON p.product_id = p_i.product_id
			WHERE p.product_id IN (".$all_products_string.")";
		
		$all_images = DB::instance(DB_NAME)->select_rows($q);
		

		# Insert $all_images arrays into proper place in $all_products array
		foreach($all_products as $key => $product) {
			$i=0; // will be used in materials foreach if statement
			$product['images'] = "";
			foreach($all_images as $keyy => $image) {
				if($product['product_id'] == $image['product_id']) {
					$image_x = 'image-'.$i;
					$product['images'][$image_x] = $image;
					$i++;
				} // end if
			} // end forech materials		
			$all_products[$key] = $product;
		} // end foreach products
		# END ADDING IMAGES ARRAY INFO
		
		
		# Pass the data to the view
		$this->template->content->products 	= $all_products;
				
		# Render the view
		echo $this->template;
		
	} // end index fct


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
