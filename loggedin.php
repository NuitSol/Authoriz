<?php
session_start();
function getPost ($param, $default = false) {
    	return isset ($_POST[$param]) ? $_POST[$param] : $default;
    }
?>
</html>
<head>
<title>Success</title>
</head>
<body>
<?php
include('library/db.php');
include('library/getUser.php');
include('library/createWish.php');
include('library/getWish.php');

$user = array();
$user = getUser(getConnect(), $_SESSION['userName']);
if (empty($user)) header("Location: /index.php");
echo "Hello, {$_SESSION['userName']}! This is your {$user[0]["visits"]} visit.";

//getUser();

?>
<form method="POST">
<a href="index.php?action=logout">Exit</a><br>
<br>
You can look at our <a href="events.php">events.</a><br>
<br>
Make a wish:
<input type="text" name="want">
<input type="submit" name="add" value="ADD" /><br>
</form> 
<?php

//if (isset($_GET["want"])) createWish(getConnect(), $user[0]["id"], $_GET["want"]);
//createWish(getConnect(), $user[0]["id"], "Car");
if (getPost("want")) createWish(getConnect(), $user[0]["id"], $_POST["want"]);
$wishes = array();
$wishes = getWishList(getConnect(), $user[0]["id"]);
for ($i = 1; $i <= count($wishes); $i++) {
	$tmp = $wishes[$i-1]["wish_text"];
	echo "$i. $tmp<br>";
}

//if (!isset($_GET["want"])) $_GET["want"] = "";
//addWant($_GET["want"]);
//getWishes();

?>

</body>
</html>

