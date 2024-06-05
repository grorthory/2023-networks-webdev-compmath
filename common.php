<?php
function heading() {
    ?>
<!DOCTYPE html>
<html>
    <head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		<link href="https://webdev.watzek.cloud/~askiles/images/favicon.png" type="image/png" rel="shortcut icon" />
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>
    
    <body>
		<div id="frame">
			<div id="banner">
				<a href="mymdb.php"><img src="https://webdev.watzek.cloud/~askiles/images/mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>

<?php
}
?>

<?php
function table($rows){
?>
<table>
	<tr>
		<th>#</th>
		<th>Title</th>
		<th>Year</th>
	</tr>

<?php
for ($i = 0; $i<count($rows); $i+=1){
	?>
	<tr>
	<td><?=$i+1?></td>
	<td><?=$rows[$i]["name"]?></td>
	<td><?=$rows[$i]["year"]?></td>
</tr>
	<?php
}
?>

</table>

<?php
}
?>

<?php
function search(){
	?>
	<!-- form to search for every movie by a given actor -->
	<form action="search-all.php" method="get">
					<fieldset>
						<legend>All movies</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>

				<!-- form to search for movies where a given actor was with Kevin Bacon -->
				<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>
				<?php
}

function getActorIDByName($db, $firstName, $lastName){
	
	try {
	$stmt = $db->prepare("SELECT id FROM actors WHERE first_name LIKE '$firstName%' and last_name=:lastName");
	
	$stmt->execute(array(":lastName"=>$lastName));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	var_dump($rows);
	$id = $rows[0]["id"];
	return $id;
	
	} catch (Exception $e) {
	return false;
	}
	
}

function getAllByID($db, $id){
	try{
	$stmt = $db->prepare("SELECT name, year FROM movies
	JOIN roles ON movies.id = roles.movie_id
	JOIN actors ON roles.actor_id = actors.id
	WHERE actor_id=$id");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	var_dump($rows);
	return $rows;

	}catch (Exception $e) {
	return false;
	}
}

function getBaconByID($db, $id){
	try{
	$stmt = $db->prepare("SELECT DISTINCT m.name, m.year
	FROM 
	");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	var_dump($rows);
	return $rows;

	/*Bart & lisa's grades slide on slides:
	4 joins
		*/
	}catch (Exception $e) {
	return false;
	}
}

function footing(){
    ?>
    <div id="w3c">
    <a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
    <a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
</div>
</div> <!-- end of #frame div -->
</body>
</html>
<?php
}
?>