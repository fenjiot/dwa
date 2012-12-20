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

	public function p_addproduct() {
		
		# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		# Unix timestamp of when this post was created / modified
		$_POST['created'] 	= Time::now();
		$_POST['modified'] 	= Time::now();
		
# ADD LOGIC TO Check to see if product is already in the system, BUT for now move on...
		
		# Drop [submit] => 'Add product' from $_POST
		# This is currently neccessary, since $_POST is capturing the submit button's value when submitting
		unset($_POST['submit']);

		# Insert product information into products table
		# Note: we don't have to sanatize any of the $_POST data because we're using an insert method that does it for us
		# Also grabbing product_id for the newly added product
		$new_product_id = DB::instance(DB_NAME)->insert('products', $_POST);
		
		# Feedback to user
		Router::redirect("/manage/addproduct?alert=Your product was added! It's product ID is: ".$new_product_id); // AJAX IT

	} // end p_addproduct fct
	
	public function p_addimage() {
		# The database has columns "image_name" 
		# and NOT "title"
		$errors     = array();
		$file_ext   = strtolower(strrchr($_FILES['image_name']['name'], '.'));
		$file_size  = $_FILES['image_name']['size'];
		$file_tmp   = $_FILES['image_name']['tmp_name'];
		$extensions = array(".jpeg",".jpg",".png",".gif",".tif",".tiff");
		
		# Grab only product_id number from the alert
		$new_product_id = str_replace(" ", "", strrchr($_POST['product_id'],' '));
# WRITE LOGIC FOR CASE IF USER DID NOT ADD A NEW PRODUCT AND IS JUST TRYING TO ADD AN IMAGE

		# Build mysql query for product_name 
		$q = "SELECT product_name
			FROM products
			WHERE ".$new_product_id." = product_id";
			
		# Go through DB and get product_name by product_id
		# With str_replace, we are replaceing spaces (" ") or dashes ("-") with underscores ("_").
		# i.e. "Saddle Bag" and "Saddle-Bag" would become "Saddle_Bag"
		$replace = array(" ", "-");
		$product_name = str_replace($replace, "_", DB::instance(DB_NAME)->select_field($q));
		
		# Set file name to $new_product_id - $product_name - Time Now.ext
		# i.e. 16-Saddle_Bag-1355883801.jpg
		$file_name = $new_product_id."-".$product_name."-".Time::now()."".$file_ext; //$_FILES['image_name']['name'];
		
		# Check to see if it's an image
		if(isset($_FILES['image_name'])){
			if(in_array($file_ext,$extensions) === false){
				Router::redirect("/manage/addproduct?error=Only jpg, png or gif images please.");
			}
			else if($file_size > 2097152) { 
				# 2097152 bytes = 2 MB
				Router::redirect("/manage/addproduct?error=Your file size is too big. Max file size is 2 MB");
			}	
			else {
				//echo "That works";
				
				# Preparing $_POST injection
				$_POST['user_id'] 		= $this->user->user_id;
				$_POST['created'] 		= Time::now();
				$_POST['modified'] 		= Time::now();
				$_POST['image_name']	= $file_name;
				$_POST['image_path']	= "/images/raerden/products/".$file_name; // IMPORTANT CHECK TO MAKE SURE IT IS STORING THEM CORRECTLY!
				$_POST['product_id']	= $new_product_id;
				
				# Drop [submit] => 'Add product' from $_POST
				# This is currently neccessary, since $_POST is capturing the submit button's value when submitting
				unset($_POST['submit']);
				
				# Save to database
				$image_id = DB::instance(DB_NAME)->insert('images', $_POST);
	 
				# Save to your file path			
				move_uploaded_file($file_tmp, APP_PATH."/images/raerden/products/".$file_name);
				
				# Create thumbnail of image
					# Load image
					$imgObj = new Image(APP_PATH."/images/raerden/products/".$file_name);
					
					# Creates new name for image.  Tags on -thumb after image name before .ext 
					$thumbnail = Utils::postfix("-thumb",APP_PATH."/images/raerden/products/".$file_name);
					
					$new_file_name = basename($file_name, $file_ext)."-thumb".$file_ext;
					
					# Resize image w x h
					$imgObj->resize(140,190,'auto');
					
					# Save image to path with new name.
					$imgObj->save_image($thumbnail,100);
					
					# Modify $_POST for thumbnail name
					$_POST['thumb_name'] 	= $new_file_name;
					$_POST['thumb_path'] 	= "/images/raerden/products/".$new_file_name;
					$_POST['image_id']		= $image_id;
					unset($_POST['image_name']);
					unset($_POST['image_path']);
					
					# Stick image into database
					DB::instance(DB_NAME)->insert('thumbs', $_POST);

				# Redirect
				Router::redirect("/manage/addproduct?alertimage=Your image has been added!");
			}
		} // end check to see if it's an image
			
		# Send an error message if it's not an image
		else {
			Router::redirect("/manage/addproduct?errorimage=Please select an image to upload");
		}
		
	} // end of p_addimage fct
	
	public function product() {
		
		# Setup the view
		$this->template->content	= View::instance('v_manage_product');
		$this->template->title		= "Manage Product";
		
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
	
	public function index() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_manage_index');
		$this->template->title		= "Manage";
		
		# Build our qurey of all products -- want to display all products in system
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

		# Run our query and store the results in the variable $products
		$products = DB::instance(DB_NAME)->select_rows($q);
# WORKING ON!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!		
		# Now build our query to grab the thumbs for existing products
		$q = "SELECT products.product_id, thumbs.thumb_path
			FROM products
			JOIN thumbs USING (product_id)
			WHERE product_id IN (" . $all_products_string . ")";
		
		$thumbs = DB::instance(DB_NAME)->select_rows($q);
		
# WORKING ON!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!				
		# Pass the data to the view
		$this->template->content->products 	= $products;
		$this->template->content->thumbs	= $thumbs;
		
		# Render the view
		echo $this->template;
		
	} // end index fct
	
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
	
	public function p_editproduct() {
# WOKRING ON!!!!!!!!!!!!!!!!!!!!!!
		# Unix timestamp of when this post was modified
		$_POST['modified'] 	= Time::now();

		# Update product infromation 
		# Note: we don't have to sanatize any of the $_POST data because we're using an update method that does it for us
		DB::instance(DB_NAME)->update_row('products', $_POST, "WHERE product_id = ".$_POST['product_id']);

		# Redirect user
		Router::redirect("/manage");
	
	} // end edit fct


# ========================================================================================================================= #
# BELOW THE FOLD
# ========================================================================================================================= #		

	
	public function users() {
		
		# Setup the view
		$this->template->content	= View::instance('v_posts_users');
		$this->template->title		= "People to Follow";
		
		# Build our query to get all the users
		$q = "SELECT *
			FROM users";
			
		# Execute the qurey to get all the users. Store the results in array in the variable $users
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		# Building our query to figure out what connections does this user already have.  i.e. who are they following
		$q = "SELECT *
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
		
		# Execute this query with the select_array method
		# select_array will return our results in an array and use the "user_id_followed" field as the index
		# This will come in handy when we get to the view
		# Store our results (an array) in the variables $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		# Pass the data to the view
		$this->template->content->users			= $users;
		$this->template->content->connections	= $connections;
		
		# Render the view
		echo $this->template;
		
	} // end users fct
	
	
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