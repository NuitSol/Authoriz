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
function createUser($db, $name, $password){

	$res = array();

	$query2 = $db->prepare("SELECT * FROM user WHERE name = :name");
	$query2->bindParam(':name', $name, PDO::PARAM_STR);

	$query2->execute();
	while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
			$res[] = $row;
	}
	//var_dump($res);
	$hash_pass = crypt($password, 'CRYPT_SHA256');
	if (empty($res)) {

		$query = $db->prepare("INSERT INTO user (name, password)
			 VALUES (:name, :hash_pass)");
		$query->bindParam(':name', $name, PDO::PARAM_STR);
		$query->bindParam(':hash_pass', $hash_pass, PDO::PARAM_STR);

		$query->execute();

		return true;
	}
	else return false;
}