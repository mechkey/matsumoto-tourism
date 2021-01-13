<?php
	session_start();
	include_once 'main.php';
	include 'dologin.php';

	$fname 		= htmlspecialchars(trim($_POST['fname']));
	$lname 		= htmlspecialchars(trim($_POST['lname']));
	$addr1		= htmlspecialchars(trim($_POST['addr1']));
	$addr2		= htmlspecialchars(trim($_POST['addr2']));
	$addrcode	= htmlspecialchars(trim($_POST['addrcode']));
	$dob		= htmlspecialchars(trim($_POST['dob']));
	$username	= htmlspecialchars(trim($_POST['username']));
	$password	= htmlspecialchars(trim($_POST['password']));
	$passwordha	= password_hash($password, PASSWORD_DEFAULT);

	/*
	$usrnamecheck = "SELECT 1 FROM customers WHERE username=?";
	$uncstmt = mysqli_prepare($conn, $usrnamecheck);
	mysqli_stmt_bind_param($uncstmt, "s", $username);
	mysqli_stmt_execute($uncstmt);
	*/

	//if (mysqli_affected_rows($conn) == 0) {
		$check = "SELECT `username` FROM customers WHERE `username` = ?";

		if ($cstmt = mysqli_prepare($conn, $check)) {
			mysqli_stmt_bind_param($cstmt, 's', $username);
			mysqli_stmt_execute($cstmt);

			$check_res = mysqli_stmt_get_result($cstmt);
			if (mysqli_num_rows($check_res) > 0) {
				echo 'Username already exists, please go back and try again.';
			} else {
				$sql = "INSERT INTO `customers` (`username`, `password_hash`, `customer_forename`, `customer_surname`, `customer_postcode`, `customer_address1`, `customer_address2`, `date_of_birth`) VALUES (?,?,?,?,?,?,?,?)";

				$stmt = mysqli_prepare($conn, $sql);

				mysqli_stmt_bind_param($stmt, "ssssssss", $username, $passwordha, $fname, $lname, $addrcode, $addr1, $addr2, $dob);
				/*
				mysqli_stmt_execute($stmt) or die( mysqli_stmt_error($stmt) );
				header('Location: /KF7013-2021/content/ account.php');
				*/
				$result = mysqli_stmt_execute($stmt);
				if ($result) {

					login($username, $passwordha);
				    $_SESSION['username'] = $username;
					header('Location: /KF7013-2021/content/account.php');
				} else {
					echo 'pass not ok i gues';
				}
			}
		}
				


		/*} else {
			echo "Username exists. Please try again.";
			header('Location: /KF7013-2021/ content/register.php');
		}*/

		 

?>
