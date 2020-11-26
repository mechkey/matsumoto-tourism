<!DOCTYPE HTML>
<html>
<head>
<body>



<?php
include 'dbconn.php';

$sql1 = "SELECT Animalname FROM ANIMAL";

	echo "<select name=\"animals\" id=\"animals\">";

	$queryresult1 = mysqli_query($conn, $sql1);


if ($queryresult1) {
		while ($currentrow = mysqli_fetch_assoc($queryresult1)) {
			$name1 = $currentrow['Animalname'];
			echo "<option value=\"$name1\">$name1</option>";
	
		}
	}


echo "</select>";


$dropdown = $_REQUEST['animals'];
echo $dropdown;
?>

<?php


$sql = "SELECT A.ANIMALNAME, A.AGE, S.SPECIESNAME, E.ENCLOSURENAME, A.NOTES FROM ANIMAL A
		JOIN ENCLOSURE E
		ON A.ENCLOSURE = E.ENCLOSUREID
		JOIN SPECIES S
		ON A.SPECIES = S.SPECIESID 
		WHERE AnimalId = ?";

if($stmt = mysqli_prepare($conn, $sql)) {
	mysqli_stmt_bind_param($stmt, "i", $name1);
	mysqli_stmt_execute($stmt);
	$queryresult = mysqli_stmt_get_result($stmt);
}

echo "
<table>
	<tr>
		<th>Animal Name</th>
		<th>Age</th>
		<th>Species</th>
		<th>Enclousre</th>
		<th>Notes</th>		
	</tr>";

if($queryresult) {
	if ($currentrow = mysqli_fetch_assoc($queryresult)){

		$name = $currentrow['ANIMALNAME'];
		$age = $currentrow['AGE'];
		$species = $currentrow['SPECIESNAME'];
		$enclosure = $currentrow['ENCLOSURENAME'];
		$notes = $currentrow['NOTES'];

		echo "<tr>";

		echo "<td>$name</td>";
		echo "<td>$age</td>";
		echo "<td>$species</td>";
		echo "<td>$enclosure</td>";
		echo "<td>$notes</td>";

		echo "</tr>";
		
	}
}


?>

</table>

</body>
</html>