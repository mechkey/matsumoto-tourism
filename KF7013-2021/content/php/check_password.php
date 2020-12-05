<?php
function check_password ($user, $pwd) {
	global $connection;
	//$pass = SHA1($pwd);
	$pass = $pwd;	
	$sql = "SELECT AdminID from ADMIN where AdminID=? AND password=?";
	$stmt = mysqli_prepare($connection, $sql);
	mysqli_statement_bind_param($stmt, "ss", $user, $pass);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $pwdFromDB);
	// echo "Checkpwd: Username $user, Password >>$pwd<< >>$pass<< OK: >>$ /*cut off*/
	if (mysqli_stmt_fetch($stmt)) {
		return $pwdFromDB;
	} 
	else {
		return false; 
	}


}

?>