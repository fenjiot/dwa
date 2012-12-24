<?php

# Add some documentation for how to use ProductResources	
 	
class ProductResources {
  
   	# Class variables  // figure out which ones are actuall necessary to specify here.	
   	private $q;
   	
	private $product_id;
	private $all_materials;
	private $materials = array();
	
	/*-------------------------------------------------------------------------------------------------
	Situation: would call get_materials when you have a product you want materials for
	Need: would pass in the product_id (to find product_material relationship)
	Should have access to products_materials table through DB::instance(DB_NAME) 
	-------------------------------------------------------------------------------------------------*/
	public function get_materials($product_id) {

		# Build query of material_ids associated with the specified product
		$q = "SELECT material_id
			FROM products_materials
			WHERE product_id = ".$product_id;
		
		# Build array of material_ids associated with the specified product
		$all_materials = DB::instance(DB_NAME)->select_rows($q);
		
		# Build query of all materials for the specificed product
		$q = "SELECT *
			FROM materials
			WHERE material_id = ".$all_materials;
			
		# Build array of all the material information associated with the specified product
		$materials = DB::instance(DB_NAME)->select_rows($q);
		
		return $materials; // Returns array of all the materials and related information associated with the specified product

	} // end of get_materials fct
	
	
	/*-------------------------------------------------------------------------------------------------
		
	Eample:	
			$col_wanted = image_id
			$relationship_table = products_images
			$col_related = product_id
			$fields_of_intrest = 1, 3, 5, whatever
		or		
			$col_wanted = image_id
			$relationship_table = materials_images
			$col_relate = material_id
			$fields_of_intrest = 1
	-------------------------------------------------------------------------------------------------*/
	public function get_images($relationship_table, $col_related, $fields_of_interest) {
	
		# Build query		
		$q = "SELECT image_id
			FROM ".$relationship_table."
			WHERE ".$col_related." = ".$fields_of_interest;
		
		# Build array
		$results = DB::instance(DB_NAME)->select_rows($q);
		
		# Build new query
		$q = "SELECT *
			FROM images
			WHERE image_id = ".$results;
		
		# Build new array complete with all associated data	
		$images = DB::instance(DB_NAME)->select_rows($q);
		
		return $images; // Returns array of images associated with product(s), material(s), etc

	} // end of get_images


} // eoc
?>