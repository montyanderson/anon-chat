<?php
include(dirname(dirname(__FILE__)) . "/inc/init.php");

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

include(dirname(dirname(__FILE__)) . "/inc/base64.php");