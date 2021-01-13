<?php
	session_start();
	include './php/dologin.php';
	include './php/navbar.php';
	include './php/layout.php';
	logincheck();
	doctype_etc();
?>

<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css"/>
	<?php 
		$filename = ucfirst(basename(__FILE__, ".php")) . " - Matsumoto Tourism";
		makeHead($filename);
	?>
	
</head>
<body class="<?php classID() ?>">
	<nav id="topnav">
		<?php 
		makenav_bar(); 
		?>
	</nav>
	<main id="content"> <!-- Beginning of page content -->
		<div class="logout">

			<p>Are you sure you wish to logout?</p>
			<?php
			$text = ucfirst($text);
			//echo $text;
			$logout = '
				<form id="confirm_logout" method="post" action="/w19041690/kf7013-2021/content/php/dologout.php"><button type="submit"> Confirm</button></form>';
			echo $logout;
			?>
		</div>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>