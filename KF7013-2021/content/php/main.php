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
	//this takes the activities from the activities table and puts them in the $acts array
		function act_info_array($searching=false) {
		global $debug;
		$search = $_GET['search']  ?? null;
		$search = htmlspecialchars($search);
		//$floatsearch = floatval($search);

		if ($search != null) {
			$search = '%' . $search . '%';
			if ($debug) {
				echo 'search not null%%';
			}
		}
		
		if ($debug) {
			echo $search;
			br();
		}
		$acts = [];
		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'root', 'root', 'travel');
		/* database of alt images - v1
		$sql = "SELECT `activity_name`, `description`, `price`, `location`, a.activityID, i.alt FROM `activities` a JOIN `images` i ON a.activityID = i.activityID";*/
		$sql = "SELECT `activity_name`, `description`, `price`, `location`, `activityID` FROM `activities`";
		if ($res = $mysqli->query($sql)) {

			while ($row = $res->fetch_assoc()) {
				$acts[] = $row;
			}
			$res->free();
		}
		$mysqli->close();
		return $acts;
	}

	//This function prints out the content of the activities table.
	function act_book($searching=false, $excluding=false) {
		global $debug;
		$search = $_GET['search']  ?? null;
		$search = htmlspecialchars($search);
		$exclude = $_GET['exclude'] ?? null;
		$exclude = htmlspecialchars($exclude);
		//$floatsearch = floatval($search);

		if ($search != null) {
			$search = '%' . $search . '%';
			if ($debug) {
				echo 'search not null%%';
			}
		}
		if ($exclude != null) {
			$exclude = '%' . $exclude . '%';
			if ($debug) {
				echo 'Exclude not null%%';
			}

		}
		if ($debug) {
			echo $search;
			br();
			echo $exclude;
			br();
		}

		$table = <<< TABLE
		 	<table class="act_table"><tr>
				<th class="act_name">Activity Name</th><th class="act_desc">Description</th>
				<th class="price">Price</th>
				<th class="loc">Location</th>
				<th class="num_tix">Tickets required:</th>
				<th class="th_date">Date:</th>
				<th class="book">Book</th></tr>
		TABLE;

		echo $table;

		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'root', 'root', 'travel');
		$sql = "SELECT `activity_name`, `description`, `price`, `location`, `activityID` FROM `activities` ";

		if ($searching || $excluding) {
			$sql .= "WHERE ";
		}
		if ($searching) {
			$sql .= "(`activity_name` LIKE ? OR `description` LIKE ? OR `location` LIKE ?) ";
		}
		if ($search != null && $exclude != null) {
			$sql .= " AND ";
		}
		//if ($excluding) {
		if ($exclude != null) {
			$sql .= " `activity_name` NOT LIKE ? AND `description` NOT LIKE ? AND `location` NOT LIKE ? ";
		}
		//
		if ($debug) {
			echo $sql;	
			echo '-xclude is : '. $exclude . ' ';		
		}
		if ($stmt = $mysqli->prepare($sql)) {
			//if ($exclude == null) {

			if ((isset($_GET['search']) && $_GET['search'] != '' ) && (isset($_GET['exclude']) && $_GET['exclude'] != '' )) {
				$stmt->bind_param("ssssss", $search, $search, $search, $exclude, $exclude, $exclude);
				//echo 'search not null exclude not null';
			}
			else if (($_GET['search'] != '' ) && $_GET['exclude'] == '' ) {
				$stmt->bind_param("sss", $search, $search, $search);
				//echo 'if 1 search not null: ' . $search;
			}
			else if ((isset($_GET['exclude']) && $_GET['exclude'] != '' ) && $_GET['search'] == '' ) {
				$stmt->bind_param("sss", $exclude, $exclude, $exclude);
				//echo 'if 2 exclude not null: ' . $exclude;
			} else {
				//echo 'else statement - exclude = null';
			}

			$stmt->execute();
			$stmt->bind_result($act_name, $desc, $price, $loc, $act_id);
			//echo $act_id;
			while ($stmt->fetch()) {
				printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">%s</td><td class="shortcol">%s</td><td><form action="./php/dobook.php" method="post">
						<select name="num_tix%d" required><label for="num_tix%d" hidden>Number of tickets for %s:</label>
							<option label="1 ticket"value="1">1</option><option label="2 ticket" value="2">2</option>
							<option label="3 ticket"value="3">3</option><option label="4 ticket" value="4">4</option>
							<option label="5 ticket"value="5">5</option><option label="6 ticket" value="6">6</option>
							<option label="7 ticket"value="7">7</option><option label="8 ticket" value="8">8</option>
							<option label="9 ticket"value="9">9</option><option label="10 ticket" value="10">10</option>
						</select></td>
						<td><label for="date%s" hidden>Date to book:</label><input type="date" id="date%s" name="date" placeholder="dd/mm/yyyy" required></td>
						<td><button type="submit" name="book" value="%s">Book</button>
						</form></td></tr>', $act_name, $desc, $price, $loc, $act_id, $act_name, $act_id, $act_id, $act_id, $act_id);
			}
			$stmt->close();
		}
		$mysqli->close();
		echo '</table>';
	}

	function alt($activityID) {
		$alt = "";
		if ($activityID == 1) {
			$alt = "Matsumoto Castle surrounded by a moat with a red bridge";
		} else if ($activityID == 2) {
			$alt = "A bridge across the Kamikochi Valley river, with snow-covered mountains in the background";
		} else if ($activityID == 3) {
			$alt = "Steam rising from a hot spring with a traditional Japanese wooden building in the background";
		} else if ($activityID == 4) {
			$alt = "The front door of the Matsumoto Museum of Art with trees nearby";
		} else if ($activityID == 5) {
			$alt = "The lush garden of Ikegami Hyakuchikutei";
		} else if ($activityID == 6) {
			$alt = "The exterior of the Ukiyo-e Museum";
		} else if ($activityID == 7) {
			$alt = "Four students being instructed on how to play Taiko drums";
		} else if ($activityID == 8) {
			$alt = "Exterior showing the three stories of Another Castle";
		} else if ($activityID == 9) {
			$alt = "Bamboo pipes bring the hot spring water into the hot springs at Shirahone Hot Springs";
		}
		return $alt;
	}
		


	function booked_act () {
		echo '<table class="booked_act_table"><p><caption>Booked Activities:</caption></p><tr><th class="act_name">Your Booked Activities</th><th class="act_id">Activity ID</th><th class="act_desc">Activity Date</th><th class="price">Number of Tickets</th><th>Details</th></tr>';
		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'root', 'root', 'travel');

		//$sql = "SELECT a.activity_name, b.activityID, b.date_of_activity, b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN activities a ON a.activityID = b.activityID";
		$sql = "SELECT a.activity_name, b.activityID, b.date_of_activity, b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN activities a ON a.activityID = b.activityID LEFT OUTER JOIN customers c ON b.customerID = c.customerID WHERE c.username=?";
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param('s', $_SESSION['username']);
			$stmt->execute();
			$stmt->bind_result($act_name, $act_id, $date, $num_tix);
			while ($stmt->fetch()) {
				printf ('<tr><td class="act_name">%s</td><td class="act_id">%d</td><td class="act_date">%s</td><td class="price">%s</td><td><a href="activities.php">View Details</tr>', $act_name, $act_id, $date, $num_tix);
			}
			echo '</table>';
			$stmt->close();
		}
		$mysqli->close();
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
		if (array_key_exists('username', $_POST) && (array_key_exists('password', $_POST)) ) {
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

	//  <form id="login" method="post" action="./php/dologin.php"> 
	//	<form id="login" method="post" action="/KF7013-2021/content/php/dologin.php"> 
	function login_form ($nav_sub=false) {
		$login = '
		<form id="login" method="post" action="/KF7013-2021/content/php/dologin.php"> 
		<label for="username">Username:</label><input type= "text" id="username"name="username" size="8" required/><br />
		<label for="password">Password:</label><input type= "password" id="password" name="password" size="8" pattern=".{8,}" required/> </li><li '; 

		if ($nav_sub=true) {
			$login .= 'id="nav_sub"';
		} 

		$login .= '><input type="submit" id="loginbutton" class="nav_button"value="Login" /> 
		</form>
		';
		echo $login;
	}
	//Function to make the logout form. Takes text for a parameter that is displayed on the button and also is used for logic to see where the button is placed
	function logout_form($text) {
		$class = null;
		if ($text == 'logout') {
			$class = 'class="nav_button"';
		}
		$text = ucfirst($text);
		//echo $text;
		$logout = <<<LOGOUT
		<form id="logout" method="post" action="/KF7013-2021/content/logout.php"> 
		<button type="submit" ${class} id="logoutbutton"> ${text} </button>
		</form>
		LOGOUT;
		echo $logout;
	}


	/* deprecated
	function nav_barlogout_form ($value) {
		$logout = <<<LOGOUT
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" class="nav_button" id="logoutbutton" value="$value" /> 
		</form>
		LOGOUT;

		echo $logout;
	} */

	/* deprecated	
	function nav_barlogout_form2
	 () {
		$logout = '
		<form id="logout" method="post" action="/KF7013-2021/content/php/dologout.php"> 
		<input type="submit" value="Logout" /> 
		</form>
		';
		echo $logout;
	}
	*/


	// This function makes a text box and submit button that searches the activity name, description and location. // /KF7013-2021/content/search.php
	function searchbar() {
		echo '<form id="search_form" method="get" action="">
			<label for="search">Search (optional):</label>
			<input id="search" name="search" type="text" placeholder="Search..." size="10">

			<label for="exclude">Exclude (optional):</label>
			<input id="exclude" name="exclude" type="text" placeholder="Exclude..." size="10">

			<input type="submit" value="Submit" class="nav_button">
			</form>';
	}

	//The website logo light mode and dark mode selector.


	//Shows the account, first and last names for the logged in user.
	function showDetails () {
		echo '<table id="details_table"><p><caption>Your details:</caption></p><tr><th>Username:</th><th>First Name:</th><th>Last Name:</th></tr>';

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
				echo '</table>';
				$mysqli->close();
	}
?>