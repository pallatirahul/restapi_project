<?php
  class People {
    // DB stuff
    private $conn;
    private $table = 'people';
    //properties
    public $id;
    public $name;
    public $created_at;
    //constructor with DB
    public function __construct($db) {
      $this->conn = $db;

    }
    // Get people
    public function read() {
      //create query
      $query = 'SELECT
        id,
        name,
        created_at
      FROM
        ' . $this->table  . '
      ORDER BY
        created_at DESC';
      // PREPARE STATEMENT
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();

      return $stmt;  
    }

    //  get single people
    public function read_single() {
      // create query
      $query = 'SELECT
            id,
            name
          FROM
            ' . $this->table . '
        WHERE id = ?
        LIMIT 0,1';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // bind id
        $stmt->bindParam(1, $this->id);
        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set properties
        $this->id = $row['id'];
        $this->name = $row['name'];

    }
    // create people
    public function create() {
      // create query
      $query = 'INSERT INTO ' .
        $this->table . '
      SET 
        name = :name';
    // prepare statement
    $stmt = $this->conn->prepare($query);
    // clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    // bind data
    $stmt-> bindParam(':name', $this->name);
    // execute query
    if ($stmt->execute()) {
      return true;
           
         }
    // print error if something goes wrong
    printf("Error: $s\n", $stmt->error);
    return false;          
    }
    //update people
    public function update() {
      // create query
      $query = 'UPDATE ' .
        $this->table . '
      SET
        name = :name
        WHERE
        id = :id';
    //prepare statement
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->id = htmlspecialchars(strip_tags($this->id));
    // bind data
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);
    //execute query
    if ($stmt->execute()) {
      return true;
            # code...
          }
          //print error if something goes wrong
          printf("Error: $s.\n", $stmt->error);
          return false;      
    }

    // delete people
    public function delete() {
      // create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = id';
      // prepare statement
      $stmt = $this->conn->prepare($query);
      //clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      // bind data
      $stmt->bindParam(':id', $this->id);
      // execute query
      if ($stmt->execute()) {
        return true;
        # code...
      }
      // print if something goes wrong
      printf('Error: $s.\n', $stmt->error);
      return false;


    }
  }