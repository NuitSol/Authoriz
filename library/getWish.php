<?php
function getWishList($db, $id_user) {
	$res = array();
	$query = $db->prepare("SELECT wish_text FROM wish WHERE id_user = :id_user");
	$query->bindParam(':id_user', $id_user, PDO::PARAM_INT);

	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$res[] = $row;
	}

	return $res;	
}
