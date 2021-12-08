<?php
/********** CLEAR THE USERID SESSION VARIABLE **********/
session_start();
$_SESSION["userid"] = "";
$ok = true;
/********** CHECK IF A USER IS LOGGING IN **********/ 
if(isset($_REQUEST["userid"]) && isset($_REQUEST["password"]))
{
	$userid = $_REQUEST["userid"]; $passwd=$_REQUEST["password"];
/********** CONNECT TO THE DATABASE **********/
	include "dbconnect.php";
/********** CHECK IF THE USER EXISTS WITH THE USERID AND PASSWORD ENTERED **********/
	$sql = "SELECT * FROM sampleproject.user where UserName='".$userid."' AND UserPass='".$passwd."'"; // Create query string
	$result = mysqli_query($connect, $sql); 					// Send the query to the database
	if (mysqli_num_rows($result) > 0) 							// if there are rows present - the user exists - successful login
	{
		$connect->close();										// close database connection
		$_SESSION["userid"] = $userid;							// set the userid session variable to the userid value
		header("Location: http://localhost/SampleProject/reserve.php");	// redirect to register.php
	}
	else
	{
		$ok=false;												// the user doe not exist in the database
	}
}
$inputtype = "SIGN IN";
$handlername = "signin.php";

include "log.html";

?>
