<?php
	session_start();
	session_unset();
	session_destroy();
	header('Location: /kf7013-2021/index.php');
?>