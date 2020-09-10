<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../models/word.php';

// instantiate database and word object
$database = new Database();
$db = $database->getConnection();

// initialize object
$word = new Word($db);
// query words
$stmt = $word->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // words array
    $words_arr=array();
    $words_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $word_item=array(
            "id" => $id,
            "concept" => $concept,
            "meaning" => $meaning,
        );

        array_push($words_arr["records"], $word_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show words data in json format
    echo json_encode($words_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}