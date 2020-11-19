<?php

function getConn() {
	$conn = mysqli_connect ('localhost', 'root', 'root', 'zoo');
	if($conn) {
		mysqli_set_charset($conn, 'utf8');
	}
	return $conn;
}

?>
