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
$dia = 1;
$eventoId=1;
$db->query("SET NAMES 'utf8");


// foreach ($json as $day) {

//     //$diary->pulpo = ($day["pulpo"]) ? "true" : "false";
//     //$diary->insert($dia);  
    
//     foreach ($day["eventos"] as $evento) {
       
//         $diary->evento = $evento;
//         $diary->insertDayEvent($eventoId, $dia);
//         $eventoId++;
//     }

//     $dia++;
     
// }



// read the diary from the database
$stmt = $diary->read();

$string = '[';

while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    $row_category["pulpo"] = ($row_category["pulpo"]) ? "true" : "false";
    $string .= json_encode($row_category, JSON_UNESCAPED_UNICODE) . ',';

}

$string = substr($string, 0, -1);

$string .= ']';

header('Content-Type: application/json; charset=utf-8');
echo $string;



?>
