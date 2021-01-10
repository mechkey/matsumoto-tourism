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
		<h1> References: </h1>
		<h2> Images: </h2>
		<ul>
			<li><p>Japan Guide, [No date]. <span class="p_ita">Photograph showing Matsumoto Castle and moat.</span> [Online]. [Accessed 07 January 2021]. Available at: https://www.japan-guide.com/</p></li>
			<li><p>Japan Guide, [No date]. Edited by Hemmings, L., 2020. <span class="p_ita">Artistic reinterpretation of photograph showing Matsumoto Castle and moat.</span> [Online]. [Accessed 07 January 2021]. Available at: https://www.kf7013.co.uk</p></li>
			<li><p>Kamikochi, [No date]. <span class="p_ita">A bridge across the Kamikochi Valley river, with snow-covered mountains in the background.</span> [Online]. [Accessed 07 January 2021]. Available at: https://www.kamikochi.org/</p></li>
			<li><p>Visit Matsumoto, 2018. <span class="p_ita">Steam rising from a hot spring with a traditional Japanese wooden building in the background.</span> [Online]. [Accessed 07 January 2021]. Available at:  https://visitmatsumoto.com/en/spot/biwa-no-yu/</p></li>
			<li><p>Visit Matsumoto, 2020. <span class="p_ita">The front door of the Matsumoto Museum of Art with trees nearby.</span> [Online]. [Accessed 07 January 2021]. Available at: https://visitmatsumoto.com/en/spot/matsumoto-museum-of-art/</p></li>
			<li><p>Visit Matsumoto, 2018. <span class="p_ita">The lush garden of Ikegami Hyakuchikutei.</span> [Online]. [Accessed 07 January 2021]. Available at: https://visitmatsumoto.com/en/spot/ikegami-hyakuchikutei/</p></li>
			<li><p>Visit Matsumoto, 2019. <span class="p_ita">The exterior of the Ukiyo-e Museum.</span> [Online]. [Accessed 07 January 2021]. Available at: https://visitmatsumoto.com/en/spot/ukiyoemuseum/</p></li>
			<li><p>Visit Matsumoto, 2018. <span class="p_ita">Four students being instructed on how to play Taiko drums.</span> [Online]. [Accessed 07 January 2021]. Available at:  https://visitmatsumoto.com/en/spot/taiko-drum-workshop/]</p></li>
			<li><p>Wikipedia, 2020. <span class="p_ita">Exterior showing the three stories of Another Castle.</span> [Online]. [Accessed 07 January 2021]. Available at: https://en.wikipedia.org/wiki/Kitsuki_Castle#/media/File:Kitsuki_castle.jpg</p></li>
			<li><p>Japan Guide, [No date]. <span class="p_ita">Bamboo pipes bring the hot spring water into the hot springs at Shirahone Hot Springs.</span> [Online]. [Accessed 07 January 2021]. Available at: https://www.japan-guide.com/
		</ul>
		<h2>Code:</h2>
		<ul><p>
			<li>w3schools. [No date].<span class="p_ita">CSS display Property</span>. [Online]. [Accessed 07 January 2021]. Available at: https://www.w3schools.com/cssref/pr_class_display.asp</li>

			<li>navbar.php: line 19, main.css: lines 19-21. Based on: CSS Tricks. 2018.<span class="p_ita">Centering List Items Horizontally (Slightly Trickier Than You Might Think)</span>. [Online]. [Accessed 07 January 2021]. Available at: https://css-tricks.com/centering-list-items-horizontally-slightly-trickier-than-you-might-think/</li>

			<li>main.css:line 254, 360. Based on: Alligator.io, 2020.<span class="p_ita">Cropping Images in CSS With object-fit</span>. [Online]. [Accessed 07 January 2021]. Available at: https://www.digitalocean.com/community/tutorials/css-cropping-images-object-fit</li>
		</ul></p>
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