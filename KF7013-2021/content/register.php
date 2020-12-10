
<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../assets/stylesheets/main.css">
	<?php 
	include './php/head.php';
	include './php/navbar.php';
	echo makeHead("Matsumoto Tourism - Registration");
	?>
</head>
<body class="<?php classID() ?>">
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<nav id="topnav">
			<?php 
			makeNavBar(); 
			?>
		</nav>
		<main id="content"> <!-- Beginning of page content -->
			
			<form id="register" method="post" action="/content/php/doregistration.php">
				<label for="email">Email:</label><br />
				<input type="email" id="email" name="email"><br />

				<label for="fname">Fore Name:</label><br />
				<input type="text" id="fname" name="fname"><br />

				<label for="lname">Last Name:</label><br />
				<input type="text" id="lname" name="lname"><br />

				<label for="addr1">Address Line 1:</label><br />
				<input type="text" id="addr1" name="addr1"><br />
				<label for="addr2">Address Line 2:</label><br />
				<input type="text" id="addr2" name="addr2"><br />
				<label for="addrcode">Post/Zip code:</label><br />
				<input type="text" id="addrcode" name="addrcode"><br />

				<label for="dob">Date of Birth:</label><br />
				<input type="date" id="dob" name="dob"><br />


				<label for="uname">Username:</label><br />
				<input type="text" id="uname" name="uname"><br />

				<label for="password">Password:</label><br />
				<input type="password" id="password" name="password"><br />
				<input type="submit"	>

			</form>

				
		<?php
		echo 'SERVER-REQUEST_URI is ' . $_SERVER['REQUEST_URI'];
		br();
		echo 'path is ' . getpath();	
		br();

		

		?>
			
			</div>
		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

