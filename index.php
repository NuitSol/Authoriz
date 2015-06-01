<?php
    session_start();

    function getGet ($param, $default = false) {
    	return isset ($_GET[$param]) ? $_GET[$param] : $default;
    }

    function getPost ($param, $default = false) {
    	return isset ($_POST[$param]) ? $_POST[$param] : $default;
    }
?>
<html>
<head>
        <title>First PHP page</title>
</head>
<body>

<?php
	if (getGet('action') && $_GET['action'] === 'logout') {
		session_destroy();
		header("Location: /index.php");
	}
?>

<form method="POST">
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

//echo crypt('9', 'CRYPT_SHA256');

if (getPost ("name") && getPost("password") && checkUser(getConnect(), $_POST["name"], $_POST["password"])) {
	$_SESSION['userName'] = $_POST["name"];
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
