<?php

  if(!empty($_POST['search'])){

    $db_connect = pg_connect("host=localhost dbname=SpotifyData user=postgres password=giao");
    if (!$db_connect){
        echo "UNABLE TO CONNECT TO DATABASE.\n";
        exit;
      }

    $q = '%'.pg_escape_string($db_connect, $_POST['q']).'%';
    $sql = pg_query($db_connect,"SELECT title FROM cleaned_songs WHERE title ILIKE '$q' ORDER BY popularity DESC LIMIT 10");

    $response = "<ul><li>No data found</li></ul>";
    if(pg_num_rows($sql) > 0){
      $response = "<ul>";

      while($data = pg_fetch_array($sql))
        $response .="<li>" .$data['title']."</li>";

      $response .="</ul>";
    }
    exit($response);
  }

?>
