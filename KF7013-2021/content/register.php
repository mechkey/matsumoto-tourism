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
		<h1> Welcome! Thanks for choosing to sign up.</h1>
		
		<form id="register" method="post" action="/KF7013-2021/content/php/doregistration.php">
			<label for="fname">Fore Name: </label><br />
			<input type="text" id="fname" name="fname" pattern="[A-Za-z ]*" required><br />

			<label for="lname">Last Name:</label><br />
			<input type="text" id="lname" name="lname" pattern="[A-Za-z ]?[']?[A-Za-z ]*" required><br />

			<label for="addr1">Address Line 1:</label><br />
			<input type="text" id="addr1" name="addr1" pattern="[A-Za-z0-9 ]*"><br />
			<label for="addr2">Address Line 2:</label><br />
			<input type="text" id="addr2" name="addr2" pattern="[A-Za-z0-9 ]*"><br />
			<label for="addrcode">Post/Zip code:</label><br />
			<input type="text" id="addrcode" name="addrcode" pattern="[A-Za-z0-9 ]*"><br />

			<label for="dob">Date of Birth:</label><br />
			<input type="date" id="dob" min="1900-01-01" max="2004-01-10" name="dob" required><br />


			<label for="username">Username:</label><br />
			<input type="text" id="usernmae" name="username" pattern="[A-Za-z0-9]*"required><br />

			<label for="password">Password (minimum 8 alphanumeric characters): </label><br />
			<input type="password" id="password" name="password" minlength="8" pattern="[A-Za-z0-9]*" required><br />

			<input type="checkbox" id="gdpr" name="gdpr" value="gdpraccept" required>
			<label for="gdpr">I consent to my details being stored in accordance with GDPR legislation </label><br>

			<input type="submit"	>
		</form>

			
	<?php
	/*
	echo 'SERVER-REQUEST_URI is ' . $_SERVER['REQUEST_URI'];
	br();
	echo 'path is ' . getpath();	
	br();
	*/
	//<label for="email">Email:</label><br />
	//<input type="email" id="email" name="email"><br />
	

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