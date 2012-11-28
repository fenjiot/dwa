$(document).ready(function() {
                
	$('#process-btn').click(function() {
	                
	        $.ajax({
	                type: 'POST',
	                url: 'process.php',
	                success: function(response) { 
	                     // Load the results we get back from process.php into the results div
	                        $('#results').html(response);
	                },
	                data: {
	                        name: $('#name').val(),
	                },
	        }); // end ajax setup
	                
	}); // end process-btn wiring
                    
}); // end doc ready