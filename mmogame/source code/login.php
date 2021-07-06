<?php
$uid = htmlspecialchars($_GET["uid"]);
$pw = htmlspecialchars($_GET["pw"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

$charlist = "charlist.php?uid=" . $uid;

//Create connection
$conn = mysqli_connect($servername,$username,$password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

$sql = "SELECT * FROM user_account where User_ID = '" . $uid . "' and User_pw = '" . $pw . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)==1){
mysqli_free_result($result);
header('Location: ' . $charlist);
} else {
echo "Login fail, please check your id or pw.  <br /> <a href='index.html'> Back </a>";
mysqli_free_result($result);
}
?>