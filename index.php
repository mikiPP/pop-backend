<?php

// include database and object files
require_once 'config/database.php';
require_once 'objects\Diary.php';
define("JSON_ROUTE", "data/diary.json");

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to objects
$diary = new Diary($db);

$json = file_get_contents(JSON_ROUTE);
$json = json_decode($json, true);

foreach ($json as $day) {
     
       $diary->decription = $day["eventos"]; 
       $diary->pulpo = $day["pulpo"];
       $diary->insert();  
     
}



// read the diary from the database
$stmt = $diary->read();
while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row_category);
    echo "{$description}";
    echo"<br>";
    echo ($pulpo) ? "true" : "false";
    echo"<hr>";
}



?>
