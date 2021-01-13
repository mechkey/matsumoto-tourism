<?php
	session_start();
	session_unset();
	session_destroy();
	header('Location: /w19041690/kf7013-2021/index.php');
?>