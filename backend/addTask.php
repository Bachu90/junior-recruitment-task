<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite');

 $Task = $_REQUEST["Task"];

if($Task){
    $db->exec("INSERT INTO Tasks (Task, isComplete) VALUES ('".$Task."', 0);");
}

 // close the database connection
 $db = NULL;
}
catch(PDOException $e)
{
 print 'Exception : '.$e->getMessage();
}
  
    
?>