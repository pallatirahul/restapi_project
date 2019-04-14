<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  include_once '../../config/Database.php';
  include_once '../../models/People.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate people object
  $people = new People($db);

  // Get ID
  $people->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get people
  $people->read_single();

  // create array
  $peo_arr = array(
    'id' => $people->id,
    'name' => $people->name,
  );

  // Make Json
  print_r(json_encode($peo_arr));