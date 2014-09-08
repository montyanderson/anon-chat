$(document).ready(function() {

	function send() {
		var username = $("#username")[0].value;
		var text = $("#message")[0].value;

		$.ajax({
			type: "POST",
			url: "ajax.php?send",
			data: {username: username, text: text},
			success: function() {}
		});

		$("#message")[0].value = "";
	}

	function update() {
		$.ajax({
			url: "ajax.php?update",
			success: function(res) {
				$("#chat").html(res);
				
				setTimeout(function() {
					update();
				}, 1000);
			}
		});
	}

	$("#send").click(send);

	update();

});