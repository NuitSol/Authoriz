</html>
<head>
<title>Lost</title>
</head>
<body>

<?php
include('library/db.php');
include('library/createUser.php');
include('library/userList.php');
include('library/editUser.php');
include('library/getVisits.php');
include('library/createWish.php');
include('library/getWish.php');
//mysqli

/*$config = parse_ini_file('config/db.ini');
$db = mysqli_connect($config['host'], $config['user'], $config['password'], $config['db_name'])
or die("Error" . mysqli_error($db));

$result = mysqli_query($db, 'SELECT * FROM user');

while ($row = mysqli_fetch_assoc($result)) {
	var_dump($row);
}*/

//PDO
/*
	$config = parse_ini_file('/var/www/dev.school-server/www/config/db.ini');
	$db = new PDO ("mysql:host={$config['host']}; dbname={$config['db_name']}", $config['user'], $config['password']);
	$status = 1;
	$query = $db->prepare("SELECT * FROM user WHERE is_active = :status");
	$query->bindParam(':status', $status, PDO::PARAM_INT);

	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		var_dump($row);
	}
	*/
//	createUser(getConnect(), 'Vasya', 'hhwer');
//editUser(getConnect(), 'Vasya');
//createWish(getConnect(), 1, 'car');
//var_dump(getWishList(getConnect(), 1));
//var_dump(getVisits(getConnect(), 'Evg'));
//	var_dump(getUserList(getConnect()));
echo "You are here";

?>
</body>
</html>


