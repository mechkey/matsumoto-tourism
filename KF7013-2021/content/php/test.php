<?php 
	session_start();
$mysqli = new mysqli('localhost', 'root', 'root', 'travel');
if (mysqli_connect_error()) {
	echo 'udone goofed'; 
}

$u = $_SESSION['username'];
echo $u;
echo '<br />';
$sql = "SELECT `b2_act_id`, `b2_act_name`, `b2_desc`, `b2_price`, `b2_loc`, `customerID` FROM (SELECT a.activityID as b2_act_id, `activity_name` as b2_act_name, `description` as b2_desc, `price` as b2_price, `location` as b2_loc, null as b2_custID FROM `activities` a) AS b2 LEFT JOIN (SELECT a.activityID, `activity_name`, `description`, `price`, `location`, `customerID` FROM `activities` a LEFT OUTER JOIN `booked_activities` ba ON ba.activityID = a.activityID WHERE `customerID` = ?) AS b1 on b1.activityID = b2_act_id";

echo $sql;
$stmt = '';
if ($stmt = $mysqlib->prepare("SELECT `b2_act_id`, `b2_act_name`, `b2_desc`, `b2_price`, `b2_loc`, `customerID` FROM (SELECT a.activityID as b2_act_id, `activity_name` as b2_act_name, `description` as b2_desc, `price` as b2_price, `location` as b2_loc, null as b2_custID FROM `activities` a) AS b2 LEFT JOIN (SELECT a.activityID, `activity_name`, `description`, `price`, `location`, `customerID` FROM `activities` a LEFT OUTER JOIN `booked_activities` ba ON ba.activityID = a.activityID WHERE `customerID` = ?) AS b1 on b1.activityID = b2_act_id")) {
	$stmt->bind_param("s", $u );
	echo 'bound param';
	$stmt->execute();
	$stmt->bind_result($act_id, $act_name, $desc, $price, $loc);
	$stmt->fetch();
	echo $act_id, $act_name, $desc, $price, $loc;
	$stmt->close();
} else {
	echo '<br />wtf';
}
$mysqlib->close;

?>