<?php

include 'dbconn.php';

$sql = 'SELECT * FROM ANIMAL';
<table>
	<tr>
		<th>Animal Name</th>
		<th>Age</th>
	</tr>

$queryresult = mysqli_query($conn, $sql)) 
	if ($queryresult) {
		while ($currentrow = mysqli_fetch_assoc($queryresult)) {
			
				//$name = $currentrow['Animalname'];
				//$age = $currentrow['Age'];
				//echo "<tr>";
				echo "$name = $currentrow['Animalname']";
				//echo "<td>" . $age = $currentrow['Age']";
				//echo "</tr>";
				//echo "Animal: $name is $age years old<br />";
			
		}
	}

</table>
?>