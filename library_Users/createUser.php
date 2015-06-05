<?php
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

		 echo "Last modified id: ";
		 print($db->lastInsertId());
		 echo "\n";

		return true;
	}
	else return false;
}