<?php
If the page is locat
	if (preg_match('/content/', $path) ) {
		echo '<li><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></li>';
		}
	else {
		echo '<li><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></li>';
	s	}



echo 'login logout path stuff <br />';

				$pathcopy = getpath();
				$loginoutpath = '';

				if (preg_match('/content/', $pathcopy)) {
						$loginoutpath = './php/';
						echo ' loginoutpath is ' . $loginoutpath;
					} else {
						$loginoutpath = './content/php/';
						echo ' loginoutpath is ' . $loginoutpath;
					}

				echo '<br />end path';


				*

			//v3 of navbar links
	$pageArray = [];
	foreach (glob("content/*.php") as $filename)
	{
		$name = '';
		if (($filename != 'content/login.php') && ($filename != 'content/account.php')) 
		{

			array_push($pageArray, $filename);   
		}

			//array_push($pageArray, $filename);
			$name = $filename;
			$name = str_replace('.php', '', $name);
			$name = str_replace('content/', '', $name);
			$name = ucfirst($name);

			$pageArray[$name] = $filename;
		}

		if (!(isset($_SESSION['username']))) {
			
			$lname = "Login";
			$lfilename = "content/login.php" ;
			$pageArray[$lname] = $lfilename;

		}

		if ($filename == $path) {
			echo $listart . $filename . $limidcur . $name . $liend;
		} else {
			echo $listart . $filename . $limid . $name . $liend;
		}
	} 

	//Create the links from the array.
	
?>