
<!-- SKRYPT USUWANIA ZADAŃ Z BAZY -->

<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite'); //otwieranie połączenia z bazą

 $TaskId = $_REQUEST["TaskId"]; //pobranie parametru TaskId z id zadania do usunięcia metodą GET

 $db->exec("DELETE FROM Tasks WHERE id= '$TaskId'"); //usunięcie rekordu zadania o id 'TaskId' z tabeli

 // zamykanie połączenia z bazą
 $db = NULL;
}
catch(PDOException $e)
{
    echo('Exception : '.$e->getMessage()); //wyświetlenie błędu w przypadku niepowodzenia
}
    
?>