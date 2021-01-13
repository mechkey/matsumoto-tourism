<?php
	//Connect to database

	$debug = false;
	$dev = true;

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$conn = mysqli_connect ('localhost', 'w19041690', 'HEMMINGS', 'w19041690');
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
		$mysqli = new mysqli('localhost', 'w19041690', 'HEMMINGS', 'w19041690');
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
	function act_book($searching=false, $excluding=false, $aID=false) {
		global $debug;
		$search = "";
		$exclude = "";
		$search = $_GET['search']  ?? null;
		$search = htmlspecialchars($search);
		$exclude = $_GET['exclude'] ?? null;
		$exclude = htmlspecialchars($exclude);
		$a_id = $_GET['a_id'] ?? null;
		$a_id = htmlspecialchars($a_id);


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
		if ($a_id == null) {
			if ($debug) {
				echo 'select  null%%';
			}
		}
		if ($debug) {
			echo $search;
			br();
			echo $exclude;
			br();
		}

		if ($aID == true) {
			$caption = "Edit booking:";
			$btn_text = "Modify";

		} else {
			$caption = "Activity Details:";
			$btn_text = "Book";

		}

		$table = <<< TABLE
		 	<table class="act_table"><caption>${caption}</caption><tr>
				<th class="shortcol">Activity Name</th>
				<th class="longcol">Description</th>
				<th class="tonycol">Price</th>
				<th class="shortcol">Location</th>
				<th class="longcol">Booking</th>
		TABLE;

		echo $table;

		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'w19041690', 'HEMMINGS', 'w19041690');
		$sql = "SELECT `b2_act_id`, `b2_act_name`, `b2_desc`, `b2_price`, `b2_loc`, `customerID` FROM (SELECT a.activityID AS b2_act_id, `activity_name` AS b2_act_name, `description` AS b2_desc, `price` AS b2_price, `location` AS b2_loc, null AS b2_custID FROM `activities` a) AS b2 LEFT JOIN (SELECT a.activityID, `activity_name`, `description`, `price`, `location`, `customerID` FROM `activities` a LEFT OUTER JOIN `booked_activities` ba ON ba.activityID = a.activityID WHERE `customerID` = (SELECT customerID FROM customers WHERE username = ?)) AS b1 on b1.activityID = b2_act_id";

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

		if ($aID == true) {
			$sql = "SELECT `activity_name`, `description`, `price`, `location`, `number_of_tickets`, `date_of_activity`, ba.customerID, a.activityID FROM booked_activities ba JOIN customers C ON c.customerID = ba.customerID JOIN activities a ON a.activityID = ba.activityID WHERE ba.activityID = ? AND username = ?";
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
			} 
			else if ($aID == true) {
				$stmt->bind_param("ss", $a_id, $_SESSION['username']);
			} else {
				$stmt->bind_param("s", $_SESSION['username']);
			}

			$stmt->execute();
			if ($aID == true) {
				$stmt->bind_result($act_name, $desc, $price, $loc, $num_tix, $date, $custID, $act_id);
			} else {
				$stmt->bind_result($act_id, $act_name, $desc, $price, $loc, $custID);
				//echo 'aid false';
				echo $custID;
			}

			//echo $act_id;
			while ($stmt->fetch()) {
				if ($aID == true) {
					$action = "/w19041690/kf7013-2021/content/php/doedit.php";
					$num = '';
					//echo $act_name. $desc. $price.$loc. $num_tix. $date. $custID. $act_id;
					//echo 'edit true';
				} else {
					$action = "/w19041690/kf7013-2021/content/php/dobook.php";
					$num = $act_id;
				}			
				
				if ($custID != null) {
						printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">£%s</td><td class="shortcol">%s</td><td class="longcol"><form action="http://localhost/w19041690/kf7013-2021/content/account.php?select_id=%s" method="post"><button type="submit" name="book" value="%s">View booking</button></div>
						</form></td></tr>', $act_name, $desc, $price, $loc, $act_id, $act_id);
				} else {
					$min = date("Y-m-d"); 
					printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">£%s</td><td class="shortcol">%s</td><td class="longcol"><form action="%s" method="post">
					<div><label for="num_tix%s">Number of tickets:</label><select name="num_tix%s" required>
						<option value="1">1</option><option value="2">2</option>
						<option value="3">3</option><option value="4">4</option>
						<option value="5">5</option><option value="6">6</option>
						<option value="7">7</option><option value="8">8</option>
						<option value="9">9</option><option value="10">10</option></select>
					</div>
					<div><label for="date%s">On date:</label><input type="date" id="date%s" name="date%s" min=%s max="2023-04-05" required><button type="submit" name="book" value="%s">%s</button>
					</div>
					</form></td></tr>', $act_name, $desc, $price, $loc, $action, $num, $num, $num, $num, $num, $min, $act_id, $btn_text);
				}
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
		echo '<table class="booked_act_table"><caption>Booked Activities:</caption><tr><th class="longcol">Booked Activities</th><th class="act_id">Activity ID</th><th class="longcol">Activity Date</th><th class="tinycol">Number of Tickets</th><th>Details</th><th>Modify</th><th>Cancel</th></tr>';
		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'w19041690', 'HEMMINGS', 'w19041690');

		//$sql = "SELECT a.activity_name, b.activityID, date_of_activity, b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN activities a ON a.activityID = b.activityID";
		$sql = "SELECT `activity_name`, b.activityID, DATE(b.date_of_activity), b.number_of_tickets FROM `booked_activities` b LEFT OUTER JOIN `activities` a ON a.activityID = b.activityID LEFT OUTER JOIN `customers` c ON b.customerID = c.customerID WHERE c.username=? ORDER BY `date_of_activity`";
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param('s', $_SESSION['username']);
			$stmt->execute();
			$stmt->bind_result($act_name, $act_id, $date, $num_tix);
			while ($stmt->fetch()) {
				$date = date('d-m-Y', strtotime($date));
				printf ('<tr><td class="longcol">%s</td><td class="tinycol">%d</td><td class="shortcol">%s</td><td class="tinycol">%s</td><td class="shortcol"><a href="account.php?select_id=%d">View Details</a></td><td class="shortcol"><a href="account.php?a_id=%d">Modify booking</a></td><td class="shortcol"><a href="/w19041690/kf7013-2021/content/account.php?delete_id=%d">Delete booking</a></td></tr>', $act_name, $act_id, $date, $num_tix, $act_id, $act_id, $act_id);
			}
			echo '</table>';
			$stmt->close();
		}
		$mysqli->close();
	}

	function booked_act_details() {
		global $debug;
		$select_id = $_GET['select_id'] ?? null;
		$select_id = htmlspecialchars($select_id);
		if ($select_id == null) {
			if ($debug) {
				echo 'select  null%%';
			}
			$select_id = $_GET['delete_id'] ?? null;
		}
		$table = <<< TABLE
		 	<table class="act_table"><caption> Selected Booking Details:</caption><tr>
				<th class="shortcol">Activity Name</th>
				<th class="longcol">Description</th>
				<th class="shortcol">Activity date</th>
				<th class="shortcol">Location</th>
				<th class="tinycol">Price per ticket</th>
				<th class="tinycol">Tickets</th>
				<th class="tinycol">Total</th>
				<th class="tinycol">Hide</th>
				
		TABLE;

		echo $table;

		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'w19041690', 'HEMMINGS', 'w19041690');
		
		$sql = "SELECT `activity_name`, `description`, DATE(date_of_activity), `location`, `price`, `number_of_tickets`, (number_of_tickets * price) AS `total` FROM `booked_activities` ba join `activities` a on a.activityID = ba.activityID join `customers` c on c.customerID = ba.customerID WHERE c.username = ? AND a.activityID = ?";	

		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("sd", $_SESSION['username'], $select_id);
			$stmt->execute();
			$stmt->bind_result($act_name, $desc, $booked_date, $loc, $price, $num_tix, $total);
			while ($stmt->fetch()) {
				printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="shortcol">%s</td><td class="shortcol">%s</td><td class="tinycol">£%d</td><td class="tinycol">%d</td><td class="tinycol">£%d</td><td class="tinycol"><a href="/w19041690/kf7013-2021/content/account.php" class"no_purple">Hide</a></td>
						</tr>', $act_name, $desc, $booked_date, $loc, $price, $num_tix, $total);
			}
			$stmt->close();
		}
		$mysqli->close();
		echo '</table>';
	}
	
	function br() {
		echo "<br />";
	}

	

	//  <form id="login" method="post" action="./php/dologin.php"> 
	//	<form id="login" method="post" action="/w19041690/kf7013-2021/content/php/dologin.php"> 
	function login_form ($nav_sub=false) {
		$login = '
		<form id="login" method="post" action="/w19041690/kf7013-2021/content/php/dologin.php"> 
		<label for="username">Username:</label><input type= "text" id="username" name="username" size="8" required/><br />
		<label for="password">Password:</label><input type= "password" id="password" name="password" size="8" pattern=".{8,}" required/>'; 
		$login .= '<input type="submit" id="loginbutton" class="nav_button" value="Login" /> 
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
		<form id="logout" method="post" action="/w19041690/kf7013-2021/content/logout.php"> 
		<button type="submit" ${class} id="logoutbutton"> ${text} </button>
		</form>
		LOGOUT;
		echo $logout;
	}

	function mod_book($searching=false, $excluding=false, $aID=false) {
		global $debug;
		$a_id = $_GET['a_id'] ?? null;
		$a_id = htmlspecialchars($a_id);

		if ($a_id == null) {
			if ($debug) {
				echo 'select  null%%';
			}
		}
		if ($debug) {
			echo $search;
			br();
			echo $exclude;
			br();
		}

		if ($aID == true) {
			$caption = "Edit booking:";
			$btn_text = "Modify";

		}

		$table = <<< TABLE
		 	<table class="act_table"><caption>${caption}</caption><tr>
				<th class="shortcol">Activity Name</th>
				<th class="longcol">Description</th>
				<th class="tonycol">Price</th>
				<th class="shortcol">Location</th>
				<th class="longcol">Booking</th>
		TABLE;

		echo $table;

		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'w19041690', 'HEMMINGS', 'w19041690');
		$sql = "SELECT `activity_name`, `description`, `price`, `location`, `activityID` FROM `activities` ";

		

		if ($aID == true) {
			$AID = $_REQUEST['a_id'];
			$sql = "SELECT `activity_name`, `description`, `price`, `location`, `activityID` FROM `activities` WHERE `activityID` = $AID";
		}
		//
		if ($debug || true) {
			//echo $sql;	
			//echo '-xclude is : '. $exclude . ' ';		
		}
		if ($stmt = $mysqli->prepare($sql)) {
			//if ($exclude == null) {

			

			$stmt->execute();
			$stmt->bind_result($act_name, $desc, $price, $loc, $act_id);
			//echo $act_id;
			while ($stmt->fetch()) {
				printf ('<tr><td class="shortcol">%s</td><td class="longcol">%s</td><td class="tinycol">%s</td><td class="shortcol">%s</td><td><form action="./php/doedit.php" method="post">
						<select name="num_tix" required>
							<option value="1">1</option><option value="2">2</option>
							<option value="3">3</option><option value="4">4</option>
							<option value="5">5</option><option value="6">6</option>
							<option value="7">7</option><option value="8">8</option>
							<option value="9">9</option><option value="10">10</option>
						</select><input type="date" id="date" name="date" required><button type="submit" name="book" value="%s">Book</button>
						</form></td></tr>', $act_name, $desc, $price, $loc, $act_id);
			}
			$stmt->close();
		}
		$mysqli->close();
		echo '</table>';
	}


	// This function makes a text box and submit button that searches the activity name, description and location. // It was originally also on the nav bar, hence a function for reuseability. /w19041690/kf7013-2021/content/search.php
	function searchbar() {
		echo '<form id="search_form" method="get">
			<label for="search">Search (optional):</label>
			<input id="search" name="search" type="text" placeholder="Search..." size="10">

			<label for="exclude">Exclude (optional):</label>
			<input id="exclude" name="exclude" type="text" placeholder="Exclude..." size="10">

			<input type="submit" value="Submit" class="nav_button">
			</form>';
		/*$actID_array = act_info_array();	
		echo'
			<p>OR:</p><form id="select_id_form" method="get"><label for="select_id">Select the ID of the activity you want information on:<select name="select_id" id="select_id">';
		foreach ($actID_array as $array => $array2) {
			foreach ($array2 as $key => $value) {
				if ($key == 'activityID') {
					echo '<option value="'.$value.'">'.$value.'</option>';
				
				}
			}
		}
				
		echo '</select><input type="submit" value="Submit" class="nav_button"></form>';*/
	}

	function search_res($searching=false, $excluding=false, $aID=false) {
		global $debug;
		$search = "";
		$exclude = "";
		$search = $_GET['search']  ?? null;
		$search = htmlspecialchars($search);
		$exclude = $_GET['exclude'] ?? null;
		$exclude = htmlspecialchars($exclude);
		$a_id = $_GET['a_id'] ?? null;
		$a_id = htmlspecialchars($a_id);


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
		if ($a_id == null) {
			if ($debug) {
				echo 'select  null%%';
			}
		}
		if ($debug) {
			echo $search;
			br();
			echo $exclude;
			br();
		}

		if ($aID == true) {
			$caption = "Edit booking:";
			$btn_text = "Modify";

		} else {
			$caption = "Activity Details:";
			$btn_text = "Book";

		}

		$table = <<< TABLE
		 	<table class="act_table"><caption>${caption}</caption><tr>
				<th class="shortcol">Activity Name</th>
				<th class="longcol">Description</th>
				<th class="tonycol">Price</th>
				<th class="shortcol">Location</th>
				<th class="longcol">Booking</th>
		TABLE;

		echo $table;

		// Trying OO php . . .
		$mysqli = new mysqli('localhost', 'w19041690', 'HEMMINGS', 'w19041690');
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

		if ($aID == true) {
			$AID = $_REQUEST['a_id'];
			$sql = "SELECT `activity_name`, `description`, `price`, `location`, `activityID` FROM `activities` WHERE `activityID` = $AID";
		}
		//
		if ($debug || true) {
			//echo $sql;	
			//echo '-xclude is : '. $exclude . ' ';		
		}
		if ($stmt = $mysqli->prepare($sql)) {
			//if ($exclude == null) {

			if ((isset($_GET['search']) && $_GET['search'] != '' ) && (isset($_GET['exclude']) && $_GET['exclude'] != '' )) {
				$stmt->bind_param("ssssss", $search, $search, $search, $exclude, $exclude, $exclude);
				//echo 'search not null exclude not null';
			}

			else if ((isset($_GET['search']) && $_GET['search'] != '' ) && $_GET['exclude'] == '' ) {
				//echo 'if 1 search not null: ' . $search;
				$stmt->bind_param("sss", $search, $search, $search);
			}
			else if ((isset($_GET['exclude']) && $_GET['exclude'] != '' ) && $_GET['search'] == '' ) {
				//echo 'if 2 exclude not null: ' . $exclude;
				$stmt->bind_param("sss", $exclude, $exclude, $exclude);

			} else {
				//echo 'else statement - exclude = null';
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
						</select><input type="date" id="date" name="date" required><button type="submit" name="book" value="%s">Book</button>
						</form></td></tr>', $act_name, $desc, $price, $loc, $act_id);
			}
			$stmt->close();
		}
		$mysqli->close();
		echo '</table>';
	}
	 

	//Shows the account, first and last names for the logged in user.
	function viewDetails () {
		echo '<table id="details_table"><caption>Your details:</caption><tr><th>Username:</th><th>First Name:</th><th>Last Name:</th></tr>';

				// Trying OO php . . .
				$mysqli = new mysqli('localhost', 'w19041690', 'HEMMINGS', 'w19041690');

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