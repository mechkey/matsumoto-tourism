<?php

	echo "Data sent in \$_REQUEST";
	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";
?>

<?php
	$name = $_REQUEST['name'];
	$phone = $_REQUEST['phone'];
	$adults = $_REQUEST['adults'];
	$children = $_REQUEST['children'];
	$total;
	$ticket = 10;
	$adultsub;
	$childrensub;

	if ($adults > 0 && $children > 0 && 2 * $adults < $children ) {
		$total = $ticket * ($adults + (0.4 * $adults * 2) + ($children - ($adults * 2)));
	}
	elseif ($adults > 0 && $children > 0 && 2 * $adults >= $children ) {
		$total = $ticket * ($adults + (0.4 * $children) );


	}
	elseif ($children > 0 && $adults == 0) {
		$total = $children * $ticket;
	}
	elseif ($adults > 0 && $children == 0) {
		$total = $adults * $ticket;
	}
	else {Echo "error";
	}


echo "Name: $name; <br />
 Phone: $phone <br />
 Adults: $adults <br />
 Children: $children <br />
 Total: $total";


 /*		echo "2 * $adults < $children";
		$adultsub = $ticket * $adults;
		$discountchildsub = $ticket * (0.4 * $adults * 2) ;
		$childrensub = $ticket * ($children - ($adults * 2));
		$total = $adultsub + $childrensub + $discountchildsub; */
 

?>	