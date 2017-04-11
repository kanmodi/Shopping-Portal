<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
	<script src="scripts.js">
	</script>
</head>


<body>
<div class="container-fluid">
	<div align="center">
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
				echo "<nav class=\"navbar navbar-default\"><a class=\"navbar-brand\">Hello, " . $_SESSION['user_name'];
				echo "</a><button  class=\"btn btn-primary\"><a href=\"userAccount.php\" style=\"color:white\">My Account</a></button>";
				echo "   ";
				echo "<button onclick=\"abc()\" class=\"btn btn-primary\">Logout</button></nav>";
				/*echo "<div><font size=\"4\">Hello, " . $_SESSION['user_name'];
				echo "</font><font size=\"4\"><a href=\"userAccount.php\">My Account&nbsp;&nbsp;&nbsp;</a></font>";
				echo "   <a href=\"basket.php\"><img src=\"cart.png\" style=\"width:40px;height:40px\"></a>";
				echo "<button onclick=\"abc()\">Logout</button></div>";*/
			}
			else {
				$_SESSION['user_name'] = null;
	            $_SESSION['user_email'] = null;
	            $_SESSION['user_login_status'] = null;
				echo "<button class=\"btn btn-primary\"><a href=\"index.php\" style=\"color: white\">Login/Register</a></button>";
			}
			echo "</span>";
		?>
	</div>

	<font size="7"><center>Shopper's Stop<a class="right" href="basket.php">
		<img src="cart.png" style="width:40px;height:40px"></a></center></font>
	<div class="form-group">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<center>
				<label for="searchtext">Search:</label>
				<input type="text" size="50" name="searchbar" onkeyup="showHint(this.value)" id="searchtext" autocomplete="off" />
				<input type="submit" name="searchbutton" value="Search" class="btn btn-primary">
				<p>Suggestions: <span id="txtHint"></span></p>
			</center>
		</form>
	</div>
</div>
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

			<tr>
			<th><center>S.No.</center></th>
			<th><center>Name</center></th>
			<th><center>Price</center></th>
			<th><center>Stock</center></th>
			<th><center>AvgRating</center></th>
			<th><center>AddRating</center></th>
			<th style="width: 150px"><center>Commments</center></th>
			<th></th>
			</tr>
html;
			for ($j = 1 ; $j <= $rows ; ++$j) {
				$row = mysqli_fetch_row($result);
				//Exclude out of stock
				//if($row[5]<=0)
					//continue;
				echo "<tr>";
				echo "<td><center>$j</center></td>";
				echo "<td><center>$row[1]</center></td>";
				echo "<td><center>$row[3]</center></td>";
				if($row[4] > 0)
				echo "<td><center>$row[4]</center></td>";
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
					echo "<td><center><input type=\"button\"  onclick=\"addRating($row[0])\" value = \"RateIt\" class=\"btn btn-primary\"></center></td>";
				}
				else {
					echo "<td><center>login to rate</center></td>";
				}
				echo "<td><center><input type=\"button\"  onclick=\"showComments($row[0])\" value = \"View Comments\" class=\"btn btn-primary\"></center></td>";

				echo "<td><center><input type=\"button\"  onclick=\"addToBasket($row[0])\" value = \"Add to Basket\" class=\"btn btn-primary\"></center></td>";


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
