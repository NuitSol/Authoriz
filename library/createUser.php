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

$query = $db->prepare("INSERT INTO user (name, password)
	 VALUES (:name, :password)");
$query->bindParam(':name', $name, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);

$query->execute();

return true;
}