<?php
putenv("PATH=/usr/local/bin/:" . exec('echo $PATH'));
//update route to correct python3

//run when user clicks on song
  if(!empty($_POST['py'])){
    $songSelect = $_POST['sc'];

    $db_connect = pg_connect("host=localhost dbname=SpotifyData user=postgres password=giao");
    if (!$db_connect){
        echo "UNABLE TO CONNECT TO DATABASE.\n";
        exit;
      }
    $sid = pg_query($db_connect,"SELECT id FROM cleaned_songs WHERE title = '$songSelect'");
    if(pg_num_rows($sid) > 0){
      while($result = pg_fetch_array($sid)){
        $id = $result['id'];
      }
    }
    $command = escapeshellcmd("python3 genPlaylist.py $id");
    $output = shell_exec($command);
    echo $output;
  }

?>
