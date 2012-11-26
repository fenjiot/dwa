// Card Generator

$(document).ready(function() { // start doc ready; do not delete this!

	console.log('card generator');
	
/*	$('.color-choice').hover(function() {
		var color_hover = $(this).css('background-color');
		$('#canvas, .texture-choice').css('background-color', color_hover);
	}); // end of color-choice hover fct
*/	

/* Color Choice */
	$('.color-choice').click(function() {
		// figure out which color was chosen
		var color_that_was_chosen = $(this).css('background-color');
			
		// apply color chosen to canvas & texture boxes
		$('#canvas, .texture-choice').css('background-color', color_that_was_chosen);
		
	}); // end of color-choice click fct

/* Texture Choice */
	$('.texture-choice').click(function() {
		// figure out which texture was chosen
		var image_that_was_chosen = $(this).css('background-image');
		
		// apply texture chosen to canvas
		$('#canvas').css('background-image', image_that_was_chosen);
	}); // end of texture-choice click fct

/* Message */	
	$('input[name=message]').click(function() {
		// get value from message
		var message = $(this).val();
		
		// write message to canvas
		$('#message_in_canvas').html(message);
	}); // end of input message click fct

/* Recipient */
	$('#recipient').keyup(function() {
		// get value from recipient as user enters
		var recipient = $(this).val();
		var length = recipient.length;
		var maxcharacters = 15
		var characters_left = maxcharacters-length;
		
		// logic for characters left counter
		if(characters_left <=3 && characters_left > 0) {
			$('#characters_left').css('color','orange');
		}
		else if (characters_left == 0) {
			$('#characters_left').css('color', 'red');
		}
		else {
			$('#characters_left').css('color', 'black');
		}
		
		// update characters left counter
		$('#characters_left').html(characters_left);
		
		// write recipient to canvas
		$('#recipient_output_in_canvas').html(recipient);
	}); // end of input recipient fct
	
/* Graphic Choice */	
	$('.graphic_choice').live('click', function() {
		// get source of graphic
		var image = $(this).attr('src');
		
		// put graphic on card and make it draggable
		$('#canvas').prepend("<img class='draggable new-draggable' src='" + image + "'>");
		
		// confine draggable graphic to canvas
		$('.draggable').draggable({ containment: '#canvas'});
		
	}); // end of graphic choice fct

/* Reset Card */
	$('#reset_card_button').click(function() {
						
			$('#message_in_canvas').html("");
			$('#recipient_output_in_canvas').html("");
			$('.draggable').remove();
			$('#canvas').css('background-color', 'white');
			$('#canvas').css('background-image', '');
		
		}); // end of reset card fct

/* Print Card */
	$('#print-button').click(function() {
		
		// Setup the window we're about to open	    
	    var print_window =  window.open('','_blank','');
	    
	    // Get the content we want to put in that window - this line is a little tricky to understand, but it gets the job done
	    var contents = $('<div>').html($('#canvas').clone()).html();
	    
	    // Build the HTML content for that window, including the contents
	    var html = '<html><head><link rel="stylesheet" href="card-generator.css" type="text/css"></head><body>' + contents + '</body></html>';
	    
	    // Write to our new window
	    print_window.document.open();
	    print_window.document.write(html);
	    print_window.document.close();
	    		
	}); // end of print card fct

}); // end doc ready; do not delete this!
