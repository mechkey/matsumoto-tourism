<?php
	session_start();
	include './php/dologin.php';
	include './php/layout.php';
	include './php/navbar.php';
	doctype_etc();
?>

<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css"/>
	<?php 
		$filename = ucfirst(basename(__FILE__, ".php")) . " - Matsumoto Tourism";
		makeHead($filename);
	?>
	<script src="../assets/scripts/script.js"></script>
</head>
<body class="<?php classID() ?>">
	<nav id="topnav">
		<?php 
		makeNavBar(); 
		?>
	</nav>
	<main id="content"> <!-- Beginning of page content -->
		<h1>Oops...Are you lost?</h1>
		<h2>You must log in or register to view content:</h2>
		<h3>Login</h3>
		<div class="login">
			<?php
			loginform();
			?>
		</div>
		<!-- Tried to use JavaScript here, couldn't get it to work -->
		<h3>Register</h3>
		<p>Not got an account?</p> <form action="/KF7013-2021/content/register.php"><button id="reg_button">Register here!</button></form>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>