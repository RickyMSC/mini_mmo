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
$sql ="SELECT * FROM room where RID = '" . $gid . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//Get player info
$sql2 = "SELECT * FROM  character_info where Char_Name = '" . $row["Char_Name"] . "'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);

//Get enemy info
$sql3 = "SELECT * FROM enemy where Enemy_ID = '" . $row["Enemy_ID"] . "'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($result3);

//Get level info
$sql4 = "SELECT * FROM level_stats where Level =" . $row2["Level"];
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_array($result4);

//Get inventory info
$sql5 = "SELECT * FROM inventory where Char_Name ='" . $row["Char_Name"] . "'";
$result5=mysqli_query($conn, $sql5);

$ATK= $row4["ATK"];
$DEF= $row4["DEF"];
	

while(($row5 = mysqli_fetch_array($result5))!=null){
$sql6 = "SELECT * FROM item where Item_ID ='" . $row5["Item_ID"] . "'";
$result6 = mysqli_query($conn , $sql6);
while(($row6 = mysqli_fetch_array($result6))!=null){
		$type=$row6["Item_type"];
		$equip=$row5["Equipped"];
		if($type==1&&$type!=2&&$equip!=null){$ATK= $row4["ATK"]+$row6["Item_stats"];
    } else if($type==2&&$type!=1&&$equip!=null){$DEF = $row4["DEF"]+$row6["Item_stats"];}
	else if($type==1&&$type!=2&&$equip==null){$ATK=$ATK;}
	else if($type==2&&$type!=1&&$equip==null){$DEF=$DEF;}
	
}
}

//Player info
$type= $row6["Item_type"];
$patt = $ATK;
$pdef = $DEF;
$php = $row["HP"];


//Enemy info
$eatt = $row3["ATK"];
$ehp = $row["EHP"];
	
//DMG calculate	
$pdmg = $eatt - $pdef;
if ($pdmg <0 ){
	$pdmg = 0;
}

$edmg = $patt;

$php -= $pdmg;
$ehp -= $edmg;

$usql = "UPDATE room set HP = " . $php . " WHERE RID = '" . $gid . "'" ;
mysqli_query($conn, $usql);
$usql2 = "UPDATE room set EHP = " . $ehp . " WHERE RID = '" . $gid . "'";
mysqli_query($conn, $usql2);

mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_free_result($result3);
mysqli_free_result($result4);

if ($php<=0) {
	header ('Location: ' . "die.php?gid=" . $gid);
} else if ($ehp <= 0){
	header('Location: ' . "win.php?gid=" . $gid);
} else {
	header('Location: ' . "game.php?gid=" . $gid);
}

?>




