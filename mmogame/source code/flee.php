<?php
$gid = htmlspecialchars($_GET["gid"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

//Get room info
$sql = "SELECT * FROM room where RID = '" . $gid . "'";
$result = mysqli_query($conn , $sql);
$row = mysqli_fetch_array($result);

$cname = $row["Char_Name"];

mysqli_free_result($result);

$usql = "DELETE FROM room WHERE RID = " . $gid;
mysqli_query($conn, $usql);

header('Location: '. "main.php?cname=" . $cname);
?>