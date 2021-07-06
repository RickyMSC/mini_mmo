<hl>Create character</hl>
<?php
$uid = htmlspecialchars($_GET["uid"]);
?>

<form method ="GET" action="createchar.php">
<b>Please input your character name</b>
<input type="text" placeholder="Character name" name="cname" required>
<br />
<input type="hidden" value=<?php echo "$uid";?> name="uid">
<br />
<button type="submit">Submit</button>

</form>

<a href="charlist.php?<?php echo "uid=" . $uid; ?>"> Cancel </a>