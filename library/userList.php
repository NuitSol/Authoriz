<?php
function getUserList($db) {
	$res = array();
	$query = $db->prepare("SELECT * FROM user");
//	$query->bindParam(':status', $status, PDO::PARAM_INT);

	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$res[] = $row;
	}

	return $res;	
}

function checkUser ($db, $name, $pass) {
	$res = array();
	//$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
	//var_dump($hash_pass);

	$query2 = $db->prepare("SELECT password FROM user WHERE name = :name");
	$query2->bindParam(':name', $name, PDO::PARAM_STR);

	$query2->execute();
	while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
			$res[] = $row;
	}
//	var_dump($res[0]["password"]);
//	var_dump(crypt($pass, 'CRYPT_SHA256'));
//	var_dump($res);
	if(!empty($res) && $res[0]['password'] == crypt($pass, 'CRYPT_SHA256')) {
		editUser(getConnect(), $name);
			return true;
	}
	else {
		return false;
	}
}			