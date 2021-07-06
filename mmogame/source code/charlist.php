<?php
$uid = htmlspecialchars($_GET["uid"]);

$servername = "localhost";
$username = "Testplayer";
$password = "12345";
$db = "mmogame";

//Create connection
$conn = mysqli_connect($servername, $username, $password) or die("Connection failed");
mysqli_select_db($conn, $db) or die("Could not select database");

$sql = "SELECT * from character_info where User_ID = '" . $uid . "'";
$result = mysqli_query($conn, $sql);

echo "<table border='1'>
<tr>
	<th>Level</th>
	<th>Character name</th>
</tr>";
while(($row = mysqli_fetch_array($result))!= null){
	echo "<tr>"; 
	echo "<td>" . $row["Level"] . "</td>";
	echo('<td><a href="checkchar.php?cname=' . $row['Char_Name'] . '&uid=' . $uid . '">' . $row['Char_Name'] . "</a></td>");
	echo "</tr>";
}
echo "</table>";

echo("<br />");
echo("<a href='createcha.php?uid=" . $uid . "'> Create a new character</a>");
echo("<br />");
echo("<a href='index.html'> Back to login</a>");
?>

