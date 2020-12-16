<?php
session_start();
include 'main.php';

$fname 		= htmlspecialchars($_REQUEST['fname']);
$lname 		= htmlspecialchars($_REQUEST['lname']);
$addr1		= htmlspecialchars($_REQUEST['addr1']);
$addr2		= htmlspecialchars($_REQUEST['addr2']);
$addrcode	= htmlspecialchars($_REQUEST['addrcode']);
$dob		= htmlspecialchars($_REQUEST['dob']);
$username	= htmlspecialchars($_REQUEST['username']);
$password	= htmlspecialchars($_REQUEST['password']);
$passwordha = password_hash($password, PASSWORD_DEFAULT);

/*
$usrnamecheck = "SELECT 1 FROM customers WHERE username=?";
$uncstmt = mysqli_prepare($conn, $usrnamecheck);
mysqli_stmt_bind_param($uncstmt, "s", $username);
mysqli_stmt_execute($uncstmt);
*/

//if (mysqli_affected_rows($conn) == 0) {
	$sql = "INSERT INTO `customers` (`username`, `password_hash`, `customer_forename`, `customer_surname`, `customer_postcode`, `customer_address1`, `customer_address2`, `date_of_birth`) VALUES (?,?,?,?,?,?,?,?)";

	$stmt = mysqli_prepare($conn, $sql);

	mysqli_stmt_bind_param($stmt, "ssssssss", $username, $passwordha, $fname, $lname, $addrcode, $addr1, $addr2, $dob);
	/*
	mysqli_stmt_execute($stmt) or die( mysqli_stmt_error($stmt) );
	header('Location: /KF7013-2021/content/ account.php');
	*/
	if(mysqli_stmt_execute($stmt))
	{

		header('Location: /KF7013-2021/content/php/dologin.php');
	}
	else
	{
		echo 'error';
	}

/*} else {
	echo "Username exists. Please try again.";
	header('Location: /KF7013-2021/ content/register.php');
}*/

 

?>
