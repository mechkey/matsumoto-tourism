<?php
	//This file containts the booking logic for inserting SQL 
	session_start();
	include_once 'main.php';

	if (!isset($_SESSION['username'])) {
		header('Location: /KF7013-2021/content/login.php');
	}

	$debug = false;

	$actID 	= htmlspecialchars($_GET['delete_id']);
	$user = $_SESSION['username'];

	if($debug) {
		echo 'actid is: '. $actID;
		echo 'user is: ' . $user;
	}

	$b_sql = "DELETE FROM `booked_activities` WHERE customerID = (SELECT customerID FROM customers WHERE username = ?) AND activityID = ?";

	if ($debug) { echo $b_sql; }

	$b_stmt = mysqli_prepare($conn, $b_sql);

	if (mysqli_stmt_bind_param($b_stmt, "si", $user, $actID) == true) 
	{ 
		if ($debug) {
			echo 'bind param complete';	
		}
	} else {
		if ($debug) {
			echo 'bind param failed';
		}
	}
	//
	if (mysqli_stmt_execute($b_stmt)) {
		$temp = '';
		if ($debug) {
			print_r("Error: %s", mysqli_stmt_error($b_stmt));
			echo "<pre>"; 
			print_r($_SESSION); 
			echo "</pre>";
		}
		header('Location: /KF7013-2021/content/account.php');
	}
	
	
	?>
	