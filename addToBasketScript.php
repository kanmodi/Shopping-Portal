<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
		

	$pid = $_REQUEST["q"];
	$quant = $_REQUEST["r"];
	// echo "$pid, $rat hello";

	session_start();
	if($_SESSION['user_name']!=null) {
		$uname = $_SESSION['user_name'];

		$r10 = mysqli_query($con, "select CID from customer where CUserName = '$uname'") or die("q10 error!");
		$cid = mysqli_fetch_row($r10);
		$cid = $cid[0];

		$r1 = mysqli_query($con, "select PPrice,Pstock from product where pid = $pid") or die("q1 error!");
		$t1 = mysqli_fetch_row($r1);
		$currprice = $t1[0];
		$stock = $t1[1];

		if($quant > $stock) {
			echo "Not enough items in stock!";
		}
		else {
			$r2 = mysqli_query($con, "select numprods,totalcost,bid from basket where cid = $cid") or die("q2 error!");
			$t2 = mysqli_fetch_row($r2);
			$numprods = $t2[0];
			$totalcost = $t2[1];
			$bid = $t2[2];

			$numprods+=$quant;
			$totalcost += $currprice*$quant;

			mysqli_query($con, "update basket set numprods = $numprods where bid = $bid") or die("q3 error!");
			mysqli_query($con, "update basket set totalcost = $totalcost where bid = $bid") or die("q4 error!");

            
			$r5 = mysqli_query($con, "insert into basketprods(bid,pid,quantity) values($bid, $pid, $quant)") or (mysqli_query($con, "update basketprods set quantity = quantity + $quant where pid=$pid and bid=$bid")) or die("q5 error!");
			echo "Added :)";
		}
	}
	else {
		echo "Login to continue";
	}
?>