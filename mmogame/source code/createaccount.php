<?php
$uid = htmlspecialchars($_GET["uid"]);
$pw = htmlspecialchars($_GET["pw"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

//Checking username existed
$sql = "SELECT * FROM user_account where User_ID = '" . $uid . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)==1){
	echo "UserID already existed. <br /> <a href='register.html'> OK </a>";	
} else {
	$sql2 = "INSERT INTO user_account VALUES ('" . $uid . "' , '" . $pw . "')";
	mysqli_query($conn, $sql2);
	echo "Account created. <br /> <a href='index.html'> OK </a>";
}
mysqli_free_result($result);

?>