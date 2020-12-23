<?php
	//Connect to database

	$debug = false;
	$dev = true;

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$conn = mysqli_connect ('localhost', 'root', 'root', 'travel');
	if ($conn) {
		mysqli_set_charset($conn, 'utf8');
	}

	if ($conn === false) {
		echo "<p>conn failed:" . mysqli_connect_error() . " </p>\n";
	}

	//Init path var
	/*
	function getmpath() {
		$mpath = $_SERVER['REQUEST_URI'];
		return $mpath		
	}
	*/

	//Init dark mode vars

	$themeType = '';
	//$_SESSION['themeType'] = '';
	$changeTheme = '';
	if (((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'dark'))) {
		$_SESSION['themeType'] = 'dark';
	} else if ((isset($_REQUEST['theme'])) && ($_REQUEST['theme'] == 'light')) {
		$_SESSION['themeType'] = 'light';
	} 

	//This function prints out the content of the activities table.
	function act_book($searching=false, $excluding=false) {
		global $debug;
		$search = (isset($_REQUEST['search']) ? $_REQUEST['search'] : null);
		$search = htmlspecialchars($search);
		$exclude = (isset($_REQUEST['exclude']) ? $_REQUEST['exclude'] : null);
		$exclude = htmlspecialchars($exclude);
		//$floatsearch = floatval($search);
		$search = '%' . $search . '%';	
		$exclude = '%' . $exclude . '%';	
		echo '<table class="act_table"><tr>
				<th class="act_name">Activity Name</th><th class="act_desc">Description</th>
				<th class="price">Price</th>
				<th class="loc">Location</th>
				<th class="num_tix"><label for="num_tix">Tickets required:</label></th>
				<th class="th_date"><label for="date">Date:</label></th>
				<th class="book">Book</th></tr>';
		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'root', 'root', 'travel');
		$sql = "SELECT `activity_name`, `description`, `price`, `location`, `activityID` FROM `activities` ";

		if ($searching || $excluding) {
			$sql .= "WHERE ";
		}
		if ($searching) {
			$sql .= "(`activity_name` LIKE ? OR `description` LIKE ? OR `location` LIKE ?) ";
		}
		if ($searching && $excluding) {
			$sql .= "AND ";
		}
		if ($excluding) {
			$sql .= "`activity_name` NOT LIKE ? AND `description` NOT LIKE ? AND `location` NOT LIKE ? ";
		}
		if ($debug) {
			echo $sql;			
		}
		if ($stmt = $mysqli->prepare($sql)) {
			if ($searching XOR $excluding) {
				if (isset($_REQUEST['exclude'])) {
					$search = $exclude;
				}
				$stmt->bind_param("sss", $search, $search, $search);
			}
			if ($searching && $excluding) {
				$stmt->bind_param("ssssss", $search, $search, $search, $exclude, $exclude, $exclude);
			}
			$stmt->execute();
			$stmt->bind_result($act_name, $desc, $price, $loc, $act_id);
			//echo $act_id;
			while ($stmt->fetch()) {
				printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">%s</td><td class="shortcol">%s</td><td><form action="./php/book.php" method="post">
						<select name="num_tix" required>
							<option value="1">1</option><option value="2">2</option>
							<option value="3">3</option><option value="4">4</option>
							<option value="5">5</option><option value="6">6</option>
							<option value="7">7</option><option value="8">8</option>
							<option value="9">9</option><option value="10">10</option>
						</select></td>
						<td><input type="date" id="date" name="date" required></td>
						<td><button type="submit" name="book" value="%s">Book</button>
						</form></td></tr>', $act_name, $desc, $price, $loc, $act_id);
			}
			$stmt->close();
		}
		$mysqli->close();
		echo '</table>';
	}
	
	function br() {
		echo "<br />";
	}

	function check_pass ($user, $pass) {
		global $debug;
		global $conn;
		$sql = "SELECT `password_hash` FROM `customers` WHERE `username`=?";
		//echo $sql;
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $user);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $DBpass);
			// echo "Checkpass: Username $user, Password >>$pass<< 
			if (mysqli_stmt_fetch($stmt)) 
			{
				$passok = password_verify($pass, $DBpass);
				if ($debug) {echo 'returning passok . . .' . $passok;}
				return $passok;
			} 
			else 
			{
				if ($debug) {echo 'mysqli_stmt_fetch($stmt) FAILED';}
				return false; 
			}
		} else {
			echo "<p>echoed Unable to prepare statement</p>";
			return false;
		}
	}

	function classID() {
		if (isset($_SESSION['themeType'])) {
			echo $_SESSION['themeType'];
		} else {
			echo $_SESSION['themeType'] = 'light';
		}
	}

	function contentAsArray($rel) { 
		global $debug;
		$tmpPageArray = [];
		foreach (glob($rel . '*.php') as $filename)
		{
			if ($debug) { echo $filename; }
			//if it isn't a page to do with login/out
			if( 
				($filename != ($rel . 'login.php')) && 
				($filename != ($rel . 'logout.php')) && 
				($filename != ($rel . 'account.php')) &&
				($filename != ($rel . 'register.php')) 
				)  
			{
				//then push it to the array
				array_push($tmpPageArray, $filename);   
			}
		}
		//if it is a login/registration page AND the user is not logged in, add it to the end of the array
		if (!(isset($_SESSION['username']))) { // if not loggged in
			//echo $curpagepath;	
			array_push( $tmpPageArray, $rel . 'register.php' );
			array_push( $tmpPageArray, $rel . 'login.php' );
		//else if it a must be logged in page, only show it if logged in, and add it to the end of the array
		} else { // if logged in
			array_push( $tmpPageArray, $rel . 'account.php' );
			array_push( $tmpPageArray, $rel . 'logout.php' );
		}
		return $tmpPageArray;
	} 

	function fallbacktheme() {//Fall back Dark mode / light form mode button
		//$themeType = getTT();
		echo '<li>';
		$changeTheme = ($themeType == 'light') ? 'dark' : 'light';
		$ctstring = '<a id="ctheme" href="?theme=' . $changeTheme;
		if ($themeType == 'light') {
			$ctstring .= '">Dark Mode';
		} else {
			$ctstring .= '">Light Mode';
		}
		echo $ctstring . '</a></li>';

		echo '<li><form id="theme" method="post" action="./index.php"><input type="submit" name="theme" value="dark"/> </form></li>';
	}

	function getpath() {
		$path = $_SERVER['REQUEST_URI'];
		return $path;
	}

	//
	/*
	function getroot($page) {;
		if (preg_match('/\.\/content\/php/', $page)) {
			return '../../';
		} else if (preg_match('/\.\/content/', $page)) {
			return '../';
		} else if (preg_match('/index\.php/', $page)) {
			return './';
		}
	}
	*/


	function login ($user, $pass) {
		if (array_key_exists('username', $_REQUEST) && (array_key_exists('password', $_REQUEST)) ) {
			$passok = check_pass($user, $pass); //check_pass function
			if ($passok == 1) 
		    {
		        $_SESSION['username'] = $user;
		        if ($debug) {
		            echo '<br />Username is $user';
					echo '<br />Password is >>$pass<< <br />';
					echo 'OK: >>$passok<< <br />';
		        } else {
		            header('Location: /KF7013-2021/content/account.php');
		        }
		    } else { // == if passok is false
		        if ($debug) {
		            echo "<p>Failed - Username $user, Password: >>$pass<< </p>";
					echo "OK: >>$passok<< (not ok if empty) <br />";
		        } else {
		            header('Location: /KF7013-2021/content/login.php');
		        }
		    }
		}
		else { // == if array keys do not exist
		    if ($debug) {
		        echo("Array key username or pass  does not exist,<br />");
		    } else {
		        header('Location: /KF7013-2021/content/login.php');
		    }
		}
	}

	function logincheck() {
		if (!isset($_SESSION['username'])) 
			header('Location: /KF7013-2021/content/login.php');
	}

	//<form id="login" method="post" action="./php/dologin.php"> 
	function loginpageform() {
		$login = '
		<li>
		<form id="login" method="post" action="./php/dologin.php"> 
		Username:    
		<input type= "text" name="username" size="8" /><br />
		Password:
		<input type= "password" name="password" size="8" /> </li>
		<input type="submit" value="Login" /> 
		</form>
		';
	echo $login;
	}


	function logoutform() {
		$fpath = '';
		$logout = '
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}


//		<form id="login" method="post" action="/KF7013-2021/content/php/dologin.php"> 
	function navbarloginform () {
		$login = '
		<form id="login" method="post" action="/KF7013-2021/content/php/dologin.php"> 
		Username:    
		<input type= "text" name="username" size="8" /><br />
		Password:
		<input type= "password" name="password" size="8" /> </li><li id="navsub">
		<input type="submit" id="loginbutton" class="navbutton"value="Login" /> 
		</form>
		';
		echo $login;
	}


	function navbarlogoutform ($value) {
		$logout = <<<LOGOUT
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" class="navbutton" id="logoutbutton" value="$value" /> 
		</form>
		LOGOUT;

		echo $logout;
	}
	

	/*	
	function navbarlogoutform () {
		$logout = '
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}
	*/

	// this function just makes otherwise unformatted pages darker
	function phpstyle() {
		
			echo '
			<style>
			body {
		  		background-color: #111;
			}
			html {
				color:gray;
			}
			</style>
			<p>';
		
	}

	// I'd rather have a start and end function, rather thing in html5 terms
	function phpstyleend() {
		echo '<p>';
	}

	// This function makes a text box and submit button that searches the activity name, description and location. // /KF7013-2021/content/search.php
	function searchbar() {
		echo '<form id="search_form" method="post" action="">
			<label for="search">Search (optional):</label>
			<input id="search" name="search" type="text" placeholder="Search..." size="10">

			<label for="exclude">Exclude (optional):</label>
			<input id="exclude" name="exclude" type="text" placeholder="Exclude..." size="10">

			<input type="submit" class="navbutton">
			</form>';
	}

	//The website logo light mode and dark mode selector.
	function showLogo ($path) {
		$logosrc = ''; 	
		if (isset($_SESSION['themeType']) && $_SESSION['themeType'] == 'dark') { 		
			$logosrc = '/KF7013-2021/assets/images/logogray.png'; 	
		} else { 
			$logosrc = '/KF7013-2021/assets/images/logo.png';
		}
		
		echo '<li id="navlogo"><a href="/KF7013-2021/index.php"><img id="logo" src="' . $logosrc . '" alt="Visit Matsumoto Logo" height="30"/></a></li>';
	}

	//Shows the account, first and last names for the logged in user.
	function showDetails () {
		echo'<h2>Your details:</h2><table class="act_table"><tr><th>Username:</th><th>First Name:</th><th>Last Name:</th></tr>';

				// Trying OO php . . .
				$mysqli = new mysqli('localhost', 'root', 'root', 'travel');

				$sql = "SELECT `username`, `customer_forename`, `customer_surname` FROM `customers` WHERE `username` = ?";
				if ($stmt = $mysqli->prepare($sql)) {
					$stmt->bind_param('s', $_SESSION['username']);
					$stmt->execute();
					$stmt->bind_result($uname, $fir, $last);
					while ($stmt->fetch()) {
						printf ('<tr><td>%s</td><td>%s</td><td>%s</td></tr>', $uname, $fir, $last);
					}
					$stmt->close();
				}
				$mysqli->close();
	}
?>