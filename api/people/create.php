<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');
  include_once '../../config/Database.php' ;
  include_once '../../models/People.php' ;
  // Instantiate db & connect
  $database = new Database();
  $db = $database->connect();
  //Instantiate blog post object
  $people = new People($db);
  // get raw posted data
  $data = json_decode(file_get_contents('php://input'));
  $people->name = $data->name;
  // create people
  if ($people->create()) {
    echo json_encode(
      array('message' => 'people created')
    );
  } else {
    echo json_encode(
      array('message' => 'people not created')
    );
  }