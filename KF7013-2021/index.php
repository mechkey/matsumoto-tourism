<!DOCTYPE html>
<html lang="en">
<head>
	<?php include './content/php/head.php'; 
	echo makeHead("Matsumoto Tourism - Home");
	?>
</head>
<body>
	<div id="container"> <!-- This container is necessary to make sure the footer stays where it belongs -->
		<p>Page with head</p>
		<?php 
$page = $_SERVER['REQUEST_URI']; 
$page = str_replace('/', '', $page); 
$page = str_replace('.php', '', $page); 
$page = str_replace('?s=', '', $page); 
$page = $page ? $page : 'default'; 
echo $page;
?>
		<main id="content"> <!-- Beginning of page content -->

		</main>

		<footer id="footer"> <!-- Beginning of footer -->

		</footer>
	</div>
</body>
</html>

