// Lucy and Ricardo

$(document).ready(function() { // start doc ready; do not delete this!

	console.log('Hello world!');
	
	document.getElementById('lucy').style.width = '500px';
	document.getElementById('lucy').style.background = 'blue';
	
	$('#lucy').click(function(){
		console.log('clicked on lucy');
	});

}); // end doc ready; do not delete this!