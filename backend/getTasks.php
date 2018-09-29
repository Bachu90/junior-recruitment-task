<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite');

 $result = $db->query('SELECT * FROM Tasks');
 
foreach($result as $row){
  if(!$row['isComplete']){
    echo('<li class="todo-item" id="'.$row['id'].'"><input type="checkbox"><p>'.$row['Task'].'</p><i class="far fa-trash-alt"></i></li>');
  }else {
    echo('<li class="todo-item" id="'.$row['id'].'"><input type="checkbox" checked><p>'.$row['Task'].'</p><i class="far fa-trash-alt"></i></li>');
  }
  
}

 // close the database connection
 $db = NULL;
}
catch(PDOException $e)
{
 print 'Exception : '.$e->getMessage();
}
  
// checked="'.$row['isComplete'].'"
    
?>