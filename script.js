$(document).ready(function() {

	/* main functions */

	function send() {
		var username = $("#username")[0].value;
		var text = $("#message")[0].value;

		var namecolor = "black";

		if(admin != false) {
			namecolor = $("#namecolor")[0].value;
		}

		$.ajax({
			type: "POST",
			url: "ajax.php?send",
			data: {username: username, text: text, namecolor: namecolor},
			success: function() {
				update(false);
			}
		});

		$("#message")[0].value = "";
	}

	function update(loop) {
		$.ajax({
			url: "ajax.php?update",
			success: function(res) {
				var code = atob(res);
				$("#chat").html(code);
				
				if($("#autoscroll").is(":checked")) {
					$("#chat").scrollTop($("#chat")[0].scrollHeight);
				}

				if(loop === true) {
					setTimeout(function() {
						update(true);
					}, 1000);
				}
			}
		});
	}

	/* inital */

	var admin = false;

	document.title += document.domain;

	/* error handling */ 

	$(document).ajaxError(function() {
		location.reload(); /* refresh the page, on error */
	});

	/* setting io  for main functions */

	$("#message").keypress(function(event) {
		if ( event.which == 13 ) {
			event.preventDefault();
			send();
		}
	});

	$("#send").click(send);

	update(true);

	/* fancy text */

	if(jQuery().lettering) {
    	$("h1").lettering();
 	}

 	/* random username generation */

 	var random = Math.floor(Math.random()*901) + 100; /* between 100 - 1000) */
	$("#username")[0].value = "Anonymous" + random;

	/* admin tools */

	function login() {
		var password = $("#password")[0].value;
		document.cookie = "password=" + password;

		$.ajax({
			type: "POST",
			url: "ajax.php?login",
			data: {password: password},
			success: function(res) {
				res = atob(res);

				if(res == "false") {
					alert("Error: Bad password!");
				} else {
					admin = res;
					alert("Welcome, " + admin + "!");
					admintools();
				} 
			}
		});
	}

	function admintools() {
		$("button:contains('Login')").hide();
		$("#password").hide();
		$("#namecolor").show();
		$("#namecolor")[0].value = getRandomColor();
	}

	/* getRandomColor() from https://stackoverflow.com/questions/1484506/random-color-generator-in-javascript */

	function getRandomColor() {
	    var letters = '0123456789ABCDEF'.split('');
	    var color = '#';
	    for (var i = 0; i < 6; i++ ) {
	        color += letters[Math.floor(Math.random() * 16)];
	    }
	    return color;
	}

	$("button:contains('Login')").hide();
	$("#password").hide();
	$("#namecolor").hide()

	$("button:contains('Admin Tools')").click(function() {
		$(this).hide();
		$("button:contains('Login')").show();
		$("#password").show();
	});

	$("button:contains('Login')").click(login);
});
