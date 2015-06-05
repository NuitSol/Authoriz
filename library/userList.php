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

	$query2 = $db->prepare("SELECT password FROM user WHERE name = :name");
	$query2->bindParam(':name', $name, PDO::PARAM_STR);

	$query2->execute();
	while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
			$res[] = $row;
	}


	if (!empty($res) && $res[0]['password'] == crypt($pass, 'CRYPT_SHA256')) {
		editUser(getConnect(), $name);
			return 1;
	}
	
	return 0;
}			