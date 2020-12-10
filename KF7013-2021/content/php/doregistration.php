<?php
include 'main.php';

$email 		= filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
$fname 		= $_REQUEST['fname'];
$lname 		= $_REQUEST['lname'];
$addr1		= $_REQUEST['addr1'];
$addr2		= $_REQUEST['addr2'];
$addrcode	= $_REQUEST['addrcode'];
$dob		= $_REQUEST['dob'];
$username	= $_REQUEST['username'];
$password	= $_REQUEST['password'];

$regis = "INSERT INTO customers VALUES (?,?,?,?,?,?,?,?,?)";
$registmt = mysqli_prepare($connection, $regis);
mysqli_stmt_bind_param($registmt, "sssssssss",
	$email 		,
	$fname 		,
	$lname 		,
	$addr1		,
	$addr2		,
	$addrcode	,
	$dob		,
	$username	,
	$password	);
mysqli_stmt_execute($stmt);
header('Location: ../account.php');

?>
