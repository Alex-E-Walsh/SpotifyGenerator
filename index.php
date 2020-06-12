<?php include 'query.php'?>
<?php include 'callPy.php'?>

<html lang="en">
  <head>
    <!-- Created by Alexander Walsh -->
    <meta charset="utf-8">
    <meta name="description" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Playlist Generator</title>
    <link rel="stylesheet" href="static/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
  </head>

  <body>
    <header id = 'title' class='page-header container-fluid align-self-center'>
      <h2>Audio Feature Playlist Generator</h2>
  </header>
  <hr class="contentSep">
  <table id="featureDef" class="table table-bordered table-dark table-striped table-hover table-sm">
    <tr>
      <th>Instrumentalness</th>
      <td>Predicts whether a track contains no vocals. The closer the instrumentalness value is to 1.0, the greater likelihood the track contains no vocals.</td>
    </tr>
    <tr>
      <th>Dancebility</th>
      <td>How suitable a track is for dancing based on a combination of musical elements (tempo, rhythm stability, beat strength, and overall regularity). A value of 1.0 is most danceable.</td>
    </tr>
    <tr>
      <th>Energy</th>
      <td>Represents a perceptual measure of intensity and activity. Measured form 0 - 1.0</td>
    </tr>
    <tr>
      <th>Mode</th>
      <td>The modality (major or minor) of a track. Major is represented by 1 and minor is 0</td>
    </tr>
    <tr>
      <th>Acousticness</th>
      <td>A confidence measure from 0 to 1.0 of whether the track is acoustic. 1.0 represents high confidence the track is acoustic.</td>
    </tr>
    <tr>
      <th>Liveness</th>
      <td>Detects the presence of an audience in the recording. Higher liveness values represent an increased probability that the track was performed live.</td>
    </tr>
    <tr>
      <th>Tempo</th>
      <td>The overall estimated tempo of a track in beats per minute (BPM).</td>
    </tr>
    <tr>
      <th>Loudness</th>
      <td>The overall loudness of a track in decibels(dB) averaged across the entire track.</td>
    </tr>
    <tr>
      <th>Speechiness</th>
      <td>Detects the presence of spoken words in a track. The more exclusively speech-like, the closer to 1.0.</td>
    </tr>
    <tr>
      <th>Popularity</th>
      <td>A higher popularity score corresponds to more streams as of 2020.</td>
    </tr>
    <tr>
      <th>Valence</th>
      <td>A measure from 0 - 1.0 describing the musical positiveness conveyed by a track. Tracks with high valence sound more positive, while tracks with low valence sound more negative.</td>
    </tr>
    <tr>
      <th>Key</th>
      <td>The estimated overall key of the track. Integers map to pitches using standard Pitch Class notation. E.g. 0 = C, 1 = C♯/D♭, 2 = D, etc.</td>
    </tr>
  </table>

  <img id='spotifyLogo' src = "static/spotifyLogo.png">
  <form name='select_features' onsubmit="return false">
    <div id = 'selectFeatures' class='container-fluid align-self-center'>
      <h4> Choose Features: </h4>
      <button id="featureToggle" class = "btn btn-outline-success">Show Audio Feature Definitions</button>
  </div>
      <div class="container" id="featuresSelect">
          <div class="featrow row">
            <input  class = "audfeat" name = "audiofeature" id = "instrumentalness" value = "instrumentalness" type="checkbox" data-toggle="toggle" data-on="Instrumentalness" data-off="Instrumentalness" data-onstyle="success">
            <input class = "audfeat" name = "audiofeature" id = "danceability" value = "danceability" type="checkbox" data-toggle="toggle" data-on="Dancebility" data-off="Dancebility" data-onstyle="success">
            <input class = "audfeat" name = "audiofeature" id = "energy" value = "energy" type="checkbox" data-toggle="toggle" data-on="Energy" data-off="Energy" data-onstyle="success">
            <input  class = "audfeat" name = "audiofeature" id = "mode" value = "mode" type="checkbox" data-toggle="toggle" data-on="Mode" data-off="Mode" data-onstyle="success">
          </div>
          <div class="featrow row">
            <input class = "audfeat" name = "audiofeature" id = "acousticness" value = "acousticness" type="checkbox" data-toggle="toggle" data-on="Acousticness" data-off="Acousticness" data-onstyle="success">
            <input  class = "audfeat" name = "audiofeature" id = "liveness" value = "liveness" type="checkbox" data-toggle="toggle" data-on="Liveness" data-off="Liveness" data-onstyle="success">
            <input  class = "audfeat" name = "audiofeature" id = "tempo" value = "tempo" type="checkbox" data-toggle="toggle" data-on="Tempo" data-off="Tempo" data-onstyle="success">
            <input  class = "audfeat" name = "audiofeature" id = "loudness" value = "loudness" type="checkbox" data-toggle="toggle" data-on="Loudness" data-off="Loudness" data-onstyle="success">
          </div>
          <div class="featrow row">
            <input class = "audfeat" name = "audiofeature" id = "speechiness" value = "speechiness" type="checkbox" data-toggle="toggle" data-on="Speechiness" data-off="Speechiness" data-onstyle="success">
            <input  class = "audfeat" name = "audiofeature" id = "popularity" value = "popularity" type="checkbox" data-toggle="toggle" data-on="Popularity" data-off="Popularity" data-onstyle="success">
            <input  class = "audfeat" name = "audiofeature" id = "valence" value = "valence" type="checkbox" data-toggle="toggle" data-on="Valence" data-off="Valence" data-onstyle="success">
            <input  class = "audfeat" name = "audiofeature" id = "key" value = "key" type="checkbox" data-toggle="toggle" data-on="Key" data-off="Key" data-onstyle="success">
          </div>
        </div>
    <hr class="contentSep">
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
          <script src="update.js" type="text/javascript"></script>
        </div>
    </div>
      </div>
      <div class="container disable-select" id="submitBox">
        <button id="submit" name="submit" class="btn btn-outline-success">Generate Playlist</button>
      </div>
  <div id = "loader" class="loader"></div>
</form>
  <p id="secretCode">null</p>
  <div class="table-responsive">
    <table id="playlistGrid" class="table table-bordered table-dark table-striped table-hover table-sm">
      <thead>
        <tr id='playlistFeatures'>
          <th id="name">Title</th>
          <th id="artists">Artists</th>
          <th id="year">year</th>
          <th id="acousticness">Acousticness</th>
          <th id='danceability'>danceability</th>
          <th id="energy">energy</th>
          <th id="instrumentalness">instrumentalness</th>
          <th id="key">key</th>
          <th id="liveness">liveness</th>
          <th id="loudness">loudness</th>
          <th id="mode">mode</th>
          <th id="popularity">popularity</th>
          <th id="speechiness">speechiness</th>
          <th id="tempo">tempo</th>
          <th id="valence">valence</th>
          <th id="distance">distance</th>
        </tr>
      </thead>
      <tbody id="playlistBody">
      </tbody>
    </table>
  </div>
  <div id="iframeBuild"></div>

  </body>

  <p id='cr'>&copy; Created by Alex Walsh.</p>

  <footer>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </footer>
</html>
