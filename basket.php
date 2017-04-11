<html>
<head>
	<script>
		function removeProd(pid,bid,quantity,price) {
			var r = confirm("Confirm Remove?");
			if(r==false) return;
			var t = new XMLHttpRequest();
			t.onreadystatechange = function() {
				if(t.readyState == 4 && t.status == 200) {
					document.getElementById("show").innerHTML = t.responseText;
				}
			}
			t.open("GET", "basketUtil.php?q="+pid+"&r="+bid+"&t="+quantity+"&u="+price,true);
			t.send();
		}
		function checkout(bid) {
			if(bid){
				var r = confirm("Are you sure you want to buy these items?");
				if(r==false) return;
			}
			else {
				alert("No items in the basket.");
				return;
			}
			var t = new XMLHttpRequest();
			t.onreadystatechange = function() {
				if(t.readyState == 4 && t.status == 200) {
					alert(t.responseText);
				}
			}
			t.open("GET", "checkout.php?q="+bid,true);
			t.send();
		}
	</script>
</head>


<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
	session_start();
	$uname = $_SESSION['user_name'];

	$r10 = mysqli_query($con, "select CID from customer where CUserName = '$uname'") or die("q10 error!");
	$cid = mysqli_fetch_row($r10);
	$cid = $cid[0];

	$r1 = mysqli_query($con, "select pname,quantity,pid,bid,pprice from basket natural join basketprods natural join product where  cid = $cid") or die("No user logged in!");
	$n = mysqli_num_rows($r1);
	$bid = null;
	echo <<<ab
		<center><font size="6">BASKET PRODUCTS</font></br></br></br>
		<table>
			<tr>
				<td>S.No.</td>
				<td>Product Name</td>
				<td>Quantity</td>
				<td>Total Price</td>
				<td></td>
			</tr>
ab;
	for($i=1; $i<=$n; $i++) {
		$an = mysqli_fetch_row($r1);
		$bid = $an[3];
		$x = $an[4]*$an[1];
		echo "<tr><td>$i</td><td>$an[0]</td><td>$an[1]</td><td>$x</td>";
		echo "<td><button class=\"btn btn-primary\" onclick=\"removeProd($an[2],$an[3],$an[1],$an[4])\">Remove</button></td></tr>";
	}
	echo "</table>";
	echo "</br><span id=\"show\"></span>";
	echo "</br><a href=\"searchProd.php\">Back to Home</a></br></br>";
	echo "<font size=\"5\"><button class=\"btn btn-primary\" onclick=\"checkout($bid)\">Checkout</button></font></center>"
?>
