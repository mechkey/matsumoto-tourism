<?php
	session_start();
	session_regenerate_id();
	include_once 'main.php';

	//$user = isset($_POST['username']) ?? '';
	//$pass = isset($_POST['password']) ?? '';
	$user = htmlspecialchars(trim($_POST['username']));
	$pass = htmlspecialchars(trim($_POST['password']));
	/*
	if ($user != '') {
		$user = htmlspecialchars(trim($user));
	}
	if ($user != '') {
		$pass = htmlspecialchars(trim($pass));
	}*/

	/*$conn = mysqli_connect ('localhost', 'root', 'root', 'travel');
	if ($conn) {
		mysqli_set_charset($conn, 'utf8');
	}

	if ($conn === false) {
		echo "<p>conn failed:" . mysqli_connect_error() . " </p>\n";
	} */

	login($user, $pass);

	function check_pass ($user, $pass) {
		global $debug;
		global $conn;
		$sql = "SELECT `password_hash` FROM `customers` WHERE `username`=?";
		//echo $sql;
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $user);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $DBpass);
			if (mysqli_stmt_fetch($stmt)) 
			{
				$passok = password_verify($pass, $DBpass);
				if ($debug) {echo 'returning passok . . .' . $passok;}
				return $passok;
			} 
			else 
			{
				if ($debug) {echo 'mysqli_stmt_fetch($stmt) FAILED';}
				return false; 
			}
		} else {
			echo "<p>echoed Unable to prepare statement</p>";
			return false;
		}
	}

	function login ($user, $pass) {
		global $debug;
		if (array_key_exists('username', $_POST) && (array_key_exists('password', $_POST)) ) {
			$passok = check_pass($user, $pass); //check_pass function
			if ($passok == 1) 
		    {
		        $_SESSION['username'] = $user;
		        if ($debug) {
		            echo '<br />Username is $user';
					echo '<br />Password is >>$pass<< <br />';
					echo 'OK: >>$passok<< <br />';
		        } else {
		            header('Location: /KF7013-2021/content/account.php');
		        }
		    } else { // == if passok is false
		        if ($debug) {
		            echo "<p>Failed - Username $user, Password: >>$pass<< </p>";
					echo "OK: >>$passok<< (not ok if empty) <br />";
		        } else {
		            echo 'Username and/or password incorrect. Please try <a href="/KF7013-2021/content/login.php">login</a> again.';
		            //header('Location: /KF7013-2021/content/login.php');
		        }
		    }
		}
		else { // == if array keys do not exist
		    if ($debug) {
		        echo("Array key username or pass  does not exist,<br />");
		    } else {
		        //header('Location: /KF7013-2021/content/login.php');
		    }
		}
	}

	function logincheck() {
		if (!isset($_SESSION['username'])) 
			header('Location: /KF7013-2021/content/lost.php');
		//exit();
	}




?>
