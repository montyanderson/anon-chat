<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$mongo = new Mongo();

$db = $mongo->chatv4;
$chat = $db->main;

function totext($html) {
	$text = $html;
	$text = str_replace("<", "&#60", $text);
	$text = str_replace(">", "&#62", $text);
	return $text;
}

switch($_SERVER["QUERY_STRING"]) {
	case "update":
		$cursor = $chat->find();
		$array = iterator_to_array($cursor);

		foreach($array as $message) {
			echo "<b>".$message["username"]."</b>: ";
			echo $message["text"]."<br />";
			echo PHP_EOL;
		}
		break;


	case "send":

		$username = totext($_POST["username"]);
		$text = totext($_POST["text"]);

		if($username == "" || $text == "") {
			exit();
		}

		$data = Array();
		$data["username"] = $username;
		$data["text"] = $text;

		var_dump($chat->insert($data));
}

