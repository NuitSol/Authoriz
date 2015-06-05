<?php 



function head($title) {
	echo "<!doctype html>
		<html lang='en' class='no-js'>
		<head>
  		<meta charset='UTF-8' />
  		<title>$title</title>
  		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  		<link rel='stylesheet' href='css/style.css' />
  		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  		<!-- remember, jQuery is completely optional -->
  		<!-- <script type='text/javascript' src='js/jquery-1.11.1.min.js'></script> -->
  		<script type='text/javascript' src='js/jquery.particleground.js'></script>
  		<script type='text/javascript' src='js/demo.js'></script>
  		<link media='screen' href='demo/styles/demo.css' type='text/css' rel='stylesheet' />
		</head>";
}
function logged($login,$password){
	$max_id=lastid();
	$id=1;
	while ($id <=$max_id) {
		$c=trim(search($id,'login'));
		
		if ($login == $c) {
			$k=trim(search($id,'pass'));
			
			if ($password == $k) {
					
				
				return(true);
				break;
			}
		}	
		
		$id++;
		
	}

	
}


function log_attempt($login) {
			$redis = new Redis();
			$redis->connect('127.0.0.1', 6379);
			$redis->incr("log_att_$login");
			$redis->expire("log_att_$login",10);
			if ($redis->get("log_att_$login")>3) {
				$redis->set("baned","$login");
				$redis->set("banned_$login",'true');
				$redis->expire("banned_$login",10);
			}
}			
function pluscount ($id) {
	$line=$id*4-2;
	$replace=trim(search($id,'count'));
	$replace++;
	

	$filename = 'info.txt';
	$file = file($filename);
	$file[$line] = $replace.PHP_EOL;
	file_put_contents($filename, join('', $file));
}


?>