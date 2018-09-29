<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite');

 $TaskId = $_REQUEST["TaskId"];
 $isComplete = $_REQUEST["isComplete"];

 if($isComplete){
     $db->exec("UPDATE Tasks SET isComplete=1 WHERE id= '$TaskId'");
 }else {
    $db->exec("UPDATE Tasks SET isComplete=0 WHERE id= '$TaskId'");
 }

 // close the database connection
 $db = NULL;
}
catch(PDOException $e)
{
 print 'Exception : '.$e->getMessage();
}
  
    
?>