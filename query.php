<?php

// $host = "ec2-52-7-39-178.compute-1.amazonaws.com";
// $user = "jybhgsdkfwysky";
// $password = "eec042e14e6ca3afe7e68edf5de170ee293b790230a29dd719feb2e2d3fa6f9c";
// $dbname = "d9pugpe7g2t1e6";
// $port = "5432";

$db_connect = pg_connect("postgres://ydshrbbwrnvyrd:c96b22a2f1b5ddfc521871921486eafeb0170eef63a5cce698c49b79d02697cb@ec2-35-174-127-63.compute-1.amazonaws.com:5432/dql5qdqd4414m");


  if(!empty($_POST['search'])){
    $db_connect = pg_connect(getenv($dsn));
    if (!$db_connect){
        echo "UNABLE TO CONNECT TO DATABASE.\n";
        exit;
      }
    $q = '%'.pg_escape_string($db_connect, $_POST['q']).'%';
    $sql = pg_query($db_connect,"SELECT title, artists, id FROM cleaned_songs WHERE title ILIKE '$q' or artists ILIKE '$q' ORDER BY popularity DESC LIMIT 15");

    $response = "<ul><li>No data found</li></ul>";
    if(pg_num_rows($sql) > 0){
      $response = "<ul>";
      while($data = pg_fetch_array($sql))
        $response .="<li>" .$data['title']." By: ".$data['artists']. "</li>";
      $response .="</ul>";
    }
    exit($response);
  }
?>
