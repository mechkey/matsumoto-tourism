<?php
	session_start();
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
		makeNavBar(); 
		?>
	</nav>
	<main id="content"> <!-- Beginning of page content -->
		<h1> References: </h1>
		<p>1.jpg, logo.png, logogray.png https://www.japan-guide.com/e/e6050.html
		
		2.jpg https://www.kamikochi.org/images/top_ss4.jpg
		3.jpg https://i1.wp.com/visitmatsumoto.com/wp-content/uploads/2018/03/asama749-1.jpg https://visitmatsumoto.com/en/spot/biwa-no-yu/
		4.jpg https://visitmatsumoto.com/en/spot/matsumoto-museum-of-art/
		https://i2.wp.com/visitmatsumoto.com/wp-content/uploads/2018/01/MCM_mainVisiual.jpg
		5.jpg https://visitmatsumoto.com/en/spot/ikegami-hyakuchikutei/
		https://i1.wp.com/visitmatsumoto.com/wp-content/uploads/2018/03/IMG_9654.jpg
		6.jpg https://visitmatsumoto.com/en/spot/ukiyoemuseum/
		https://i1.wp.com/visitmatsumoto.com/wp-content/uploads/2018/01/8102879a1708d8a8de1f2a9b31a51c34.jpg
		7.jpg https://visitmatsumoto.com/en/spot/taiko-drum-workshop/]
		8.jpg https://www.visitscotland.com/info/tours/the-viking-coast-and-alnwick-castle-a47c9e94
		https://d1xw84ija6gjgy.cloudfront.net/production/c96c08f8bb7960e11a1239352a479053/conversions/SD.jpg

		<h1>Code</h1>
		
		CSS display Property

		https://www.w3schools.com/cssref/pr_class_display.asp
		--

		Based on: 

		Centering List Items Horizontally (Slightly Trickier Than You Might Think)

		https://css-tricks.com/centering-list-items-horizontally-slightly-trickier-than-you-might-think/#:~:text=Just%20give%20the%20list%20centered,width%3A%20fit%2Dcontent%3B%20.
		--


		</p>
		<?php 
		?>
	</main>
	<footer id="footer"> <!-- Beginning of footer -->
		<?php
			makeFooter();
		?>
	</footer>
</body>
</html>