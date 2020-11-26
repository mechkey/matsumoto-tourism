<?php


function makeNavBar ($headerText) {
	$navContent = <<<NAV
	<nav class="topnav">
		<ul>
			<li><a href="index.html" id="current"><b>1</b></a></li>
			<li><a href="2.html">2</a></li>
			<li><a href="3.html">3</a></li>
			<li><a href="4.html">4</a></li>
			<li><a href="5.html">5</a></li>
			<li><a href="6.html">6</a></li>
			<li><a href="7.html">7</a></li>
		</ul>
	</nav>

	NAV;
	return $navContent;
}

?>