<?php
        session_start();
//	if (filesize('users.txt') < 1) $names = array();
//	else $names = unserialize(file_get_contents('users.txt'));
//	$_SESSION['users'] = $names;
	function checkUser ($users, $name, $pass) {
		$index=-1;
		for ($i = 0; $i < count($users); $i++) {
			if ($users[$i]["name"] == $name) {
				$index = $i;
				break;
			}
		}
		if ($index != -1 && $users[$index]["password"] == $pass) {
			editUser(getConnect(), $name);
			return true;
		}
		else {
			return false;
		}
	}
?>
<html>
<head>
        <title>First PHP page</title>
</head>
<body>

<form>
Name: <input type="text" name="name"><br>
Password: <input type="password" name="password"><br>
<input type="submit" name="submit" value="Submit me!" /><br>
<a href="registration.php">Register me!</a>
</form>
<?php
include('library/db.php');
include('library/userList.php');
include('library/editUser.php');

$users = array();
$users = getUserList(getConnect());

if (isset($_GET["name"]) && isset($_GET["password"]) && checkUser($users, $_GET["name"], $_GET["password"])) {
	$_SESSION['userName'] = $_GET["name"];
	header("Location: /loggedin.php");
}
else {
}
/*
        if (isset($_GET["name"]) && isset($_GET["password"]) && checkUser($_GET["name"], $_GET["password"])){
      		$_SESSION['isloggedin']=true;
			$_SESSION['userName'] = $_GET["name"];
			header("Location: /admin.php");
			
 	        }
	    else { 
		//	header("Location: /wrongauth.php");
		}
*/


 ?>
</body>
</html>
