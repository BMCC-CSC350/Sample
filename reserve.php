<?php
/********** RETRIEVE THE USER ACCOUNT ID **********/
session_start();
$userid = $_SESSION["userid"];
echo "<p style='font-weight: bold;font-size:24'> ACCOUNT FOR ".$userid." </p>";
/********** CONNECT TO THE DATABASE **********/
include "dbconnect.php";
/********** CHECK IF A NEW SEAT IS BEING RESERVED, IF SO INSERT THE SEAT AND USER INTO RESERVE TABLE **********/
if(isset($_REQUEST["seatno"]))
{
	$seatno = $_REQUEST["seatno"];
	$sql = "INSERT INTO sampleproject.reserve (Seats_SeatNo, User_UserName) VALUES ('".$seatno."','".$userid."');"; // Create query string
	$result = mysqli_query($connect, $sql); 	// Send the query to the database
}
/********** LIST THE RESERVED SEATS FOR THE USER **********/
include "reservelist.php";
/********** LIST THE AVAILABLE SEATS **********/
include "availablelist.php";
	echo "<p>";
	echo "<table><tr><td> <form action='signin.php' method='post'> <input type='submit' value='LOGOFF'></td></tr></table>";
	



?>