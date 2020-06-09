$(document).ready(function() {
  $('#SelectedSongPreview').hide();
  $('#playlistGrid').hide();

  $('#songsearch').keyup(function() {
    var query = $('#songsearch').val();

    if (query.length > 1){
      $.ajax(
        {
          url:'index.php',
          method:'POST',
          data: {
            search:1,
            q:query
          },
          error: function(){
            console.log('AJAX: something went wrong');
          },
          complete: function(data){
            $('#response').html(data['responseText']);
          },
        }
      );
    }


  });

  $(document).on('click', 'li', function () {
    var songChoice = $(this).text().split(" By:")[0];
    // console.log(songChoice);
    $('#songsearch').val(songChoice);
    $('#response').html("");

    $.ajax(
      {
        url:'callPy.php',
        method:'POST',
        data:{
          py:1,
          sc:songChoice
        },
        error: function (){
          console.log('unable to call script');
        },
        success: function(data){
          $('#secretCode').html(data);
          var embedcode = "https://open.spotify.com/embed/track/".concat(data);
          // console.log(embedcode);
          $('#SelectedSongPreview').attr("src",embedcode);
          $('#SelectedSongPreview').show();
        }
      }
    );
  });


  $(document).on('click','#submit', function() {

  var selectFeatures = Array();
  $.map($("input[name='audiofeature']:checked"), function(el){
    selectFeatures.push($(el).val());
  });

  var selectedSongID = $('#secretCode').html();
  selectFeatures.push(selectedSongID);
  // console.log(selectFeatures);

  var jsonArr = JSON.stringify(selectFeatures);

  $.ajax(
      {
        url:'callPy.php',
        method:'POST',
        data:{features: jsonArr},
        cache: false,

      error: function() {
        console.log("something went wrong");
      },
      success: function(data){
        var df = JSON.parse(data);
        console.log(df)
        $('#playlistGrid').show();

        var count = Object.keys(df).length;
        var tblarr = Array('name','artists','year','acousticness','danceability','energy','instrumentalness','key','liveness','loudness','mode','popularity','speechiness','tempo','valence','distance');

        //then use jquery to put playlist items in grid
        for(var i = 0;i < 10;i++){
          // for(var j = 0;j<10 )
          // $('#playlistGrid').append("<tr>".concat(df[tblarr[0]][i]).concat("<tr>"));
          console.log(df[tblarr[0]][i]);
        }

      }
    }
  );
  });

});
