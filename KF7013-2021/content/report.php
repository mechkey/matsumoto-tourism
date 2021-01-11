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
		<div id="essay">
			<h1>Security Report</h1>
			<h2>Introduction</h2>
			<p>This security report will discuss the steps taken to secure the Matsumoto Tourism website. These steps fall under the following categories: secure login, cross-site scripting defense, and protection against SQL injection attacks. The significance of these topics and the repercussions of insufficient action to secure the server against these threats will be discussed. Finally, this report will also outline further security features that could be added, were this project to be extended.</p>

			<h2>Defenses against cross-site scripting</h2>
			<p>Cross-site scripting (XSS) is an attack using JavaScript and directed at website users rather than the website itself (Klein, 2002). When victims click on a purpose-made link, their data, often including login details or cookies, are sent to the attacker’s server. Additionally, the user may not be aware of the attack, as the attacker can use the victim’s login details to log them in as normal. This can allow the hacker to impersonate the user on the vulnerable website, or access private information. Protecting against XSS is important as these attacks are prevalent, with 94% of applications tested during 2007 and 2011 showing vulnerability to XSS attacks (Stuttard and Pinto, 2011). XSS attacks were protected against by sanitising inputs using the function htmlspecialchars() to encode special characters as HTML entities. This converts special characters such as < and > to &lt and &gt, respectively (Klein, 2002; Php.net, N.D.). This function was used in the dologin.php and doregistration.php pages. While an advantage of this approach is that unsanitized code does not reach your application, the downsides are that it requires extensive knowledge of security and the need to secure every input source (Klein, 2002).</p>

			<p>Had the scope of this project been wider, I could have implemented a combination of filtering along with the encoding discussed. Filtering is similar to encoding, but removes rather than neutralises special characters. However, one disadvantage is that it may eliminate desired characters, for example on a blogging site that allows formatting such as &ltb&gt and &lti&gt. Another form of sanitisation I could have implemented is validation. Validation compares the input to a whitelist or regular expression that contains permitted characters. However, it is difficult to ensure that all dangerous characters for a given situation are removed, as regular expressions are onerous. This is discussed by Wassermann and Su, who state that a common source of security issues is: “the improper validation of user inputs.” (2004, p. 1). Therefore, validation and filtering were not used.</p>

			<h2>Defenses against SQL injection attacks (SQLIA)</h2>
			<p>An SQL injection attack (SQLIA) is when an attacker modifies an SQL query to gain unauthorised access to database information (Clarke, 2005; Halfond and Orso, 2005). This can allow an attacker to read, add, modify or delete parts of the database. This is typically done by using an escape character such as a single quote as in this example: Robert'); DROP TABLE students;-- (XKCD, n.d.). In this example, if the input is not sanitised enrolling Robert would cause the database to drop the students table. Halfond et al. highlighted the importance of protecting against SQLIA as if the attacker compromises a web application, they may gain access to all supporting databases (n.d.). I have protected against SQLIA by using parameterised PHP prepared SQL statements in the functions act_info_array(), act_book() and booked_act() which list some or all of the activities available. This is a safer way of segregating data and SQL syntax (Dahse and Holz, p. 62). One disadvantage of this approach is that it does not protect against SQLIA when the user supplies a column name (Stuttard and Pinto, 2011). Given more time, I would implement three improvements. Firstly, removing all default database functionality that is not required. Secondly, creating a whitelist to validate against allowed column names. Finally, creating stored procedures to verify authorisation of access and validate data.</p>

			<h2>Secure login</h2>
			<p>Ensuring secure login is important as the privacy of users must be protected. Secure login is built on the Hypertext Transfer Protocol (HTTP) which is stateless, meaning pages are not connected together (Ullman, 2012, p. 367). Maintaining state is important for security as it allows the user to login securely once, and stay logged in until they close the browser window, or log out (Murphey, 2005). There are two ways of enabling state using PHP: cookies and sessions. Both are secure mechanisms that allow a server to remember a user from one HTTP request to another (Suehring and Valade, 2013). Sessions are the more secure approach of the two as they are based on the server, whereas cookies are stored in the client’s web browser (Ullman, 2012, p. 367). The significant disadvantage of sessions is that they can be hijacked, allowing an attacker to present themself as the legitimate user (Murphy, 2005). However, a disadvantage of cookies is that they can be stolen and used by the thief to perform a Cross-site Request Forgery attack, which is similar to PHP hijacking, but easier to perform (LaCroix et al., 2017). This suggests PHP sessions are more secure. Therefore, PHP sessions were used to maintain users’ state, prevent unauthorised users from accessing protected web pages, and prevent continued access when an authorised user has logged out.</p>

			<p>Additionally, hashing passwords is important for secure login as it prevents them from being viewed or copied, while allowing them to be compared with an input when a user logs in (Ullman, 2012). If passwords are not protected by hashing, attackers could attempt to use the login details to compromise users’ accounts on other sites, as users often reuse passwords (Das et al., 2014). Therefore, among websites that a user has a single password for, their accounts’ security is limited to that of the weakest site (ibid.). Hence, I have stored passwords as a hash.</p>

			<h2>Conclusion</h2>
			<p>This security report has outlined the steps taken to ensure the security of the Matsumoto Tourism website. This has been approached through the three key areas of defending against cross-site scripting, protecting against SQL injection attacks, and secure login. This report has established the importance of these areas of security and outlined the consequences of inadequate protection against XSS, such as compromised personal details, and SQLI attacks, such as complete access to the database system. Finally, this report has detailed additional features that could further increase security, if the scope of the project were broadened.</p>

			<aside>Word Count excluding citations: 992</aside>
			<h2>References</h2> 
			<ul>
				<li class="ref">Clarke, J., 2009. SQL Injection Attacks and Defense. Netherlands: Elsevier Science.</li>

				<li class="ref">Dahse, J. and Holz, T., 2015. Experience report: An empirical study of PHP security mechanism usage. <span class="p_ita">In Proceedings of the 2015 International Symposium on Software Testing and Analysis</span>, pp. 60-70.</li>

				<li class="ref">Das, A., Bonneau, J., Caesar, M., Borisov, N. and Wang, X., 2014. The tangled web of password reuse. <span class="p_ita">In NDSS 14(2014)</span>, pp. 23-26.</li>

				<li class="ref">Doyle, M. and Walden, J., 2011. September. An empirical study of the evolution of PHP web application security. <span class="p_ita">In 2011 Third International Workshop on Security Measurements and Metrics</span>, pp. 11-2</li>

				<li class="ref">Halfond, W.G. and Orso, A., 2005. AMNESIA: analysis and monitoring for NEutralizing SQL-injection attacks. <span class="p_ita">In Proceedings of the 20th IEEE/ACM international Conference on Automated software engineering</span>, pp. 174-183.</li>

				<li class="ref">Halfond, W.G., Viegas, J. and Orso, A., 2006, March. A classification of SQL-injection attacks and countermeasures. <span class="p_ita">In Proceedings of the IEEE international symposium on secure software engineering,</span>, 1, pp. 13-15.</li>

				<li class="ref">Klein, A., 2002. Cross site scripting explained. <span class="p_ita">Sanctum White Paper</span>, pp. 1-7.</li>

				<li class="ref">LaCroix, K., Loo, Y.L. and Choi, Y.B., 2017. Cookies and sessions: a study of what they are, how they work and how they can be stolen. <span class="p_ita">In 2017 International Conference on Software Security and Assurance (ICSSA)</span>, pp. 20-24.</li>

				<li class="ref">Meier, J.D., 2006. Web application security engineering. <span class="p_ita">IEEE Security & Privacy</span>, 4(4), pp. 16-24.</li>

				<li class="ref">Murphey, L., 2005. Secure Session Management: Preventing Security Voids in Web Applications. <span class="p_ita">The SANS Institute.</span>,</li>

				<li class="ref">Php.net. [No date]. <span class="p_ita">Htmlspecialchars.</span>, [Online]. [Accessed 08 January 2021]. Available from: https://www.php.net/manual/en/function.htmlspecialchars.php</li>

				<li class="ref">Suehring, S. and Valade, J., 2013. <span class="p_ita">PHP, MySQL, JavaScript and HTML5 All-In-One for Dummies.</span> John Wiley & Sons, Incorporated, Somerset. [Online]. [Accessed 11 January 2021]. Available from: ProQuest Ebook Central.</li>

				<li class="ref">Stuttard, D. and Pinto, M., 2011. <span class="p_ita">The web application hacker's handbook: Finding and exploiting security flaws.</span> John Wiley & Sons.</li>

				<li class="ref">Ullman. L., 2012. <span class="p_ita">PHP and MySQL for Dynamic Web Sites.<span class="p_ita"> Fourth Edition. Berkeley, CA, USA: Peachpit Press.</li>

				<li class="ref">Wassermann, G. and Su, Z., 2004. An analysis framework for security in web applications. <span class="p_ita">In Proceedings of the FSE Workshop on Specification and Verification of component-Based Systems (SAVCBS 2004)</span>, pp. 70-78.</li>

				<li class="ref">XKCD. [No date]. <span class="p_ita">Exploits of a Mom.</span> [Online]. [Accessed 08 January 2021]. Available from: https://xkcd.com/327/</li>

		</div>


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