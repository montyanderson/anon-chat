<?php
header("Content-type: text/plain");

date_default_timezone_set("Etc/GMT-1");

ob_start();

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
		$cursor = $chat->find()->sort(array('tstamp' => 1));
		$array = iterator_to_array($cursor);

		foreach($array as $message) {
			echo date('m/d/Y h:i:s ', $message["tstamp"]);
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

		if(strlen($username) > 20 || strlen($text) > 100) {
			exit();
		}

		$data = Array();
		$data["username"] = $username;
		$data["text"] = $text;
		$data["tstamp"] = time();

		var_dump($chat->insert($data));
}

$base64 = base64_encode(ob_get_contents());
ob_clean();
echo $base64;