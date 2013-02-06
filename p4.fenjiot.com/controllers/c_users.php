<?php
class users_controller extends base_controller {
	
	public function __contstruct() {
		parent::__construct();
		echo "users_controller construct called <br><br>";
	
	} // end __construct
	
	
	public function index() {

		Router::redirect("/");
	
	} // end index fct
	

	public function signup($error = NULL) {
		
		# Setup view
		$this->template->content	= View::instance('v_users_signup');
		$this->template->title		= "Signup";
		
		# Pass data to the view
		$this->template->content->error = $error;
		
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
		$client_files = Array(
					""
                    );
    
    	$this->template->client_files = Utils::load_client_files($client_files);
		
		# Render template
		echo $this->template;
				
	} // end signup fct
	
	
	public function p_signup() {

		# Encrypt user password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		$_POST['password_confirm'] = sha1(PASSWORD_SALT.$_POST['password_confirm']);
		
		# More data we want stored with the user
		$_POST['created']	= Time::now();
		$_POST['modified']	= Time::now();
		$_POST['token']		= sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
		# Check password
		if ($_POST['password'] != $_POST['password_confirm']) {
			Router::redirect("/users/signup?alert=password does not match");
		}
		
		# Check DB->users->email to make sure it doesn't already exist
		$q = "SELECT *
			FROM users
			WHERE users.email = '".$_POST['email']."'"; 

		$check_email = DB::instance(DB_NAME)->select_field($q);
		
		# Check if username is in system
		$q = "SELECT *
			FROM users
			WHERE users.username = '".$_POST['username']."'";
			
		$check_username = DB::instance(DB_NAME)->select_field($q);
		
		# Add checks together 
		$check = $check_email + $check_username;
		
		# Make sure there isn't an existing user with same email or username
		if($check == "") {
		
			# Prep data to be entered.  Need to remove $_POST['password_confirm'] and ['submit']
			unset($_POST['password_confirm']);
			unset($_POST['submit']);

			# Insert this user into the database.  Adds contents of modified $_POST into database.
			$user_id = DB::instance(DB_NAME)->insert("users",$_POST);

			# Sign the new user in
			$token = $_POST['token'];
			@setcookie("token", $token, strtotime('+2 weeks'), '/');

			# Redirect to home page
			Router::redirect("/");
			
		}
		else {
			Router::redirect("/users/signup/error");
			
			echo "So sorry, <br><br>".$_POST['email']." <br><br>has already been registered.";
			# Feedback to user  -- could make this prettier by sending them to custom signup failed page
			# Could also make this better with JAVASCIPT...just saying...
			# Maybe in the future you should make an general error page that you can pass in notes instead of these echos.
			
		}

	} // end of p_signup fct
	

	public function login($error = NULL) {
		
		# Setup view
		$this->template->content 	= View::instance('v_users_login');
		$this->template->title		= "Login";
		
		# Pass data to the view
		$this->template->content->error = $error;
		
		# Render template
		echo $this->template;
		
	} // end login fct
	
	
	public function p_login() {
		
		# Sanitize the user entered data to prevent SQL injection attacks
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# Hash submitted password so we can compare it against to one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			AND password = '".$_POST['password']."'";
		
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# If we don't get a token back, login failed
		if($token == "") {
			# Send back to to login page
			Router::redirect("/users/login/error");
			
			echo "login failed";
		
		}
		# But if we do, login succeeded!
		else {
			# Store this token in a cookie
			setcookie("token", $token, strtotime('+2 weeks'),'/');
			
			# Send them to the main logged in page -- TBD
			Router::redirect("/"); // CHANGE REDIRECT to the page you want.  "/" is going to index.
		
		}
		
	} // end p_login fct
	
	
	public function logout() {
		
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		# Create the data array we'll use with the update method
		# In this case, we're only updating one field
		$data = Array("token" => $new_token);
		
		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		# Delete their token cookie -- effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');
		
		# Send them back to the main landing page
		Router::redirect("/");
		
	} // end logout fct
	
	
	public function profile($user_name = NULL, $error = NULL) {
		
		# If user is blank, they're not logged in, show message and send to login page
		if(!$this->user) {
			echo "Members only. <a href='/users/login'>Login</a>";
		
			# Return will force this method to exit here so the rest of 
			# the code won't be executed and the profile view won't be displayed.
			return false;
			
			# Setup view
			$this->template->content 	= View::instance('v_users_profile');
			$this->template->title		= "Profile of ".$this->user->first_name;	
			
			# Pass information to the view
			$this->template->content->user_name = $user_name;
			$this->template->content->error = $error;
			
			# Render template
			echo $this->template;
			
			
		}
		else {
			# Setup view
			$this->template->content 	= View::instance('v_users_profile');
			$this->template->title		= "Profile of ".$this->user->first_name;	
			
			# Pass information to the view
			$this->template->content->user_name = $user_name;
			$this->template->content->error = $error;
			
			# Render template
			echo $this->template;

		}
		
	} // end profile fct
	
	
	public function p_profile() {

		# Encrypt user password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		# More data we want stored with the user
		$_POST['modified']	= Time::now();
		
		# Check DB->users->email to make sure it doesn't already exist
		$q = "SELECT *
			FROM users
			WHERE user_id = '".$this->user->user_id."' AND password = '".$_POST['password']."' AND email = '".$_POST['email']."'"; 

		$check = DB::instance(DB_NAME)->select_field($q);

		# Make sure password provided is correct
		if($check == "") {

# Whole reporting of the error isn't working yet. I'm trying to use $_POST to report the error, but it's not working. 
#Was using $error before, but was having issues passing $error, where as $_POST is global.
#			$_POST = 2;

			# Failed verification
			# Redirect to profile with error
			Router::redirect("/users/profile/error");
			
		}
		else {
			# Remove excess data from array.  Only want to pass relevant information to insert.
			$insert_data = array ( "first_name" => $_POST['first_name'], "last_name" => $_POST['last_name'], "modified" => $_POST['modified'] );
		
			# Update post content and modified timestamp 
			# Note: we don't have to sanatize any of the $_POST data because we're using an update method that does it for us
			DB::instance(DB_NAME)->update_row('users', $insert_data, "WHERE user_id =".$this->user->user_id);

# Whole reporting of the error isn't working yet. I'm trying to use $_POST to report the error, but it's not working. 
#Was using $error before, but was having issues passing $error, where as $_POST is global.
#			$_POST = 1;
			
			# Redirect to profile
			Router::redirect("/users/profile/");
			
		}

	} // end of p_profile fct
	
	
	public function delete() {
	
		# Setup view
		$this->template->content 	= View::instance('v_users_delete');
		$this->template->title		= "Erasing ".$this->user->first_name;
		
		$user_id = $this->user->user_id;
		
		# Pass information to the view
		$this->template->content->user_id = $user_id;
		
		# Render template
		echo $this->template;

	} // end of delete fct
	
	
	public function p_delete() {

		$answer = $_POST['group1']; 
		
		if($answer == "YES") {
			# Goes through DB and removes user by user_id
			DB::instance(DB_NAME)->delete('users', "WHERE user_id = '".$this->user->user_id."'");
			
			# Feedback to user
#			echo "Goodbye!  You know where to find us! <br><br> <a href='/users/signup'>Signup</a>";
			
			# Redirect to signup page
			Router::redirect("/users/signup/");
			
		}
		else {
			# Feedback to user
#			echo "Whew!  We were a little worried there. <a href='/users/profile'>Come on</a>";	
			
			# Redirect to index
			Router::redirect("/");
			
		}

	} // end of p_delete fct
	
} // end of the class

