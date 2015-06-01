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