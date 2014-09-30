<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
	<head>

		<title>anon-chat - <?php echo $domain; ?></title>

		<meta charset="utf-8" />

		<link href="//fonts.googleapis.com/css?family=Roboto|Ubuntu" rel="stylesheet" />
		<link href="css/style.css" rel="stylesheet" />

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-1.11.1.min.js"><\/script>')</script>
		<script src="js/jquery.lettering.js"></script>
		<script src="js/init.js"></script>
		<script src="js/script.js"></script>
		<script src="js/admintools.js"></script>

	</head>
	<body>

		<h1>anon-chat</h1>
		<h2><?php echo $domain; ?></h2>

		<section id="chat"></section>

		<section id="input">
			<input id="username" placeholder="Username" maxlength="20" />
			<input id="message" placeholder="Message" maxlength="100" />
			<button id="send">Go!</button>
			<input type="checkbox" id="autoscroll" value="scroll" checked><p>Auto Scroll</p>
		</section>

		<section id="admintools">
			<button>Admin Tools</button>
			<input type="password" id="password" />
			<button>Login</button>
			<input type="color" value="#ff0000" id="namecolor">
		</section>

		<section id="footer">
			<h3>Copyright &copy; <a href="http://tonyblokes.tk" id="copyright">M.J.A</a>, <?php echo date("Y"); ?></h3>
		</section>

	</body>
</html>
