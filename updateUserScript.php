<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);


	// $name = $_REQUEST["q"];
	// $gender = $_REQUEST["r"];
	// $dob = $_REQUEST["s"];
	$mobileno = $_REQUEST["q"];
	$billstreet = $_REQUEST["r"];
	$billcity = $_REQUEST["s"];
	$billstate = $_REQUEST["t"];
	$billzip = $_REQUEST["u"];
	$delstreet = $_REQUEST["v"];
	$delcity = $_REQUEST["w"];
	$delstate = $_REQUEST["x"];
	$delzip = $_REQUEST["y"];

	session_start();
	$uname = $_SESSION['user_name'];

	// echo "$name,$dob";

if($mobileno!=null){
	if (strlen($mobileno) != 10){
		echo "Incorrect Number Format";
		return;
	}
	else
		$r1 = mysqli_query($con, "update customer set cmobileno = $mobileno where cusername='$uname' ") or die("q1 error");
}
if($billstreet!=null)
	 $r2 = mysqli_query($con, "update address set street = '$billstreet' where addid in (select billingaddid from customer where cusername='$uname')") or die("q2 error");
if($billcity!=null)
	$r3 = mysqli_query($con, "update address set city = '$billcity' where addid in (select billingaddid from customer where cusername='$uname')") or die("q3 error");
if($billstate!=null)
	$r4 = mysqli_query($con, "update address set state = '$billstate' where addid in (select billingaddid from customer where cusername='$uname')") or die("q4 error");
if($billzip!=null){
	if (strlen($billzip) != 6){
		echo "Incorrect ZipCode Format";
		return;
	}
	else
		$r5 = mysqli_query($con, "update address set zipcode = '$billzip' where addid in (select billingaddid from customer where cusername='$uname')") or die("q5 error");
	}
if($delstreet!=null)
	$r6 = mysqli_query($con, "update address set street = '$delstreet' where addid in (select deliveryaddid from customer where cusername='$uname')") or die("q6 error");
if($delcity!=null)
	$r7 = mysqli_query($con, "update address set city = '$delcity' where addid in (select deliveryaddid from customer where cusername='$uname')") or die("q7 error");
if($delstate!=null)
	$r8 = mysqli_query($con, "update address set state = '$delstate' where addid in (select deliveryaddid from customer where cusername='$uname')") or die("q8 error");
if($delzip!=null){
	if (strlen($billzip) != 6){
		echo "Incorrect ZipCode Format";
		return;
	}
	else
		$r9 = mysqli_query($con, "update address set zipcode = '$delzip' where addid in (select deliveryaddid from customer where cusername='$uname')") or die("q9 error");
	}
	echo "Successfuly updated :)";
?>
