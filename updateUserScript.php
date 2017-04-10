<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
		

	$name = $_REQUEST["q"];
	$gender = $_REQUEST["r"];
	$dob = $_REQUEST["s"];
	$mobileno = $_REQUEST["t"];

	session_start();
	$uname = $_SESSION['user_name'];

	// echo "$name,$dob";

if($name!=null)
	$r1 = mysqli_query($con, "update customer set cname = '$name' where cusername='$uname' ") or die("q1 error");
if($gender!=null)
	$r2 = mysqli_query($con, "update customer set cgender = '$gender' where cusername='$uname' ") or die("q2 error");
if($dob!=null)
	$r3 = mysqli_query($con, "update customer set cdob = $dob where cusername='$uname' ") or die("q3 error");
if($mobileno!=null)
	$r4 = mysqli_query($con, "update customer set cmobileno = $mobileno where cusername='$uname' ") or die("q4 error");

	echo "Successfuly updated :)";
?>