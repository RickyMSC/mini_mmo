<?php
$cname = htmlspecialchars($_GET["cname"]);
$eid = htmlspecialchars($_GET["eid"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

//Check if there is previous fighting
$sql = "SELECT * FROM room where Char_Name = '" . $cname . "'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)==1){
	//remove old room
	$row = mysqli_fetch_array($result);
	$rid = $row["RID"];
	mysqli_free_result($result);
	$sql2 = "DELETE FROM room where Char_Name = '" . $cname . "'";
	mysqli_query($conn , $sql);
}
mysqli_free_result($result);
//read player info
$sql2 = "SELECT * FROM character_info where Char_Name = '" . $cname . "'";
$result2 = mysqli_query($conn , $sql2);
$row2 = mysqli_fetch_array($result2);

// read enemy info
$sql3 = "SELECT * FROM enemy where Enemy_ID = '" . $eid . "'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($result3);

//read level info
$sql4 = "SELECT * FROM level_stats where Level = " . $row2["Level"];
$result4 = mysqli_query($conn , $sql4);
$row4 = mysqli_fetch_array($result4);

$maxsql= "select count(*) as num, max(RID) as m from room";
$maxresult = mysqli_query($conn, $maxsql);
$maxrow= mysqli_fetch_array($maxresult);

$max=0;
if ($maxrow["num"] != 0){
	$max = $maxrow["m"] + 1;
}


$sql5 = "INSERT INTO room VALUES (" . $max . " , '" . $cname . "' , " . $row4["HP"] . " , '" . $eid . "' ," . $row3["DEF"] . ")";
mysqli_query($conn, $sql5);
mysqli_free_result($maxresult);
header('Location: '. "game.php?gid=" . $max )

?>















