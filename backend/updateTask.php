
<!-- SKRYPT ZMIANY STANU ZADANIA -->

<?php
  
    try {
      
 $db = new PDO('sqlite:todoDB_PDO.sqlite'); //otwieranie połączenia z bazą

 $TaskId = $_REQUEST["TaskId"]; //pobieranie identyfikatora zadania do zmiany stanu
 $isComplete = $_REQUEST["isComplete"]; //pobieranie aktualnego stanu zadania

 if($isComplete){
     //jeżeli isComplete zawiera 'null', to zmieniamy stan na 1 czyli 'wykonane'
     $db->exec("UPDATE Tasks SET isComplete=1 WHERE id= '$TaskId'"); 
 }else {
    //w przeciwnym wypadku (puste) zmieniamy stan na 0 czyli "do wykonania"
    $db->exec("UPDATE Tasks SET isComplete=0 WHERE id= '$TaskId'");
 }

 // zamykanie połączenia z bazą
 $db = NULL;
}
catch(PDOException $e)
{
    echo('Exception : '.$e->getMessage()); //wyświetlenie błędu w przypadku niepowodzenia
} 
    
?>