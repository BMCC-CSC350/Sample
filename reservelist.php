<?php
	echo "<p style='color:red;font-size:24'> RESERVED SEATS </p>";
	$sql = "select seats_seatno,price  from sampleproject.reserve join sampleproject.seats on reserve.Seats_SeatNo = seats.SeatNo where User_UserName = '".$userid."'";
	$result = mysqli_query($connect, $sql); 	// Send the query to the database
	if (mysqli_num_rows($result) > 0) 			// if there are rows present, list the seat numbers and prices and total 
	{
		$total = 0;
		echo "<table border='1'><tr><td>SEAT NO</td><td>COST</td></tr>";
		while($row = mysqli_fetch_assoc($result)) { // fetch next row
			echo "<tr> <td>".$row["seats_seatno"]." </td><td> $ ". $row["price"]."</td></tr>"; // output data of that row
			$total += $row["price"];
		}
		echo "<tr><td>TOTAL</td><td>$ ".$total."</td></tr>";
		echo "</table>";
	}
	else										// No seats reserved for this user
	{
		echo "NO SEATS RESERVED";
	}
?>
