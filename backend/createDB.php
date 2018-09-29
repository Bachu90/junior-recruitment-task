<!-- TWORZENIE NOWEJ BAZY I TABELI 'Tasks' -->

<?php
    try {
    //otwieranie bazy danych (tworzenie i otwieranie jeżeli nie istnieje)
    $db = new PDO('sqlite:todoDB_PDO.sqlite');

    //tworzenie tabeli Task w bazie
    $db->exec("CREATE TABLE Tasks (id INTEGER PRIMARY KEY, Task TEXT, isComplete INTEGER)");   

    // zamykanie połączenia z bazą
    $db = NULL;
  }
  catch(PDOException $e)
  {
    echo('Exception : '.$e->getMessage()); //wyświetlenie błędu w przypadku niepowodzenia
  }
?>