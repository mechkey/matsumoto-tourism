<!DOCTYPE HTML>
<html>
<head>
<body>
<?php

include 'dbconn.php';

$sql = 'SELECT Animalname,Age FROM ANIMAL';
?>
<!--
<table>
	<tr>
		<th>Animal Name</th>
		<th>Age</th>
	</tr> -->

	<select name="animals" id ="animals">

<?php
$queryresult = mysqli_query($conn, $sql);
/*
	if ($queryresult) {
		while ($currentrow = mysqli_fetch_assoc($queryresult)) {
			
				$name = $currentrow['Animalname'];
				$age = $currentrow['Age'];
				echo "<tr><td>$name</td>";
				echo "<td>$age</td>";
				echo "</tr>";
				
			
		}
	}
	*/

	if ($queryresult) {
		while ($currentrow = mysqli_fetch_assoc($queryresult)) {
			$name = $currentrow['Animalname'];
			echo "<option value=\"$name\">$name</option>";
	
		}
	}
?>
</select>



</body>
</html>