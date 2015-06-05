<?php

include('/var/www/dev.school-server/www/library_Users/db.php');
include('/var/www/dev.school-server/www/library_Users/createUser.php');

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
for ($i = 0; $i < $argv[1]; $i++)
	createUser(getConnect(), random_string(10), random_string(10));
?>
