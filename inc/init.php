<?php
session_start();

header("Content-type: text/plain");

date_default_timezone_set("Etc/GMT-1");

ob_start();

if($_SERVER["HTTP_HOST"] == "localhost") {
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
}

/* connect to database */

$mongo = new Mongo();

$dbname = "anon-chat";
$db = $mongo->$dbname;

$host = str_replace("-", "", str_replace(".", "", $_SERVER["HTTP_HOST"]));
$chat = $db->$host; /* use a collections per domain */

$admins = $db->admins;

function totext($html) {
	$text = $html;
	$text = str_replace("£", "&pound;", $text); /* £ is the only symbol that chrome doesn't show */
	$text = str_replace("<", "&#60", $text);
	$text = str_replace(">", "&#62", $text);
	$text = str_replace("'", "&#39", $text);
	$text = str_replace('"', "&#34", $text);
	return $text;
}