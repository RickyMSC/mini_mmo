<?php
$cname = htmlspecialchars($_GET["cname"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

// Display the content of inventory
$sql = "SELECT * FROM inventory where Char_Name = '" . $cname . "'";
$result = mysqli_query($conn, $sql);

echo "<h2>Inventory</h2> 
<table border= '1'>
<tr>
    <th>Item name</th>
    <th>Item stat</th>
    <th>Item descirption</th>
    <th>Equipped</th>
    <th></th>
</tr>";
while (($row = mysqli_fetch_array($result))!= null) {
    $sql2 = "SELECT * FROM item where Item_ID = '"  . $row["Item_ID"] . "' order by Item_ID";
    $result2 = mysqli_query($conn, $sql2);
    
    while (($row2 = mysqli_fetch_array($result2))!= null) {
        echo "<tr>";
        echo "<td>". $row2["Item_name"]. "</td>
        <td>" . $row2["Item_stats"] . "</td>
        <td>" . $row2["Item_description"] . "</td>
        <td>" . $row["Equipped"] . "</td>";
        echo('<td><a href="equip.php?cname=' . $cname . '&Item_ID=' . $row2["Item_ID"] . '">  Equip </a></td>');
        echo "</tr>";
	}
	mysqli_free_result($result2);
}    
echo "</table>";
    mysqli_free_result($result);
echo("<br />");    
echo('<a href="main.php?cname=' . $cname . '"> Back </a>');    
?>