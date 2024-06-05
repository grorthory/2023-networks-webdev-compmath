<?php
include 'common.php';
$servername = "www.watzekdi.net";
$username = "watzekdi_cs293";
$password = "KevinBac0n";
$database = "watzekdi_imdb";
$dbport = 3306;
try {
    $db = new 
    PDO("mysql:host=$servername;dbname=$database;charset=utf8;port=$dbport", $username, $password);
}
catch(PDOException $e) {
    echo $e->getMessage();
}
$firstName = $_GET["firstname"];
$lastName = $_GET["lastname"];

function searchKevin($firstName, $lastName, $db) {
    $firstName = $db->quote($firstName);
    $lastName = $db->quote($lastName);
    $rows = $db->query("SELECT m.name, m.year, a.first_name, a.last_name
                        FROM actors a
                        JOIN roles r ON r.actor_id = a.id
                        JOIN movies m ON m.id = r.movie_id
                        JOIN roles k ON k.movie_id = m.id
                        JOIN actors b ON b.id = k.actor_id
                        WHERE a.last_name = $lastName 
                        AND a.first_name = $firstName 
                        AND b.last_name = 'Bacon' 
                        AND b.first_name = 'Kevin'
                        ORDER BY m.year DESC");
    return $rows;
}

function search() {
    ?>
    <form action="search-kevin.php" method="get">
        <fieldset>
            <legend>Movies with Kevin Bacon</legend>
            <div>
                <input name="firstname" type="text" size="12" placeholder="first name"> 
                <input name="lastname" type="text" size="12" placeholder="last name"> 
                <input type="submit" value="go">
            </div>
        </fieldset>
    </form>
    <?php
}

$rows = searchKevin($firstName, $lastName, $db);
heading();
?>
<div id="main">
    <h1>Results For <?= $firstName . " " . $lastName ?></h1>
    <p>Films with <?= $firstName . " " . $lastName ?></p>
    <?php
    if (!$rows->rowcount() === 0) {
        Table($rows);
    } else {
    ?>
        <p>Actor <?= $firstName . " " . $lastName ?> not found.</p>
    <?php
    }
        search();
    ?>
    </div>
    <?php
        footing();
    ?>