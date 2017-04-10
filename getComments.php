<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "isdm";

	$con = mysqli_connect($servername, $username, $password, $dbname);
		

	$q = $_REQUEST["q"];
	$query = "select CName, Comment from comment natural join customer where PID = $q";
	$result = mysqli_query($con, $query);
	$rows = mysqli_num_rows($result);

	echo "</br><center><table><tr>  <th>User</th> <th>Comment</th></tr>";
	for ($j = 0 ; $j < $rows ; ++$j) {
		$row = mysqli_fetch_row($result);
		echo "<tr>";
		echo "<td>$row[0]</td>";
		echo "<td>$row[1]</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<textarea name=\"txtAr\" rows=3 cols=40></textarea></br>";
	echo "<center><input type=\"submit\" value = \"Add Comment\" name = \"addComm\" onclick=\"addComment($q,'txtAr')\">";
	echo "<span id=\"abcd\"></span></center>";
?>


<body>
	<span id="abcd"></span></center>
</body>
