$(document).ready(function() {

	function login() {
		var password = $("#password")[0].value;
		document.cookie = "password=" + password;

		$.ajax({
			type: "POST",
			url: "ajax/login.php",
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