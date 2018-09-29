<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite');

 $TaskId = $_REQUEST["TaskId"];

 $db->exec("DELETE FROM Tasks WHERE id= '$TaskId'");

 // close the database connection
 $db = NULL;
}
catch(PDOException $e)
{
 print 'Exception : '.$e->getMessage();
}
  
    
?>