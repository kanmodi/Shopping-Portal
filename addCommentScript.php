<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
		

	$pid = $_REQUEST["q"];
	$comm = $_REQUEST["r"];
	session_start();
	if($_SESSION['user_name']!=null) {
		$uname = $_SESSION["user_name"];
		$q1 = "select CID from customer where CUserName = '$uname'";
		$r1 = mysqli_query($con, $q1) or die("q1 error!");
		$cid = mysqli_fetch_row($r1);
		$cid = $cid[0];

		// echo "$pid,$comm, $uname,$cid";
		$q2 = "insert into comment(CID, PID, Comment) values($cid,$pid,\"$comm\")";
		$r2 = mysqli_query($con, $q2) or die("q2 error!");
		echo "Comment Added Successfuly!";
	}
	else {
		echo "</br>You need to be logged in to comment.";
	}
?>