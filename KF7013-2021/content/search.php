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
	<?php
	
	$h1string = '<h1>';
	if (isset($_GET['search']) && $_GET['search'] != '' ) {
		$h1string .= "Search results for '{$_GET['search']}' ";
		
		if ((isset($_GET['search']) && $_GET['search'] != '' ) && (isset($_GET['exclude']) && $_GET['exclude'] != '' )) {
			$h1string .= ", excluding results for '{$_GET['exclude']}'";
		}
	} else if (isset($_GET['exclude']) && $_GET['exclude'] != '' ) {
		$h1string .= "Excluding results for '{$_GET['exclude']}'";
	}

	if (isset($_GET['search']) || isset($_GET['exclude'])) {
		$h1string .= ":</h1>";
		echo $h1string;
	}
	if (!(isset($_GET['search']) || isset($_GET['exclude'])) ) {
		echo '<h1>Please enter a search term: </h1>';
	}
	

	searchbar();

	if (isset($_GET['search']) && $_GET['search'] != '' )
		search_res(true);
	else if (isset($_GET['exclude']) && $_GET['exclude'] != '' )
		search_res(false,true);
	else if (
			isset($_GET['search'])  && 
			isset($_GET['exclude']) &&
			$_GET['search'] != ''   &&
			$_GET['exclude'] != ''  )
		search_res(true, true);
	else {
		search_res(false, false, true);
	}
	?>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>