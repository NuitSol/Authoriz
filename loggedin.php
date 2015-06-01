<?php
session_start();
$usrs;
$index;
$wantings;
function getUser2() {
	global $usrs;
	$usrs = unserialize(file_get_contents('users.txt'));
	$name = $_SESSION["userName"];
	global $index;
	$index=-1;
                for ($i = 0; $i < count($usrs); $i++) {
                        if ($usrs[$i][0] == $name) {
                                $index = $i;
                                break;
                        }
                }
	$visit = $usrs[$index][2];
	echo "Hello, $name! This is your $visit st visit.<br>"; 
}
function addWant($wanting) {
	global $wantings;
	$wantings = array();
	global $usrs;
	global $index;
	$already_wants = array();
//for the first time
	if (filesize('wantings.txt') < 1) {
		for ($i = 0; $i < count($usrs); $i++) {
			array_push($wantings, array(NULL));
		}
		file_put_contents('wantings.txt', serialize($wantings));
	}
	$wantings = unserialize(file_get_contents('wantings.txt'));
	if (empty($wanting)) return;
	for($i = 0; $i < count($wantings[$index]); $i++) {
		if ($wantings[$index][$i] == $wanting) return;
	}
	if ($wantings[$index][0] == NULL) $wantings[$index][0] = $wanting;
	else {
//		array_push($already_wants, $wanting);
//		$already_wants = $wantings[$index];
//		$wantings[$index] = $already_wants;
		array_push($wantings[$index], $wanting);
	}
	$_GET["name"] = NULL;
//var_dump($wantings);
	file_put_contents('wantings.txt', serialize($wantings));
}

function getWishes() {
	global $wantings;
	global $index;
	if ($wantings[$index][0] == NULL) return;
	for($i = 1; $i <= count($wantings[$index]); $i++) {
		$tmp = $wantings[$index][$i-1];
		echo $i . ". $tmp<br>";
	}
	echo "<br>";
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
echo "Hello, {$_SESSION['userName']}! This is your {$user[0]["visits"]} visit.";

//getUser();

?>
<form>
<a href="index.php">Exit</a><br>
<br>
Make a wish:
<input type="text" name="want">
<input type="submit" name="add" value="ADD" /><br>
</form> 
<?php

//if (isset($_GET["want"])) createWish(getConnect(), $user[0]["id"], $_GET["want"]);
//createWish(getConnect(), $user[0]["id"], "Car");
if (isset($_GET["want"]) && $_GET["want"] != "") createWish(getConnect(), $user[0]["id"], $_GET["want"]);
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

