<?php
	session_start();
	session_unset();
	session_destroy();
	header('Location: /KF7013-2021/index.php');
?>