<?php include 'query.php'?>
<!-- <?php include 'callPy.php'?> -->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>The Personal Spotify Playlist Generator</title>
    <link rel="stylesheet" href="static/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

  </head>

  <body>

    <header id = 'title' class='page-header container-fluid align-self-center'>
      <h2>The Custom Spotify Generator</h2>
      <p>Create an interactive playlist based on audio features you choose</p>

  </header>



  <!-- <img id='spotifyLogo' src = "static/images/spotifylogo.png"> -->
  <form name='select_features'>
    <div id = 'selectFeatures' class='container-fluid align-self-center'>
      <h4> Choose Features: </h4>
      <p> Select the following audio features to include when generating a playlist</p>
  </div>
    <div class="container">
      <div class="btn-group-toggle selbut" data-toggle="buttons">
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> acousticness </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> speechiness </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> danceability </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> energy </input>
        </label>
      </div>

      <div class="btn-group-toggle selbut" data-toggle="buttons">
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> tempo </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> liveness </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> instrumentalness </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> loudness </input>
        </label>
      </div>

      <div class="btn-group-toggle selbut" data-toggle="buttons">
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> mode </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> popularity </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> valence </input>
        </label>
        <label class="btn btn-secondary btn-outline-success">
          <input type="checkbox" checked autocomplete="off"> key </input>
        </label>
      </div>
      </div>


      <div id = "selectSong" class='container-lg'>
        <h4>Choose Song:</h4>
        <div id="songPreview">
          <iframe id="SelectedSongPreview" src="" width="300" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
        </div>
        <div id ="searchSong" class="input-group">
          <div class="input-group-prepend">
          </div>
          <input type="text" class="form-control" name='songsearch' id='songsearch'>
          <div id='response' class='container'></div>

          <script src="autocomplete.js" type="text/javascript"></script>


        </div>

    </div>

      </div>



      <div id = "submitPlaylist" class="container">
        <input  type="submit" action="" method ="post" class="btn btn-outline-success" value="Generate Playlist">
      </div>

</form>




  </body>

  <footer>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  </footer>

</html>
