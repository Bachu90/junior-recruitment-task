<?php
    try {
    //otwieranie bazy danych (tworzenie i otwieranie jeżeli nie istnieje)
    $db = new PDO('sqlite:todoDB_PDO.sqlite');

    //tworzenie tabeli Task w bazie
    $db->exec("CREATE TABLE Tasks (id INTEGER PRIMARY KEY, Task TEXT, isComplete INTEGER)");   

    $requestType = $_REQUEST["requestType"]; //pobieraniu typu żądanego zadania
    
    switch($requestType){

        case "create":
            $Task = $_REQUEST["Task"]; //pobierania parametru "Task" z treścią zadania metodą GET
            //walidacja pustego parametru 'Task' i dodanie nowego rekordu do bazy z zawartością 'Task' jako treścią i statusem 'do wykonania' (isComplete=0)
            if($Task){
                $db->exec("INSERT INTO Tasks (Task, isComplete) VALUES ('".$Task."', 0);");
            }
            break;
        
        case "read":
            $result = $db->query('SELECT * FROM Tasks'); //pobieranie wszystkich rekordów z bazy
    
            foreach($result as $row){ //iteracja po rekordach i tworzenie elementów li listy
            if(!$row['isComplete']){
                echo('<li class="todo-item" id="'.$row['id'].'"><input type="checkbox"><p>'.$row['Task'].'</p><i class="far fa-trash-alt"></i></li>');
            }else {
                echo('<li class="todo-item" id="'.$row['id'].'"><input type="checkbox" checked><p>'.$row['Task'].'</p><i class="far fa-trash-alt"></i></li>');
            }
            
            }
            break;

        case "update":
            $TaskId = $_REQUEST["TaskId"]; //pobranie parametru TaskId z id zadania metodą GET
            $isComplete = $_REQUEST["isComplete"]; //pobieranie aktualnego stanu zadania metodą GET
            if($isComplete){
                //jeżeli isComplete zawiera 'null', to zmieniamy stan na 1 czyli 'wykonane'
                $db->exec("UPDATE Tasks SET isComplete=1 WHERE id= '$TaskId'"); 
            }else {
            //w przeciwnym wypadku (puste) zmieniamy stan na 0 czyli "do wykonania"
            $db->exec("UPDATE Tasks SET isComplete=0 WHERE id= '$TaskId'");
            }
            break;

        case "delete":
            $TaskId = $_REQUEST["TaskId"]; //pobranie parametru TaskId z id zadania metodą GET
            $db->exec("DELETE FROM Tasks WHERE id= '$TaskId'"); //usunięcie rekordu zadania o id 'TaskId' z tabeli
            break;
        }
    
    // zamykanie połączenia z bazą
    $db = NULL;
  }
  catch(PDOException $e)
  {
    echo('Exception : '.$e->getMessage()); //wyświetlenie błędu w przypadku niepowodzenia
  }
?>