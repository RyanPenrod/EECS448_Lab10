<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $name=$_POST["user"];
  $exists = "no";

  if($name == ''){
    echo "Provided username was empty, please return and provide a User ID.";
  }
  else{
    $mysqli = new mysqli("mysql.eecs.ku.edu", "r784p843", "ooHe7pha", "r784p843");

    if ($mysqli->connect_errno){
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();}

    $query = "SELECT * FROM Users";
    if($result = $mysqli->query($query)){
      while($row = $result->fetch_assoc()){
        if($name == $row["user_id"]){
          $exists = "yes";
          echo "This User ID already exists, please return and provide a new User ID.";
        }
        else{
          $adding = "INSERT INTO Users(user_id) VALUES ('$name')";
          $mysqli->query($adding);
        }
      }
      if($exists == "no"){
        echo $name . " was successfully stored in the database.";
      }
    }

    $result->free();

    $mysqli->close();
  }
?>
