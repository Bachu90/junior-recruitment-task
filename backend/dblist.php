<?php
  try
  {
    //open the database
    $db = new PDO('sqlite:todoDb_PDO.sqlite');

    //now output the data to a simple html table...
    echo("<table border=1>");
    print("<tr><td>id</td><td>Task</td><td>isComplete</td></tr>");
    $result = $db->query('SELECT * FROM Tasks');
    foreach($result as $row)
    {
      echo("<tr><td>".$row['id']."</td>");
      echo("<td>".$row['Task']."</td>");
      echo("<td>".$row['isComplete']."</td>");
    }
    echo("</table>");

    // close the database connection
    $db = NULL;
  }
  catch(PDOException $e)
  {
    echo('Exception : '.$e->getMessage());
  }
?>
