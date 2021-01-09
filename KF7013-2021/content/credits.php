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
		makenav_bar(); 
		?>
	</nav>
	<main id="content"> <!-- Beginning of page content -->
		<h1> References: </h1>
		<ul>
			<li><p>[No date]. 1.jpg, logo.png, logogray.png https://www.japan-guide.com/</p></li>
			<li><p>[No date].  [Online]. [Accessed 07 January 2021]. Available at: https://www.kamikochi.org/</p></li>
			<li><p>2018. 3.jpg . [Online]. [Accessed 07 January 2021]. Available at:  https://visitmatsumoto.com/en/spot/biwa-no-yu/</p></li>
			<li><p>2020. 4.jpg . [Online]. [Accessed 07 January 2021]. Available at: https://visitmatsumoto.com/en/spot/matsumoto-museum-of-art/</p></li>
			<li><p>2018. 5.jpg . [Online]. [Accessed 07 January 2021]. Available at: https://visitmatsumoto.com/en/spot/ikegami-hyakuchikutei/</p></li>
			<li><p>2019. 6.jpg . [Online]. [Accessed 07 January 2021]. Available at: https://visitmatsumoto.com/en/spot/ukiyoemuseum/</p></li>
			<li><p>2018. 7.jpg . [Online]. [Accessed 07 January 2021]. Available at:  https://visitmatsumoto.com/en/spot/taiko-drum-workshop/]</p></li>
			<li><p>2020. 8.jpg [Online]. [Accessed 07 January 2021]. Available at: https://en.wikipedia.org/wiki/Kitsuki_Castle#/media/File:Kitsuki_castle.jpg</p></li>
		</ul>
		<h2>Code</h2>
		<ul>
			<li>w3schools. [No date].<span class="p_ita">CSS display Property</span>. [Online]. [Accessed 07 January 2021]. Available at: https://www.w3schools.com/cssref/pr_class_display.asp</p></li>

			<li>navbar.php: line 19, main.css: lines 19-21. Based on: CSS Tricks. 2018.<span class="p_ita">Centering List Items Horizontally (Slightly Trickier Than You Might Think)</span>. [Online]. [Accessed 07 January 2021]. Available at: https://css-tricks.com/centering-list-items-horizontally-slightly-trickier-than-you-might-think/</li>

			<li>main.css:line 254, 360. Based on: Alligator.io, 2020.<span class="p_ita">Cropping Images in CSS With object-fit</span>. [Online]. [Accessed 07 January 2021]. Available at: https://www.digitalocean.com/community/tutorials/css-cropping-images-object-fit</li>
		</ul>
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