<?php
class users_controller extends base_controller {
	
	public function __contstruct() {
		parent::__construct();
		echo "users_controller construct called <br><br>";
	
	} # end __construct
	
	public function index() {
		echo "Welcome to the user's department"; // shows up when you go to "/users". ADD LOGIC to prevent people from getting into this !!!!!!!!!!!!!!!!!!!!!!!!
	
	} # end index fct

	public function signup() {
		
		# Setup view
		$this->template->content	= View::instance('v_users_signup');
		$this->template->title		= "Signup";
		
		# Render template
		echo $this->template;
				
	} # end signup fct
	
	public function p_signup() {
		
		# Dump out the results of POST to see what form submitted.  Use for TESTING.
		// print_r($_POST);
		
		// ADD LOGIC to prevent people from getting into p_signup !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		
		
		# Encrypt user password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# More data we want stored with the user
		$_POST['created']	= Time::now();
		$_POST['modified']	= Time::now();
		$_POST['token']		= sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
		# Insert this user into the database.  Adds contents of $_POST into database.
		$user_id = DB::instance(DB_NAME)->insert("users",$_POST);
		
		# For now, just confirm that they've signed up -- make nicer later
		echo "Hurrah! You're signed up!";
		
	} # end of p_signup fct
	
	public function login() {
		
		# Setup view
		$this->template->content 	= View::instance('v_users_login');
		$this->template->title		= "Login";
		
		# Render template
		echo $this->template;
		
	} # end login fct
	
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
			AND password = '".$_POST['password']."'
			";
		
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# If we don't get a token back, login failed
		if(!$token) {
			# Send back to to login page
			Router::redirect("/users/login/"); // Maybe add message that says login failed.
			
			echo "login failed";
		
		}
		# But if we do, login succeeded!
		else {
			# Store this token in a cookie
			setcookie("token", $token, strtotime('+1 week'),'/');
			
			# Send them to the main logged in page -- TBD
			Router::redirect("/"); // CHANGE REDIRECT to the page you want.  "/" is going to index.
		
		}
		
	} # end p_login fct
	
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
		
	} # end logout fct
	
	public function profile($user_name = NULL) {
		
		# If user is blank, they're not logged in, show message and send to login page
		if(!$this->user) {
			echo "Members only. <a href='/users/login'>Login</a>";
		
			# Return will force this method to exit here so the rest of 
			# the code won't be executed and the profile view won't be displayed.
			return false;
			
		}
		else {
			# Setup view
			$this->template->content 	= View::instance('v_users_profile');
			$this->template->title		= "Profile of ".$this->user->first_name;
			
			# Load CSS / JS
			$client_files = Array(
				"/css/users.css",
				"/js/users.js",
				);
				
			$this->template->client_files = Utils::load_client_files($client_files);
			
			# Pass information to the view
			$this->template->content->user_name = $user_name;
			
			# Render template
			echo $this->template;

		}
		
	} # end profile fct
	
} # end of the class

?>