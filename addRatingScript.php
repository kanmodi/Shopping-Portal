<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
		

	$pid = $_REQUEST["r"];
	$rat = $_REQUEST["q"];
	// echo "$pid, $rat hello";

	session_start();
	if($_SESSION['user_name']!=null) {
		$uname = $_SESSION['user_name'];
		// echo "$uname";
		$q1 = "select CID from customer where CUserName = '$uname'";
		$r1 = mysqli_query($con, $q1) or die("q1 error!");
		$cid = mysqli_fetch_row($r1);
		$cid = $cid[0];

		$q3 = "select * from rating where cid=$cid and pid=$pid";
		$r3 = mysqli_query($con,$q3) or die("q3 error");	
		$ro = mysqli_num_rows($r3);
		// echo "$cid, $pid";
		if($ro==1) {
			$r4 = mysqli_query($con,"delete from rating where cid=$cid and pid=$pid") or die("q4 error");
		}
		// echo "$pid,$comm, $uname,$cid";
		$q2 = "insert into rating(CID, PID, Value) values($cid,$pid,$rat)";
		$r2 = mysqli_query($con, $q2) or die("q2 error!");
		echo "Thanks for rating :)";
	}
	else {
		echo "Login to rate";	
	}
?>