<?php
$ok = true;
/********** CHECK IF A SEAT IS BEING INSERTED **********/ 
if(isset($_REQUEST["seatno"]) && isset($_REQUEST["price"]))
{
	$seatno = $_REQUEST["seatno"]; $price=$_REQUEST["price"];
/********** CONNECT TO THE DATABASE **********/
	include "dbconnect.php";
/********** CHECK IF A USER EXISTS WITH THE USERID AND PASSWORD ENTERED **********/
	$sql = "SELECT * FROM sampleproject.seats where SeatNo='".$seatno."' AND Price='".$price."'"; // Create query string
	$result = mysqli_query($connect, $sql); 						// send the query to the database
	if (mysqli_num_rows($result) > 0) 								// if there are rows present - a user exists with that userid/password
	{
		$ok=false;													// sign up failed
	}
	else															// userid and password is valid
	{
		$sql = "INSERT INTO sampleproject.seats (Seatno, Price) VALUES ('".$seatno."','".$price."');"; // Create query string
		$result = mysqli_query($connect, $sql); 					// insert userid and password into user table
		$connect->close();
	//	echo "<p> SEAT INSERTED";
	//	header("Location: signin.php");	// redirect to signin.php
	}
}
$inputtype = "INSERT SEAT";
$handlername = "seatinsert.php";
include "seat.html";
?>
