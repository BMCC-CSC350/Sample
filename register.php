<?php
/********** RETRIEVE THE USER ACCOUNT ID **********/
session_start();
$userid = $_SESSION["userid"];
echo "<p style='font-weight: bold;font-size:24'> ACCOUNT FOR ".$userid." </p>";
/********** CONNECT TO THE DATABASE **********/
$servername="localhost";
$username="root";
$password= "root";
$connect=mysqli_connect($servername,$username,$password);
if(!$connect)  die("Error"); //else echo "connected";
/********** CHECK IF A NEW SEAT IS BEING RESERVED, IF SO INSERT THE SEAT AND USER INTO REGISTER TABLE **********/
if(isset($_REQUEST["seatno"]))
{
	$seatno = $_REQUEST["seatno"];
	$sql = "INSERT INTO sampleproject.register (Seats_SeatNo, User_UserName) VALUES ('".$seatno."','".$userid."');"; // Create query string
	$result = mysqli_query($connect, $sql); 	// Send the query to the database
}
/********** LIST THE RESERVED SEATS FOR THE USER **********/
	echo "<p style='color:red;font-size:24'> RESERVED SEATS </p>";
	$sql = "select seats_seatno,price  from sampleproject.register join sampleproject.seats on register.Seats_SeatNo = seats.SeatNo where User_UserName = '".$userid."'";
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
/********** LIST THE AVAILABLE SEATS **********/
	echo "<p style='color:green;font-size:24'> AVAILABLE SEATS</p>";
	$sql = "SELECT seatno,price FROM sampleproject.seats left join sampleproject.register on sampleproject.seats.SeatNo = sampleproject.register.Seats_SeatNo where Seats_SeatNo is null";
	$result = mysqli_query($connect, $sql); 	// Send the query to the database
	if (mysqli_num_rows($result) > 0) 			// If there are rows present
	{
		echo "<table border='1'><tr><td></td><td>SEAT NO</td><td>COST</td></tr>";
		echo "<form action='register.php' method='post'>";							// form to select a seat no
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
	echo "<p>";
	echo "<table><tr><td> <form action='signin.php' method='post'> <input type='submit' value='LOGOFF'></td></tr></table>";
	



?>