
<form name='new-post' method='POST' action='/posts/p_add'>
	<div class="strong">Add a New Post:</div><br>
	<textarea rows="10" cols="50" name='content' placeholder="text area is expandible"></textarea>
	
	<br><br>
	
	<input type='submit'>
	
</form>

<div id='results'></div>


<script type='text/javascript'>
	
	// Set up the options for Ajax and our form
	var options = { 
		type: 'POST',
		url: '/posts/p_add/',
		beforeSubmit: function() {
			$('#results').html("Adding...");
		},
		success: function(response) { 	
			$('#results').html("Your post was added.");
		} 
	}; 
		
	// Using the above options, Ajax'ify the form	
	$('form[name=new-post]').ajaxForm(options);
	
</script>