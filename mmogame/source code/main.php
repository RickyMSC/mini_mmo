<?php
$cname = htmlspecialchars($_GET["cname"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

// Check if there is a previous fight
$sql = "SELECT * FROM room where Char_Name = '" . $cname . "'";
$result = mysqli_query($conn, $sql);



if (mysqli_num_rows($result)==1){
	$row = mysqli_fetch_array($result);
	$rid = $row["RID"];
	mysqli_free_result($result);
	header('Location: '. "game.php?gid=" . $rid);
}else {
	// read char_info from db
	mysqli_free_result($result);
	$sql = "SELECT * FROM character_info where Char_Name = '" . $cname . "'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	$sql2 = "SELECT * FROM level_stats where Level = " . $row["Level"];
	$result2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_array($result2);
	
	//Get inventory info
    $sql3 = "SELECT * FROM inventory where Char_Name ='" . $row["Char_Name"] . "'";
    $result3=mysqli_query($conn, $sql3);
    
	$ATK= $row2["ATK"];
	$DEF= $row2["DEF"];
	
while(($row3 = mysqli_fetch_array($result3))!=null){
    $sql4 = "SELECT * FROM item where Item_ID ='" . $row3["Item_ID"] . "'";
    $result4 = mysqli_query($conn , $sql4);
	while(($row4 = mysqli_fetch_array($result4))!=null){
		$type=$row4["Item_type"];
		$equip=$row3["Equipped"];
		if($type==1&&$type!=2&&$equip=='E'){$ATK= $row2["ATK"]+$row4["Item_stats"]; 
    } else if($type==2&&$type!=1&&$equip=='E'){$DEF = $row2["DEF"]+$row4["Item_stats"];}
	else if($type==1&&$type!=2&&$equip==null){$ATK=$ATK;}
	else if($type==2&&$type!=1&&$equip==null){$DEF=$DEF;}
		
	}
}
	
	echo ('<a href="index.html"> Logout </a>');
	echo ('<br/>');
	echo ('<br/>');
	
	// display character info
	echo("Character name : ");
	echo($row["Char_Name"]);
	echo("<br/>");
	echo("Level :");
	echo($row["Level"]);
	echo("<br/>");
	echo("Exp :");
	echo($row["EXP"] . " / " . $row2["exp_to_next"]);
	echo("<br/>");
	echo("HP : ");
	echo($row2["HP"]);
	echo("<br/>");
	echo("Attack : ");
	echo($ATK);
	echo("<br/>");
	echo("Defence : ");
	echo($DEF);
	echo("<br/>");
	echo("Money : ");
	echo($row["Char_Money"]);
	
	echo("<br/>");
	echo("<a href='inventory.php?cname=" . $cname . "'> Inventory </a>");
	
	echo("<br/>");
	echo("<a href='shop.php?cname=" . $cname . "'> Shop </a>");
	
	echo("<br />");
	echo("<hl> Select the enemy to fight </hl><br />");
	$sql5 = "SELECT * FROM enemy";
	$result5 = mysqli_query($conn, $sql5);
	while (($row5 = mysqli_fetch_array($result5)) != null) {
		echo('<a href="createroom.php?cname=' . $cname . '&eid=' . $row5["Enemy_ID"] . '">' . $row5["Enemy_Name"] ."</a><br/>");
	}
	mysqli_free_result($result);
    mysqli_free_result($result2);
    mysqli_free_result($result5);
}

?>
	