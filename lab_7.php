<html>
<body>
<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
$student=strtolower($_GET["student"]);
$f=fopen("students/$student.txt", "r");
$student=ucfirst($student);
if(!$f) {
	echo "no scores found.";
} else{
	echo "<h1>Grades for $student";
	$contents = fgets($f);
	$grades = explode(" ", $contents);
	echo "<ul>";
	$total = 0;
	foreach($grades as $value){
		echo "<li>$value</li>";
		$total += $value;
	}
	echo "<li>TOTAL: $total</li>";
	echo "</ul>";
}

?>