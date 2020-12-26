<?php
	session_start();
	include './php/head.php';
	include './php/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css"/>
	<?php 
	echo makeHead("Matsumoto Tourism - Registration");
	?>
</head>
<body class="<?php classID() ?>">
	<nav id="topnav">
		<?php 
		makeNavBar(); 
		?>
	</nav>
	<main id="content"> <!-- Beginning of page content -->
		
		<form id="register" method="post" action="/KF7013-2021/content/php/doregistration.php">
			<label for="fname">Fore Name:</label><br />
			<input type="text" id="fname" name="fname" required><br />

			<label for="lname">Last Name:</label><br />
			<input type="text" id="lname" name="lname" required><br />

			<label for="addr1">Address Line 1:</label><br />
			<input type="text" id="addr1" name="addr1"><br />
			<label for="addr2">Address Line 2:</label><br />
			<input type="text" id="addr2" name="addr2"><br />
			<label for="addrcode">Post/Zip code:</label><br />
			<input type="text" id="addrcode" name="addrcode"><br />

			<label for="dob">Date of Birth:</label><br />
			<input type="date" id="dob" name="dob" required><br />


			<label for="username">Username:</label><br />
			<input type="text" id="usernmae" name="username" required><br />

			<label for="password">Password:</label><br />
			<input type="password" id="password" name="password" pattern=".{8,}" required><br />

			<input type="checkbox" id="gdpr" name="gdpr" value="gdpraccept" required>
			<label for="gdpr">I consent to my details being stored in accordance with GDPR legislation </label><br>

			<input type="submit"	>
		</form>

			
	<?php
	echo 'SERVER-REQUEST_URI is ' . $_SERVER['REQUEST_URI'];
	br();
	echo 'path is ' . getpath();	
	br();

	//<label for="email">Email:</label><br />
	//<input type="email" id="email" name="email"><br />
	

	?>
		
		</div>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		makeFooter();
	</footer>
</body>
</html>
