<?php
$uid = htmlspecialchars($_GET["uid"]);
$cname = htmlspecialchars($_GET["cname"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";


//Create connection
$conn = mysqli_connect($servername,$username,$password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

//Check if character existed
$sql = "SELECT * FROM character_info where Char_Name = '" . $cname . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)==1){
	echo "Welcome back! <br /> <a href='main.php?cname=$cname'> start </a>";
} else {
echo "Character doesn't exist, please check your spelling <a href='charlist.php?uid=$uid'> </br>back </a>";
}
mysqli_free_result($result);

?>