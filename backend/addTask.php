
<!-- SKRYPT DODAWANIA NOWEGO ZADANIA -->

<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite'); //otwieranie połączenia z bazą

 $Task = $_REQUEST["Task"]; //pobierania parametru "Task" z treścią zadania metodą GET

//walidacja pustego parametru 'Task' i dodanie nowego rekordu do bazy z zawartością 'Task' jako treścią i statusem 'do wykonania' (isComplete=0)
if($Task){
    $db->exec("INSERT INTO Tasks (Task, isComplete) VALUES ('".$Task."', 0);");
}

 // zamykanie połączenia z bazą
 $db = NULL;
}
catch(PDOException $e)
{
    echo('Exception : '.$e->getMessage()); //wyświetlenie błędu w przypadku niepowodzenia
}
    
?>