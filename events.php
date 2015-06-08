<html>
<head>
        <title>Events</title>
</head>

Select a Level of Education:<br />
<select name="education1">
<option value="Jr.High">Jr.High</option>
<option value="HighSchool">HighSchool</option>
<option value="College">College</option></select>:<br />
<?php
include('library/db.php');
include('library/eventList.php');

$res = array();
$res = getEventList(GetConnect());
?>
<select name="education">
<?php
$res2 = array();
for ($i = 0; $i < count($res); $i++) {
$vas = $res[$i]["name"];
echo "<option value=\"$i\">
        $vas
    </option>";
} ?>
</select>:<br />
<?php
var_dump($res);
echo $i;

?>
</html>