<?php
$ok = true;
/********** CHECK IF A USER IS REGISTERING **********/ 
if(isset($_REQUEST["userid"]) && isset($_REQUEST["password"]))
{
	$userid = $_REQUEST["userid"]; $passwd=$_REQUEST["password"];
/********** CONNECT TO THE DATABASE **********/
	include "dbconnect.php";
/********** CHECK IF A USER EXISTS WITH THE USERID AND PASSWORD ENTERED **********/
	$sql = "SELECT * FROM sampleproject.user where UserName='".$userid."' AND UserPass='".$passwd."'"; // Create query string
	$result = mysqli_query($connect, $sql); 						// send the query to the database
	if (mysqli_num_rows($result) > 0) 								// if there are rows present - a user exists with that userid/password
	{
		$ok=false;													// sign up failed
	}
	else															// userid and password is valid
	{
		$sql = "INSERT INTO sampleproject.user (UserName, UserPass) VALUES ('".$userid."','".$passwd."');"; // Create query string
		$result = mysqli_query($connect, $sql); 					// insert userid and password into user table
		$connect->close();
		header("Location: signin.php");	// redirect to signin.php
	}
}
$inputtype = "SIGN UP";
$handlername = "signup.php";
include "log.html";
?>
