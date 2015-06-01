<?php
function editUser($db, $name) {

	$query = $db->prepare("UPDATE user SET visits = visits + 1 WHERE name = :name");
	$query->bindParam(':name', $name, PDO::PARAM_STR);

	$query->execute();

}
