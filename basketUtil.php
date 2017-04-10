<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
	session_start();
	$uname = $_SESSION['user_name'];

	$pid = $_REQUEST['q'];
	$bid = $_REQUEST['r'];
	$quant = $_REQUEST['t'];
	$price = $_REQUEST['u'];

	// echo "$pid,$bid";
	$r1 = (mysqli_query($con, "delete from basketprods where pid=$pid and bid=$bid") and mysqli_query($con, "update basket set numprods=numprods-$quant where bid=$bid") and mysqli_query($con, "update basket set totalcost=totalcost-($price*$quant) where bid=$bid") )or die("q error");


	echo "Entry removed</br><a href=\"basket.php\">Click here to refresh</a>";
?>