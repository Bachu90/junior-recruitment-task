
<!-- SKRYPT DO WYŚWIETLENIA ZAWARTOŚCI BAZY DANYCH -->
<!-- otwierany z adresu 'domena/to-do-list/backend/dblist.php' -->
<?php
  try
  {
    //otwieranie połączenia z bazą
    $db = new PDO('sqlite:todoDb_PDO.sqlite');

    //wyświetlenie rekordów bazy w tabeli
    echo("<table border=1>");
    echo("<tr><td>id</td><td>Task</td><td>isComplete</td></tr>");
    $result = $db->query('SELECT * FROM Tasks');
    foreach($result as $row)
    {
      echo("<tr><td>".$row['id']."</td>");
      echo("<td>".$row['Task']."</td>");
      echo("<td>".$row['isComplete']."</td>");
    }
    echo("</table>");

    // zamykanie połączenia z bazą
    $db = NULL;
  }
  catch(PDOException $e)
  {
    echo('Exception : '.$e->getMessage()); //wyświetlenie błędu w przypadku niepowodzenia
  }
?>
