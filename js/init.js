$(document).ready(function() {

	/* inital */

	var admin = false;

	/* error handling */ 

	$(document).ajaxError(function() {
		location.reload(); /* refresh the page, on error */
	});

	/* fancy text */

	if(jQuery().lettering) {
    	$("h1").lettering();
 	}

 	 /* random username generation */

 	var random = Math.floor(Math.random()*901) + 100; /* between 100 - 1000) */
	$("#username")[0].value = "Anonymous" + random;

	/* */
	$("#copyright").hover(function() {
		$(this).text("Suki Morgan");
	}, function() {
		$(this).text("Tony Blokes");
	});

});