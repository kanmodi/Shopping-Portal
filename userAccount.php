<script>
	function updateUser(a,b,c,d) {
		var a1 = document.getElementsByName(a)[0].value;
        var b1 = document.getElementsByName(b)[0].value;
        var c1 = document.getElementsByName(c)[0].value;
        var d1 = document.getElementsByName(d)[0].value;
        var t = new XMLHttpRequest();
		t.onreadystatechange = function() {
			if(t.readyState == 4 && t.status == 200) {
				alert(t.responseText);
			}
		}
		t.open("GET", "updateUserScript.php?q="+a1+"&r="+b1+"&s="+c1+"&t="+d1,true);
		t.send();
	}
</script>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";
	$con = mysqli_connect($servername, $username, $password, $dbname);
	session_start();
	$uname = $_SESSION['user_name'];
	
	$r10 = mysqli_query($con, "select cname,cemail,cgender,cdob,cmobileno from customer where CUserName = '$uname'") or die("q10 error!");
	$t = mysqli_fetch_row($r10);
	$name = $t[0];
	$email = $t[1];
	$gender = $t[2];
	$dob = $t[3];
	$mobileno = $t[4];

	// echo "$uname";
	$r11 = mysqli_query($con, "select street,city,state,zipcode from address where addid = (select billingaddID from customer where cusername = '$uname')") or die("q11 error!");
	$r12 = mysqli_query($con, "select street,city,state,zipcode from address where addid = (select deliveryaddID from customer where cusername = '$uname')") or die("q12 error!");
	$t11 = mysqli_fetch_row($r11);
	$t12 = mysqli_fetch_row($r12);
	$billadd = $t11[0].", ".$t11[1].", ".$t11[2].", ".$t11[3];
	$deliveryadd = $t12[0].", ".$t12[1].", ".$t12[2].", ".$t12[3];
	// echo "$dob,$gender,$mobileno";
	echo <<<html
		<center><table>
			<tr>
				<td>Name</td>
				<td><input type="textbox" value='$name' name="cname"></td>
			</tr>
			<tr>
				<td>User Name</td>
				<td><label>$uname</label></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><label>$email</label></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><input type="textbox" value='$gender' name="cgender"></td>
			</tr>
			<tr>
				<td>DOB</td>
				<td><input type="date" value='$dob' name="cdob"></td>
			</tr>
			<tr>
				<td>Mobile Number</td>
				<td><input type="textbox" value='$mobileno' name="cmobileno"></td>
			</tr>
			<tr>
				<td>Billing Address</td>
				<td>$billadd</td>
			</tr>
			<tr>
				<td>Delivery Address</td>
				<td>$deliveryadd</td>
			</tr>
		</table>
		</br>
		<a href="searchProd.php">Back to Home</a></br></br>
		<input type="button" value="Update" onclick="updateUser('cname', 'cgender', 'cdob', 'cmobileno')">
		</center>
html;
?>