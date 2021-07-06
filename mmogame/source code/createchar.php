<?php
$uid = htmlspecialchars($_GET["uid"]);
$cname = htmlspecialchars($_GET["cname"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

$sql = "SELECT * FROM character_info where Char_Name = '" . $cname . "'";
$result = mysqli_query($conn, $sql);

if(($row = mysqli_fetch_array($result))!= null){	
	echo "Character name existed, please chooose another name.";
} else {
	$sql2 = "INSERT INTO character_info VALUES ('" . $uid . "' , 1 ,'" . $cname . "' , 0 , 0 )";
	mysqli_query($conn, $sql2);
	echo "Character created."; 
}
echo "<br />";
echo "<a href='charlist.php?uid=$uid'> </br> OK </a>";
?>