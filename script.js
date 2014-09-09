$(document).ready(function() {

	function send() {
		var username = $("#username")[0].value;
		var text = $("#message")[0].value;

		$.ajax({
			type: "POST",
			url: "ajax.php?send",
			data: {username: username, text: text},
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
				$("#chat").html(res);
				
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

	$("#message").keypress(function(event) {
		if ( event.which == 13 ) {
			event.preventDefault();
			send();
		}
	});

	$("#send").click(send);

	update(true);

});