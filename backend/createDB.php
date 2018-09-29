<?php
    try {
    //open the database
    $db = new PDO('sqlite:todoDB_PDO.sqlite');

    //create the database
    $db->exec("CREATE TABLE Tasks (id INTEGER PRIMARY KEY, Task TEXT, isComplete INTEGER)");   

    // //insert some data...
    // $db->exec("INSERT INTO Tasks (Task, isComplete) VALUES ('Zadanie 1', 0);".
    //            "INSERT INTO Tasks (Task, isComplete) VALUES ('Zadanie 2', 1); " .
    //            "INSERT INTO Tasks (Task, isComplete) VALUES ('Zadanie 3', 0);");

    // close the database connection
    $db = NULL;
  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }
?>