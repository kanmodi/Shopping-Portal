<!DOCTYPE html>
<html>
<head>
	<script src="scripts.js">
	</script>
</head>


<body>

	<font size="7"><center>ONLINE SHOPPING PORTAL</center></font>	

	<div align="right"> 
		<?php
			$_SESSION['user_name'] = null;
            $_SESSION['user_email'] = null;
            $_SESSION['user_login_status'] = null;
			if (version_compare(PHP_VERSION, '5.5.0', '<')) {
			    require_once("libraries/password_compatibility_library.php");
			}
			require_once("config/db.php");
			require_once("classes/Login.php");
			$login = new Login();


			echo "<span id=\"loginSpace\">";
			if($login->isUserLoggedIn()) {
				echo "<font size=\"5\">Hello, " . $_SESSION['user_name'];
				echo "</font></br><font size=\"4\"><a href=\"userAccount.php\">My Account&nbsp;&nbsp;&nbsp;</a></font>";
				echo "   <a href=\"basket.php\"><img src=\"cart.png\" style=\"width:40px;height:40px\"></a>";
				echo "</br></br><button onclick=\"abc()\">Logout</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			else {
				$_SESSION['user_name'] = null;
	            $_SESSION['user_email'] = null;
	            $_SESSION['user_login_status'] = null;
				echo "<a href=\"index.php\"> Login/Register </a>";
			}
			echo "</span>";
		?>
	</div>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<center>
			<input type="text" size="50" name="searchbar" onkeyup="showHint(this.value)" autocomplete="off" />	
			<input type="submit" name="searchbutton" value="Search">
			<p>Suggestions: <span id="txtHint"></span></p>	
		</center>
	</form>
</body>
</html>



<?php
	$s = null;
	if(isset($_POST["searchbutton"])) {	
		$s = $_POST["searchbar"];
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "isdm";

		$con = mysqli_connect($servername, $username, $password, $dbname);
		

		$query = "select * from product where PID in (select PID from tagProduct NATURAL JOIN tag where TagName = \"$s\") UNION select * from product where PName = \"$s\" ";
		$result = mysqli_query($con, $query);
		if (!$result) die ("Database access failed: " . mysql_error());
		$rows = mysqli_num_rows($result);
		if($rows > 0) {
			echo <<<html
			</br><center><table> 
			<col width="40">
			<col width="200">
			<col width="50">
			<col width="55">
			<col width="90">
			<col width="60">
			<col width="100">

			<tr><th>S.No.</th> 
			<th>Name</th>
			<th>Price</th>
			<th>Stock</th>
			<th>AvgRating</th>
			<th>AddRating</th>
			<th>Commments</th>
			
			<th></th></tr>
html;
			for ($j = 1 ; $j <= $rows ; ++$j) {
				$row = mysqli_fetch_row($result);
				//Exclude out of stock
				//if($row[5]<=0) 
					//continue;
				echo "<tr>";
				echo "<td><center>$j</center></td>";
				echo "<td><a href=\"$row[4]\"><center>$row[1]</center></td>";
				echo "<td><center>$row[3]</center></td>";
				if($row[5] > 0)
				echo "<td><center>$row[5]</center></td>";
			   else 
			   	echo "<td><center>Out of Stock</center></td>";

				$q3 = "select avg(Value) from rating where PID = $row[0]";
				$r3 = mysqli_query($con, $q3);
				$rat = mysqli_fetch_row($r3);
				$rat1 = $rat[0];
				if($rat1!=null) {
					echo "<td><center>$rat1</center></td>";
				}
				else {
					echo "<td><center>unrated</center></td>";
				}
				if(session_status()==PHP_SESSION_ACTIVE) {
					echo "<td><center><input type=\"button\"  onclick=\"addRating($row[0])\" value = \"RateIt\"></center></td>";	
				}
				else {
					echo "<td><center>login to rate</center></td>";
				}
				echo "<td><center><input type=\"button\"  onclick=\"showComments($row[0])\" value = \"View Comments\"></center></td>";
				
				echo "<td><center><input type=\"button\"  onclick=\"addToBasket($row[0])\" value = \"Add to Basket\"></center></td>";


				echo "</tr>";
			}
			echo "</table></center>";
		}
		else {
			echo "<center>Not found!</center>";
		}
		echo "<span id=\"comm\"></span>";
		// echo "<br><br><center>COMMENTS<br>";
		// echo "<span id=\"comm\"></span></center>";
	}

?>
