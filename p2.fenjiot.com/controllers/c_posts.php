<?php
class posts_controller extends base_controller	{

	public function __construct() {
		parent::__construct();
		
		# To make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a> or <a href='/users/signup'>Signup</a>");
		}

	} # end __construct

	public function add() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_posts_add');
		$this->template->title 		= "Add a new post";
		
		# Render the view
		echo $this->template;
		
	} # end add fct
	
	public function p_add() {
		
		# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		# Unix timestamp of when this post was created / modified
		$_POST['created'] 	= Time::now();
		$_POST['modified'] 	= Time::now();
		
		# Insert post
		# Note: we don't have to sanatize any of the $_POST data because we're using an insert method that does it for us
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
		# Feedback to user
		echo "Your post has been added. <a href='/posts/add'>Add another post!</a>"; 		// MAKE THIS BETTER !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	} # end p_add fct
	
	public function index() {
		
		# Setup the view
		$this->template->content 	= View::instance('v_posts_index');
		$this->template->title		= "Posts";
		
		# Build our query of posts -- we're only interested in the ones that we're following.
		$q = "SELECT *
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
		
		# Execute our query, storing results in a variable $connections
		$connections = DB::instance(DB_NAME)->select_rows($q); 
		
		
		# In order to query for the posts we need, we're going to need a string of user id's, separated by commas
		# To create this, loop through our connections array
		$connections_string = ""; // empty at first
		
		foreach($connections as $key => $connection) {
			$connections_string .= $connection['user_id_followed'] . ",";
		}
		
		# Remove final comma in $connections_string
		$connections_string = substr($connections_string, 0, -1);
		
		# Now build our query to grab the posts
		$q = "SELECT *
			FROM posts
			JOIN users USING (user_id)
			WHERE posts.user_id IN (" . $connections_string . ")"; // this is where we're using the string of user_ids we created
		
		# Run our query and store the results in the variable $posts
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		# Pass the data to the view
		$this->template->content->posts = $posts;
		
		# Render the view
		echo $this->template;
		
	} # end index fct
	
	public function users() {
		
		# Setup the view
		$this->template->content	= View::instance('v_posts_users');
		$this->template->title		= "Users";
		
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
		
	} # end users fct
	
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
		
	} # end follow fct
	
	public function unfollow($user_id_followed) {
		
		# Delete this connection
		$where_condition = "WHERE user_id = " . $this->user->user_id . " AND user_id_followed = " . $user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);
		
		# Send them back
		Router::redirect("/posts/users");
		
	} # end unfollow fct
	
	
} # end of the class

?>