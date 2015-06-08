<?php
    session_start();
    
 //  $redis->set("counter", 0);
  // $redis->setTimeout('counter', 40);
   
  //var_dump($redis);
    	

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


//$users = array();
$users = getUserList(getConnect());
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
//var_dump($users);
//echo $_POST["name"];
//echo crypt('9', 'CRYPT_SHA256');
//$istime = $redis->get('counter');

if (getPost ("name")) {
	if($redis->get("banned_{$_POST["name"]}")) echo "You are banned for 10 sec.<br>";
	
	else {
		$user_bankey = "user_pass_attempts_" . $_POST["name"];
		if (!$redis->get("banned_{$_POST["name"]}") && getPost("password") && checkUser(getConnect(), $_POST["name"], $_POST["password"])) {
			$_SESSION['userName'] = $_POST["name"];
			header("Location: /loggedin.php");
		} 
		else {
			echo "Wrong login or password.";
			$value = $redis->incr($user_bankey);
			if ($value == 1) $redis->setTimeout($user_bankey, 10);
			if ($value > 3) {
				$redis->set("baned",$_POST["name"]);
				$redis->set("banned_{$_POST["name"]}",'true');
				$redis->setTimeout("banned_{$_POST["name"]}", 10);
			}
/*			echo "<br>";
			echo $value;
			echo "<br>";
			echo $user_bankey;*/
		}
	}	
}
else {
	if (!$redis->get("anonymous")) {
		$value = $redis->incr("user_pass_attempts_anonymous");
		if ($value == 1) $redis->setTimeout("user_pass_attempts_anonymous", 10);
		if ($value > 3) {
			$redis->set("baned", "anonymous");
			$redis->set("anonymous",'true');
			$redis->setTimeout("anonymous", 10);
		}
//		$redis->set("user_pass_attempts_anonymous", 0);
//		echo $value;
	}
	else echo "You are banned for 10 sec.";
}

 ?>
</body>
</html>