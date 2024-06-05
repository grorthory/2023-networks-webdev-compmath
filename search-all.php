<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
include 'common.php';
/*** connection credentials *******/
$servername = "www.watzekdi.net";
$username = "watzekdi_cs393";
$password = "KevinBac0n";
$database = "watzekdi_imdb_small";
$dbport = 3306;

$first_name=$_GET["firstname"];
$last_name=$_GET["lastname"];

/****** connect to database **************/

try {
$db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8;port=$dbport", $username, $password);
}
catch(PDOException $e) {
echo $e->getMessage();
}

$id=getActorIDByName($db, $first_name, $last_name);
echo $id;
echo "<br>";

$movies = getMoviesByID($db, $id);
?>

<?php
heading();
?>

<!--
Recieving first name last name from form
Send these to function in common.php that does database query with sql
Returns output, sends output to table function in common that loops through rows and outputs table.
 -->

<div id="main">

<?php


table($movies);
?>

<?php
search();
?>

<?php
footing();
?>