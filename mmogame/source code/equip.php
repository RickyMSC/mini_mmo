<?php
$cname = htmlspecialchars($_GET["cname"]);
$itid = htmlspecialchars($_GET["Item_ID"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

//Check equipped status
$sql = "SELECT * FROM inventory where Char_Name = '" . $cname . "'& Equipped IS NOT NULL ";
$result = mysqli_query($conn, $sql);
    
while (($row = mysqli_fetch_array($result))!= null) {
    $sql2 = "SELECT * FROM item where Item_ID = '"  . $row["Item_ID"] . "'";
    $result2 = mysqli_query($conn, $sql2);
    
    $sql3 = "SELECT * FROM item where Item_ID = '" . $itid . "'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    
    while (($row2 = mysqli_fetch_array($result2))!= null) {
        if ($row2["Item_type"] == $row3["Item_type"]){
            $sql4 = "UPDATE inventory SET Equipped = NULL where Item_ID = '" . $row2["Item_ID"] . "'";
            mysqli_query($conn, $sql4);
        }
        $sql5 = "UPDATE inventory SET Equipped = 'E' where Item_ID = '" . $itid . "'";
        mysqli_query($conn, $sql5);
    }
}
echo("Item equipped successfully!");
echo("<br />");
mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_free_result($result3);
echo('<a href="inventory.php?cname=' . $cname . '"> Back </a>');    
?>