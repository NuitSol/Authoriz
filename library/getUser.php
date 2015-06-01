<?php
function getUser($db, $name) {
	$res = array();
	$query = $db->prepare("SELECT id, password, visits FROM user WHERE name = :name");
	$query->bindParam(':name', $name, PDO::PARAM_STR);

	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$res[] = $row;
	}

	return $res;	
}
