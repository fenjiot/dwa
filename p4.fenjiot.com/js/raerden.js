$(document).ready(function() {
	console.log('page loaded');
	
	// slide toggle footer
	$('#foot').click(function() {
		console.log('clicked #foot');
	
		$('#footer_box').slideToggle('slow',function() {
	    // Animation complete.
	    	
	    });
	    
	});
	
});	// end of document ready fct