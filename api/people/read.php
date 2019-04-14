<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  include_once '../../config/Database.php';
  include_once '../../models/People.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate student object
  $people = new People($db);


  // people read query
  $result = $people->read();
  // Get row count
  $num = $result->rowCount();

  //Check if any people
  if($num > 0) {
    // peo array
    $peo_arr = array();
    $peo_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $peo_item = array(
        'id' => $id,
        'name' => $name
      );

      // Push to "data"
      array_push($peo_arr['data'], $peo_item);
    }

    // Turn to JSON & output
    echo json_encode($peo_arr);


  } else {
    // No people
    echo json_encode(
      array('message' => 'No people Found')  


    );

  }