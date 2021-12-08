<?php
	echo "<p style='color:green;font-size:24'> AVAILABLE SEATS</p>";
	$sql = "SELECT seatno,price FROM sampleproject.seats left join sampleproject.reserve on sampleproject.seats.SeatNo = sampleproject.reserve.Seats_SeatNo where Seats_SeatNo is null";
	$result = mysqli_query($connect, $sql); 	// Send the query to the database
	if (mysqli_num_rows($result) > 0) 			// If there are rows present
	{
		echo "<table border='1'><tr><td></td><td>SEAT NO</td><td>COST</td></tr>";
		echo "<form action='reserve.php' method='post'>";							// form to select a seat no
		while($row = mysqli_fetch_assoc($result)) 									// fetch next row
		{ 																			// create a radio button
			echo "<tr><td><input type='radio' name='seatno' value='".$row["seatno"]."'></td><td>".$row["seatno"]."</td><td>$ ".$row["price"] ."</td></tr>";
		}
		echo "<tr><td colspan='3' align='center'><input type='submit' value='ADD'></td></tr>";
				echo "</table>";

		echo "</form>";
	}
	else										// No Available seats
	{
		echo "<p> NO SEATS ARE AVAILABLE";
	}
	?>
