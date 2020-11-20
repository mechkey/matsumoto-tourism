<?php
	require_once 'webFunc.php';
	$conn = getConn();
	if($conn === false) {
		echo "<p>Connection failed:" . mysqli_connect_error() . " </p>\n";
	}

?>
