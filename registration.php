<?php
session_start();

function getPost ($param, $default = false) {
    	return isset ($_POST[$param]) ? $_POST[$param] : $default;
    }

function addUser($name, $pass) {
	if (filesize('users.txt') < 1) $usrs = array();
	else $usrs = unserialize(file_get_contents('users.txt'));
	if ($name != NULL && $pass != NULL){
		$index=-1;
                for ($i = 0; $i < count($usrs); $i++) {
                        if ($usrs[$i][0] == $name) {
                                $index = $i;
                                break;
                        }
                }
                if ($index != -1) {
			echo "User with this name exists.";
			return false;
		}
		array_push($usrs, array($name, $pass, 0));
		file_put_contents('users.txt', serialize($usrs));
		return true;
	}
	else return false;
}

?>
</html>
<head>
<title>Registration</title>
</head>
<body>
<form method="POST">
Name: <input type="text" name="name"><br>
Password: <input type="text" name="password"><br>
<input type="submit" name="submit" value="OK" /><br>
</form>
<?php

//if (isset($_GET["name"]) && addUser($_GET["name"], $_GET["password"]))
//	echo "You are registered!  ";

include('library/db.php');
include('library/createUser.php');


if (getPost ("name") && getPost("password") && createUser(getConnect(), $_POST["name"], $_POST["password"])) 
	echo "You are registered!  ";
 
?>
<a href="index.php">Back</a>


</body>
</html>

