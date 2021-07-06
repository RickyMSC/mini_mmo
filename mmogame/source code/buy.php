<?php
$cname = htmlspecialchars($_GET["cname"]);
$Item_ID = htmlspecialchars($_GET["Item_ID"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

//Get item info
$sql="SELECT * FROM item WHERE Item_ID = '" . $Item_ID . "'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);

//Get character info
$sql2="SELECT * FROM character_info WHERE Char_Name = '" . $cname . "'";
$result2=mysqli_query($conn , $sql2);
$row2=mysqli_fetch_array($result2);

//Get shop info
$sql3="SELECT * FROM shop WHERE Item_ID = '" . $Item_ID . "'";
$result3= mysqli_query($conn , $sql3);
$row3=mysqli_fetch_array($result3);

$money=$row2["Char_Money"]-$row3["prices"];

if($row2["Char_Money"]>=$row3["prices"]){
$sql4 = "INSERT INTO inventory VALUES ('" . $cname . "' , '" . $Item_ID . "', 1 , NULL)";
mysqli_query($conn , $sql4);
$sql5 = "UPDATE character_info SET Char_Money = '" . $money . "'";
mysqli_query($conn , $sql5);
echo "You bought a " .  $row["Item_name"]  . " ! You now have $" . $money . " left. </br><a href='shop.php?cname=$cname'> </br> OK </a>";  
}else {echo "Sorry, you don't have enough money! </br><a href='shop.php?cname=$cname'> </br> OK </a>";}


