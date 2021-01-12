<?php
	session_start();
	include './php/dologin.php';
	include './php/navbar.php';
	include './php/layout.php';

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
		<h1>Welcome! Please log in below.</h1>
		<div class="login">
			<?php
			login_form();
			?>
		</div>
		<p>Not got an account?</p> <form method="get" action="/KF7013-2021/content/register.php"><button>Register here</button></form>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>