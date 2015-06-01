<?php
/*function createUser ($db, $name, $email, $password, $isactive) {
	$query = $db->prepare("INSERT INTO user (name, email, password, data_create, is_active)
							VALUES (:name, :email, :password, now(), :isactive)");
	
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->bindParam(':isactive', $isactive, PDO::PARAM_INT);

	$query->execute();
/*	$query->execute(array(
		"name" => $name,
		"email" => $email,
		"password" => $password,
		"isactive" => $isactive));
		*/
//}
function createWish($db, $id_user, $wish){
//	$config = parse_ini_file('/var/www/dev.school-server/www/config/db.ini');
	//$db = new PDO ("mysql:host={$config['host']}; dbname={$config['db_name']}", $config['user'], $config['password']);
//$db = new PDO ("mysql:host=localhost; dbname='db', 'root', 'password');
	$res = array();

	$query2 = $db->prepare("SELECT wish_text FROM wish WHERE wish_text = :wish AND id_user = :id_user");
	$query2->bindParam(':wish', $wish, PDO::PARAM_STR);
	$query2->bindParam(':id_user', $id_user, PDO::PARAM_STR);

	$query2->execute();
	while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
			$res[] = $row;
	}
	//var_dump($res);
	if (empty($res)) {
		$query = $db->prepare//("IF NOT EXISTS (SELECT wish_text FROM wish WHERE wish_text = :wish) 
			("INSERT INTO wish (id_user, wish_text)
			 VALUES (:id_user, :wish)");
		$query->bindParam(':id_user', $id_user, PDO::PARAM_STR);
		$query->bindParam(':wish', $wish, PDO::PARAM_STR);

		$query->execute();

		return true;
	}
	else {
		echo "You have already printed this wish.<br><br>";
		return false;
	}
}