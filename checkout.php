<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
	session_start();
	$uname = $_SESSION['user_name'];

	$bid = $_REQUEST["q"];
	$r10 = mysqli_query($con, "select CID from customer where CUserName = '$uname'") or die("q10 error!");
	$cid = mysqli_fetch_row($r10);
	$cid = $cid[0];

	$r1 = mysqli_query($con, "insert into ordr(cid,purchasedate,paymentMode,orderstatus) values($cid,date(now()),'COD', 'pending')") or die("q1 err");
	$ordrid = mysqli_insert_id($con);


	$r2 = mysqli_query($con, "insert into orderedProduct(orderID, PId, quatity) select $ordrid, PId, quantity from basketProds where BID=$bid") or die("q2 err");

	//$r5 = mysqli_query($con, "update product set pstock = pstock-quantity where PID =(Select pid ") or die("q2 err");

	$r3 = mysqli_query($con, "update basket set numprods=0,totalcost=0 where bid=$bid") or die("q3 err");

	$r4 = mysqli_query($con, "delete from basketprods where bid = $bid") or die("q4 err");


	$r5 = mysqli_query($con,"select * from address where cid=$cid");

	$result = mysqli_query($r5);
while($row = mysqli_fetch_array($result)) {
echo $row['fieldname'];
}

	echo "Items bought successfuly. Thank You :)";
?>