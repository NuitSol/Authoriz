<?php
function getVisits($db, $name) {
	$res = array();
	$query = $db->prepare("SELECT visits FROM user WHERE name = :name");
	$query->bindParam(':name', $name, PDO::PARAM_STR);

	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$res[] = $row;
	}

	return $res[0]["visits"];	
}
