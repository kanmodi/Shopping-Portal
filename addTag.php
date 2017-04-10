<?php
	
	echo $_SERVER['PHP_SELF'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onlineShopping";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	$pid = 27;

	$a = array("electronics", "philips", "vacuum", "cleaner", "vacuumcleaner");
	for($i=0; $i < count($a); $i++) {
		echo ("select TagID from tag where TagName = '".$a[$i]."'"."</br>");
		$b = $conn->query("select TagID from tag where TagName = '".$a[$i]."'") or die("ersdf");
		
		$c = null;
		while($row = $b->fetch_assoc()) {
	        $c = $row["TagID"];
	    }
	    echo ("insert into tagProduct values(".$pid.",".$c.")"."</br>");
		$conn->query("insert into tagProduct values(".$pid.",".$c.")")or die("ersdf2");
	}
$conn->close();
	echo "done";
?>
