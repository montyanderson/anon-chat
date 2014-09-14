<?php
session_start();

header("Content-type: text/plain");

date_default_timezone_set("Etc/GMT-1");

ob_start();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$mongo = new Mongo();

$dbname = "anon-chat";
$db = $mongo->$dbname;

$host = str_replace(".", "", $_SERVER["HTTP_HOST"]);
$chat = $db->$host;

$admins = $db->admins;

function totext($html) {
	$text = $html;
	$text = str_replace("<", "&#60", $text);
	$text = str_replace(">", "&#62", $text);
	$text = str_replace("'", "&#39", $text);
	$text = str_replace('"', "&#34", $text);
	return $text;
}

switch($_SERVER["QUERY_STRING"]) {
	case "update":

		$_SESSION["init"] = true;

		$cursor = $chat->find()->sort(array('tstamp' => -1))->limit(50)->skip(0);
		$array = iterator_to_array($cursor);

		$array = array_reverse($array);

		foreach($array as $message) {
			echo date('m/d/Y h:i:s ', $message["tstamp"]);
			echo "<b";

			if(isset($message["namecolor"])) {
				echo " style='color:".$message["namecolor"].";' ";
			}

			echo ">".$message["username"]."</b>: ";

			if(substr($message["text"], 0, 4) == "&#62") {
				echo "<span style='color:#789922;'>";
				echo $message["text"];
				echo "</span><br />";
			} else {
				echo $message["text"]."<br />";
			}

			echo PHP_EOL;
		}
		break;


	case "send":

		$username = totext($_POST["username"]);
		$text = totext($_POST["text"]);

		$namecolor = totext($_POST["namecolor"]);

		if($_SESSION["init"] != true) {
			exit();
		}

		if($username == "" || $text == "") {
			exit();
		}

		if(strlen($username) > 20 || strlen($text) > 100) {
			exit();
		}

		$data = Array();
		$data["username"] = $username;
		$data["text"] = $text;
		$data["ip"] = $_SERVER['REMOTE_ADDR'];

		if($_SESSION["admin"] == true) {
			$data["namecolor"] = $namecolor;
		}

		$data["tstamp"] = time();

		var_dump($chat->insert($data));
		break;

	case "login":

		$password = $_POST["password"];

		$cursor = $admins->find(array("password" => $password));
		$search = iterator_to_array($cursor);

		if(count($search) == 1) {
			foreach($search as $user) {
				$_SESSION["admin"] = true;
				echo $user["name"];
			}
		} else {
			echo "false";
		}
}

$base64 = base64_encode(ob_get_contents());
ob_clean();
echo $base64;
