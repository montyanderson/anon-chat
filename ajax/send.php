<?php
include(dirname(dirname(__FILE__)) . "/inc/init.php");

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

include(dirname(dirname(__FILE__)) . "/inc/base64.php");