$(document).ready(function() {

	var admin = false;

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
		var scroll = true;

		$.ajax({
			url: "ajax.php?update",
			success: function(res) {
				var code = atob(res);
				$("#chat").html(code);
				
				if(scroll == true) {
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

	/* setting io  for main functions */

	$("#message").keypress(function(event) {
		if ( event.which == 13 ) {
			event.preventDefault();
			send();
		}
	});

	$("#send").click(send);

	update(true);

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

	$("button:contains('Login')").hide();
	$("#password").hide();
	$("#namecolor").hide()

	$("button:contains('Admin Tools')").click(function() {
		$(this).hide();
		$("button:contains('Login')").show();
		$("#password").show();
	});

	$("button:contains('Login')").click(login);

	function admintools() {
		$("button:contains('Login')").hide();
		$("#password").hide();
		$("#namecolor").show();
	}

});