
<!-- SKRYPT POBIERANIA AKTUALNYCH ZADAŃ Z BAZY -->

<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite'); //otwieranie połączenia z bazą

 $result = $db->query('SELECT * FROM Tasks'); //pobieranie wszystkich rekordów z bazy
 
foreach($result as $row){ //iteracja po rekordach i tworzenie elementów li listy
  if(!$row['isComplete']){
    echo('<li class="todo-item" id="'.$row['id'].'"><input type="checkbox"><p>'.$row['Task'].'</p><i class="far fa-trash-alt"></i></li>');
  }else {
    echo('<li class="todo-item" id="'.$row['id'].'"><input type="checkbox" checked><p>'.$row['Task'].'</p><i class="far fa-trash-alt"></i></li>');
  }
  
}

 // zamykanie połączenia z bazą
 $db = NULL;
}
catch(PDOException $e)
{
  echo('Exception : '.$e->getMessage()); //wyświetlenie błędu w przypadku niepowodzenia
}
    
?>