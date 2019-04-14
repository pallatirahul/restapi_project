<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');


  include_once '../../config/Database.php';
  include_once '../../models/People.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate people object
  $people = new People($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // set ID to update
  $people->id = $data->id;
  $people->name = $data->name;

  // update people
  if ($people->update()) {
    echo json_encode(
      array('message' => 'people Updated')

    );
  } else {
    echo json_encode(
      array('message' => 'people Not Updated')
    );
  }