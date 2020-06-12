<?php
putenv("PATH=/usr/local/bin/:" . exec('echo $PATH'));
//update route to correct python3

//run when user clicks on song
  if(!empty($_POST['py'])){
    $songSelect = $_POST['sc'];
    $db_connect = pg_connect(getenv("DATABASE_URL"));
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
    echo $id;
  }
  if(!empty($_POST['features'])){
    $feats = $_POST['features'];
    $command = escapeshellcmd("python3 genPlaylist.py $feats");
    $playlist_json = shell_exec($command);
    echo $playlist_json;
  }
?>
