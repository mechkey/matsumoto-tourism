<?php
	include 'main.php';
	session_start();
	session_regenerate_id();


	$user = htmlspecialchars($_REQUEST['username']);
	$pass =  htmlspecialchars($_REQUEST['password']);

	/*
	$pass = 'password';
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	$check = password_verify($pass, $hash);
	echo $check;

	if(check) {
		echo 'check is 1/true';
	}
*/



	function check_pass ($user, $pass) {
		global $conn;
		//$pass = SHA1($pass);
		//$pass = $pass;	
		$sql = "SELECT `password_hash` FROM `customers` WHERE `username`=?";
		//echo $sql;
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $user);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $DBpass);
			// echo "Checkpass: Username $user, Password >>$pass<< 
			if (mysqli_stmt_fetch($stmt)) 
			{
				$passok = password_verify($pass, $DBpass);
				if ($debug) {echo 'returning passok . . .';}
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


	if (array_key_exists('username', $_REQUEST) && (array_key_exists('password', $_REQUEST)) ) {
		$passok = check_pass($user, $pass); //check_pass function
		if ($passok == 1) 
	    {
	        $_SESSION['username'] = $_REQUEST['username'];
	        if ($debug) {
	            echo '<br />Success '; 
	            echo '<br />Username: $user';
				echo '<br />Password: >>$pass<< <br />';
				echo 'OK: >>$passok<< <br />';
	        }
	        else {
	            header('Location: /KF7013-2021/content/account.php');
	        }
	    }
	    else { // == if passok is false
	        if ($debug)
	        {
	            echo "<p>Failed - Username $user, Password: >>$pass<< </p>";
				echo "OK: >>$passok<< (not ok if empty) <br />";
	        }
	        else {
	            header('Location: /KF7013-2021/content/login.php');
	        }
	    }
	}
	else { // == if array key does not exist
	    if ($debug){
	        echo("Array key username does not exist,<br />");
	    }
	    else
	    {
	        header('Location: /KF7013-2021/content/login.php');
	    }
	}

?>
