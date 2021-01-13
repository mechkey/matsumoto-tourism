<?php
	//This file containts the booking logic for inserting SQL 
	session_start();
	include_once 'main.php';

	$debug = true;

	$actID 		= htmlspecialchars($_POST['book']);
	$date  		= htmlspecialchars($_POST['date']);
	$num_tix 	= htmlspecialchars($_POST['num_tix']);
	$user = $_SESSION['username'];

	if (!isset($_SESSION['username'])) {
		header('Location: /kf7013-2021/content/login.php');
	}

	if ($debug) {
		echo 'Activity id is ' . $actID;
		br();
		echo 'Date is ' . $date;
		br();
		echo 'Number of tickets is ' . $num_tix;
		br();
		echo 'User is ' . $user;
		br();
	}

	$b_sql = "UPDATE `booked_activities` SET `date_of_activity` = ?, `number_of_tickets` = ? WHERE customerID = (SELECT customerID FROM customers WHERE username = ?) AND activityID = ?";

	if ($debug) { echo $b_sql; }

	$b_stmt = mysqli_prepare($conn, $b_sql);

	if (mysqli_stmt_bind_param($b_stmt, "sisi", $date, $num_tix, $user, $actID) == true) 
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

		if ($debug) {
			print_r("Error: %s", mysqli_stmt_error($b_stmt));
			echo "<pre>"; 
			print_r($_SESSION); 
			echo "</pre>";
		}
		header('Location: /kf7013-2021/content/account.php');
	}
	/*
	mysqli_stmt_execute($stmt) or die( mysqli_stmt_error($stmt) );
	*/
?>