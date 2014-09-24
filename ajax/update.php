<?php
include(dirname(dirname(__FILE__)) . "/inc/init.php");

$_SESSION["init"] = true;

$cursor = $chat->find()->sort(array('tstamp' => -1))->limit(50)->skip(0);
$array = iterator_to_array($cursor);

$array = array_reverse($array);

foreach($array as $message) {
	echo date('m/d/Y H:i:s ', $message["tstamp"]);
	echo "<b";

	if(isset($message["namecolor"])) {
		echo " style='color:".$message["namecolor"].";' ";
	}

	echo ">".$message["username"]."</b>: ";

	$temp = explode("http", $message["text"]);

	if(count($temp) > 1) {
		$temp = explode(" ", $temp[1]); /* remove any words after it */
		$message["text"] = "<a href='http" . $temp[0] . "'>http" . $temp[0] . "</a>";
	}

	if(substr($message["text"], 0, 4) == "&#62") {
		echo "<span style='color:#789922;'>";
		echo $message["text"];
		echo "</span><br />";
	} else {
		echo $message["text"]."<br />";
	}

	echo PHP_EOL;
}

include(dirname(dirname(__FILE__)) . "/inc/base64.php");