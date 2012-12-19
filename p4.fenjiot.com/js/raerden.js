$(document).ready(function() {
	console.log('page loaded');
	
	// slide toggle header
	$('header').click(function() {
		console.log('clicked header');
		$(this).attr('class', 'show');	
		$('.head_logo').slideToggle('slow');
	});
	
	// slide toggle footer
	$('#foot').click(function() {
		console.log('clicked #foot');
		$(this).attr('class', 'show');
		$('#footer_box').slideToggle('slow');
	});

	// I am here script -- Note: will only work if you are going to a new page.  Doesn't update when jumping around on same page...
	$("#main_nav").find("a[href='" + window.location.pathname + window.location.hash +"']").each(function(){
		console.log(window.location.pathname);
		$(this).attr('class', 'active');
	});

});	// end of document ready fct