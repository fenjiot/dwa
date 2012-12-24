<?php
class manage_controller extends base_controller	{

	public function __construct() {
		parent::__construct();
		
		# To make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a> or <a href='/users/signup'>Signup</a>");
		}		

	} // end __construct

	public function addproduct() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_manage_addproduct');
		$this->template->title 		= "Add a new product";
		
		# Render the view
		echo $this->template;
		
	} // end addproduct fct

# =============================
# BEGIN RELATED TO ADDPRODUCT v
	public function p_addproduct() {
		
		# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		# Unix timestamp of when this post was created / modified
		$_POST['created'] 	= Time::now();
		$_POST['modified'] 	= Time::now();
		
# ADD LOGIC TO Check to see if product is already in the system, BUT for now move on...
		

		# Build array to fill DB table
		#products
		$product_info = array(
						'created' 		=> Time::now(),
						'modified' 		=> Time::now(),
						'user_id' 		=> $_POST['user_id'],
						'name' 			=> $_POST['product_name'],
						'category'		=> $_POST['product_category'],
						'description'	=> $_POST['product_description'],
						'story'			=> $_POST['product_story'],
						);
		
		# Insert into products table
		$new_product_id = DB::instance(DB_NAME)->insert('products', $product_info);
		
		
		# Build array to fill DB table
		#materials
		$material_info = array(
						'created' 		=> Time::now(),
						'modified' 		=> Time::now(),
						'user_id' 		=> $_POST['user_id'],
						'name' 			=> $_POST['material_name'],
						'description'	=> $_POST['material_description'],
						'color'			=> $_POST['material_color'],
						);

		# Insert into materials table
		$new_material_id = DB::instance(DB_NAME)->insert('materials', $material_info);
	
	
		# Build array to fill DB table
		#products_materials
		# Needs to be after you have inserted product_info into DB and generated product_id
		$products_materials_info = array(
								'created' 		=> Time::now(),
								'modified' 		=> Time::now(),
								'product_id'	=> $new_product_id,
								'material_id'	=> $new_material_id,
								);
								
		# Insert into products_materials table
		DB::instance(DB_NAME)->insert('products_materials', $products_materials_info);
		
		
		# Prep arrays to be sent to p_addimage
		$POST_info = array(
					'user_id'		=> $_POST['user_id'],
					'product_id'	=> $new_product_id,
					# Temp^
					);
		$FILES_info = $_FILES;


		# Call p_addimage 
		# Needs to be after you have inserted product_info into DB and generated product_id
		# Inserts image file and info into app and creates thumbnail
		$new_image_id = $this->p_addimage($POST_info, $FILES_info);
		
		
		# Build array to fill DB table
		#products_images
		$products_images_info = array(
								'created' 		=> Time::now(),
								'modified' 		=> Time::now(),
								'product_id'	=> $new_product_id,
								'image_id'		=> $new_image_id,
								);
								
		# Insert into products_images table
		DB::instance(DB_NAME)->insert('products_images', $products_images_info);
		
		
		# Build array to fill DB table
		#materials_images
		$materials_images_info = array(
								'created' 		=> Time::now(),
								'modified' 		=> Time::now(),
								'material_id'	=> $new_material_id,
								'image_id'		=> $new_image_id,
								);
								
		# Insert into products_images table
		DB::instance(DB_NAME)->insert('materials_images', $materials_images_info);

		
		# Feedback to user
		Router::redirect("/manage/addproduct?alert=".$product_info['name']." was added!"); // AJAX IT

	} // end p_addproduct fct
	
	public function p_addimage($POST_info = NULL, $FILES_info = NULL) {
		# The database has columns "user_id, name, and path" 
		
		$errors     = array();
		$file_ext   = strtolower(strrchr($FILES_info['image_name']['name'], '.'));
		$file_size  = $FILES_info['image_name']['size'];
		$file_tmp   = $FILES_info['image_name']['tmp_name'];
		$extensions = array(".jpeg",".jpg",".png",".gif",".tif",".tiff");
		
		# Grab only product_id number from the alert
#		$new_product_id = str_replace(" ", "", strrchr($post_info['product_id'],' '));
# WRITE LOGIC FOR CASE IF USER DID NOT ADD A NEW PRODUCT AND IS JUST TRYING TO ADD AN IMAGE


		# Build mysql query for product.name 
		$q = "SELECT name
			FROM products
			WHERE product_id = ".$POST_info['product_id'];
			
		# Go through DB and get product.name by product_id
		# With str_replace, we are replaceing spaces (" ") or dashes ("-") with underscores ("_").
		# i.e. "Saddle Bag" and "Saddle-Bag" would become "Saddle_Bag"
		$replace = array(" ", "-");
		$product_name = str_replace($replace, "_", DB::instance(DB_NAME)->select_field($q));
		
		# Set file name to $new_product_id - $product_name - Time Now.ext
		# i.e. 16-Saddle_Bag-1355883801.jpg
		$file_name = $POST_info['product_id']."-".$product_name."-".Time::now()."".$file_ext; //$_FILES['image_name']['name'];
		
		# Check to see if it's an image
		if(isset($FILES_info['image_name'])){
			if(in_array($file_ext,$extensions) === false){
				Router::redirect("/manage/addproduct?error=Only jpg, png or gif images please.");
				
				return 0;
			}
			else if($file_size > 2097152) { 
				# 2097152 bytes = 2 MB
				Router::redirect("/manage/addproduct?error=Your file size is too big. Max file size is 2 MB");
				
				return 0;
			}	
			else {
				
				# Build array to fill DB table
				#images
				$image_info['created'] 	= Time::now();
				$image_info['modified'] = Time::now();
				$image_info['user_id'] 	= $this->user->user_id;
				$image_info['name']		= $file_name;
				$image_info['path']		= "/images/raerden/products/".$file_name;
				
				# Save to your file path			
				move_uploaded_file($file_tmp, APP_PATH."/images/raerden/products/".$file_name);
				
				# Call p_createthumbnail
				# Creates thumbnail and returns array
				$thumb_info = $this->create_thumb($image_info['name']);
				
				# Add thumb_name and thumb_path
				$image_info['thumb_name'] = $thumb_info['name'];
				$image_info['thumb_path'] = $thumb_info['path'];
				
				# Save to database
				$new_image_id = DB::instance(DB_NAME)->insert('images', $image_info);
				
				return $new_image_id;
			}
		} // end check to see if it's an image
			
		# Send an error message if it's not an image
		else {
#			Router::redirect("/manage/addproduct?errorimage=Please select an image to upload");
		}
		
	} // end of p_addimage fct
	
	public function create_thumb($image_name) {
	# Create thumbnail of image
		# Load image
		$imgObj = new Image(APP_PATH."/images/raerden/products/".$image_name);
		
		# Get file extension
		$file_ext = strtolower(strrchr($image_name, '.'));
		
		# Creates new name for image.  Tags on -thumb at end of name before .ext
		# i.e. product_name-thumb.jpeg
		# Store new path for thumb
		$thumb_name = basename($image_name, $file_ext)."-thumb".$file_ext;
		$thumb_path = "/images/raerden/products/".$thumb_name;
		
		# Resize image either to 140w or 190h, auto => keeps proportions
		$imgObj->resize(140,190,'auto');
		
		# Save image to path with new name.
		$imgObj->save_image($thumb_path,100);
		
		# Modify $_POST for thumbnail name
		$thumb_info = array(
					'name' => $thumb_name, 
					'path' => $thumb_path,
					);
		
		return $thumb_info;

	} // end create_thumb fct
	
# END RELATED TO ADDPRODUCT ^	
# ===========================
	
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
	
	
	public function product() {
		
		# Setup the view
		$this->template->content	= View::instance('v_manage_product');
		$this->template->title		= "Manage Product";
		
		# Build our qurey of products -- want to display all products in system
		$q = "SELECT *
			FROM products";
			
		# Execute out qurey, storing results in a variable $all_products
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

		# Selecting specific information we want $post to contain later on 
		# We don't want to pass token, user.password, user.created, user.modified, etc
		# Using DB table: posts AS p, users AS u		
		$select = "p.product_id, p.created, p.modified, p.user_id, 
				p.product_name, p.product_category, p.product_description, 
				p.product_story, p.material_name, p.material_color, 
				p.material_description, t.product_id, t.thumb_name, 
				t.thumb_path";
		
		# Now build our query to grab the products
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
	} // end of products fct
	
	public function editproduct() {
	
		# Setup the view
		$this->template->content 	= View::instance('v_manage_editproduct');
		$this->template->title 		= "Edit product information";
		
		# IMPORTANT -- NEED TO PASS IN product id!!!!!
		
		$q = "SELECT *
			FROM products
			WHERE product_id = ".$product_id;
		
		$product_info = DB::instance(DB_NAME)->select_row($q);
		
		# Pass existing product information to view
		$this->template->content->product = $product_info;
		
		# Render the view
		echo $this->template;
		
	} // end of editproduct

# WORK ON! vvvvvvvvvv !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!	
	public function p_editproduct() {

		# Unix timestamp of when this post was modified
		$_POST['modified'] 	= Time::now();

		# Update product infromation 
		# Note: we don't have to sanatize any of the $_POST data because we're using an update method that does it for us
		DB::instance(DB_NAME)->update_row('products', $_POST, "WHERE product_id = ".$_POST['product_id']);

		# Redirect user
		Router::redirect("/manage");
	
	} // end edit fct
# WORK ON! ^^^^^^^^^^ !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	public function get_materials($product_id = NULL) {
	
		# Setup the view
		$this->template->content 	= View::instance('v_manage_get_materials');
		$this->template->title 		= "Get Merials";

		# Build query of material_ids associated with the specified product
		$q = "SELECT material_id
			FROM products_materials
			WHERE product_id = ".$product_id;
		
		# Build array of material_ids associated with the specified product
		$all_materials = DB::instance(DB_NAME)->select_rows($q);
		
		# In order to query for the materials we need, we're going to need a string of user id's, separated by commas
		# To create this, loop through our connections array
		$all_materials_string = ""; // empty at first
		
		foreach($all_materials as $key => $material) {
			$all_materials_string .= $material['material_id'] . ",";
		}

		# Added to fix error that arises when following no one
		# This avoids the issue later with having nothing in the '$q = "SELECT * ... IN ()";' syntax error with the empty ()
		if($all_materials_string == "") {
			# If $connections_string is empty (i.e. when the user isn't following anyone) set to user_id_followed 0
			$all_materials_string = "0,";	
		}
		
		# Remove final comma in $connections_string
		$all_materials_string = substr($all_materials_string, 0, -1);
		
		# Build query of all materials for the specificed product
		$q = "SELECT *
			FROM materials
			WHERE material_id = ".$all_materials_string;
			
		# Build array of all the material information associated with the specified product
		$materials = DB::instance(DB_NAME)->select_rows($q);

		# COMMENTED OUT FOR NOW.  IDEALLY SWITCH THIS FUNCTION TO LIBRARY AND CALL FROM THERE.
#		return $materials; // Returns array of all the materials and related information associated with the specified product

		# Pass existing product information to view
		$this->template->content->materials = $materials;
		
		# Render the view
		echo $this->template;

	} // end of get_materials fct
	

	public function get_images($relationship_table = NULL, $col_related = NULL, $fields_of_interest = NULL) {
	
		# Build query		
		$q = "SELECT image_id
			FROM ".$relationship_table."
			WHERE ".$col_related." = ".$fields_of_interest;
		
		# Build array
		$results = DB::instance(DB_NAME)->select_rows($q);
		
		# In order to query for the materials we need, we're going to need a string of user id's, separated by commas
		# To create this, loop through our connections array
		$all_images_string = ""; // empty at first
		
		foreach($all_images as $key => $image) {
			$all_images_string .= $image['image_id'] . ",";
		}

		# Added to fix error that arises when following no one
		# This avoids the issue later with having nothing in the '$q = "SELECT * ... IN ()";' syntax error with the empty ()
		if($all_images_string == "") {
			# If $connections_string is empty (i.e. when the user isn't following anyone) set to user_id_followed 0
			$all_images_string = "0,";	
		}
		
		# Remove final comma in $connections_string
		$all_images_string = substr($all_images_string, 0, -1);
		
		# Build new query
		$q = "SELECT *
			FROM images
			WHERE image_id = ".$results;
		
		# Build new array complete with all associated data	
		$images = DB::instance(DB_NAME)->select_rows($q);
		
		# COMMENTED OUT FOR NOW.  IDEALLY SWITCH THIS FUNCTION TO LIBRARY AND CALL FROM THERE.
#		return $images; // Returns array of images associated with product(s), material(s), etc
		
		# Pass existing product information to view
		$this->template->content->images = $images;
		
		# Render the view
		echo $this->template;

	} // end of get_images fct
	
	
# ========================================================================================================================= #
# BELOW THE FOLD
# ========================================================================================================================= #		
	
	
	public function follow($user_id_followed) {
		
		# Prepare our data array to be instered
		$data = Array(
			"created" 			=> Time::now(),
			"user_id" 			=> $this->user->user_id,
			"user_id_followed" 	=> $user_id_followed
			);
			
		# Make the insert
		DB::instance(DB_NAME)->insert('users_users', $data);	
		
		# Send them back 
		Router::redirect("/posts/users");
		
	} // end follow fct
	
	
	public function unfollow($user_id_followed) {
		
		# Delete this connection
		$where_condition = "WHERE user_id = " . $this->user->user_id . " AND user_id_followed = " . $user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);
		
		# Send them back
		Router::redirect("/posts/users");
		
	} # end unfollow fct
	
	
	public function myposts() {
	
		# Setup the view
		$this->template->content	= View::instance('v_posts_myposts');
		$this->template->title		= $this->user->first_name."'s posts";
		
		# Selecting specific information we want $post to contain later on 
		# We don't want to pass token, user.password, user.created, user.modified, etc
		# Using DB table: posts AS p, users AS u		
		$select = "p.post_id, p.created, p.modified, p.user_id, p.content, u.user_id, u.email, u.first_name, u.last_name";
		
		# Build our query of posts -- we're only interested in the ones the user created.
		$q = "SELECT " . $select . "
			FROM posts AS p
			JOIN users AS u USING (user_id)
			WHERE p.user_id = ".$this->user->user_id;
		
		# Execute our query, storing results in a variable $posts
		$posts = DB::instance(DB_NAME)->select_rows($q); 
		
		# Reverse order of post information.  Toggle false to maintain Array order [0],[1],[2],[3], etc while other fields are switched.
		# If original array was something like Array ([0]=>A, [1]=>B, [2]=>C)  Reverse array toggled false would be Array ([0]=>C, [1]=>B, [2]=>A).
		# This way we get posts sorted in descending order (newest posts first, oldest last)
		$reverse_posts = array_reverse($posts, false);	

		# Pass the data to the view
		$this->template->content->posts	= $reverse_posts;
		
		# Render the view
		echo $this->template;
		
	} // end myposts fct
		
	
} // end of the class

?>