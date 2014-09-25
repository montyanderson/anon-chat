var admin;

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
			url: "ajax/send.php",
			data: {username: username, text: text, namecolor: namecolor},
			success: function() {
				update(false);
			}
		});

		$("#message")[0].value = "";
	}

	function update(loop) {
		$.ajax({
			url: "ajax/update.php",
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

	/* setting io  for main functions */

	$("#message").keypress(function(event) {
		if ( event.which == 13 ) {
			event.preventDefault();
			send();
		}
	});

	$("#send").click(send);

	/* admin tools */

	update(true); /* start the chat loop */
});
