$(document).ready(function() {
	console.log('page loaded');
	
	$('header').click(function() {
		console.log('clieck header');
		
		//$('.head_logo').css('display', 'none');
		
		$('.head_logo').slideToggle('slow');
		
	});
	
	// slide toggle footer
	$('#foot').click(function() {
		console.log('clicked #foot');
	
		$('#footer_box').slideToggle('slow',function() {
	    // Animation complete.
	    	
	    });
	    
	});
	
});	// end of document ready fct