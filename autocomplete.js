$(document).ready(function() {
  $('#SelectedSongPreview').hide();
  $('#playlistGrid').hide();
  $('#loader').hide();

  $('#songsearch').keyup(function() {
    $('#submit').hide();
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
    if (query.length<=1){
      $('#response').html("");
      $('#submit').show();
    }
  });

  $(document).on('click', 'li', function () {
    var songChoice = $(this).text().split(" By:")[0];
    // console.log(songChoice);
    $('#songsearch').val(songChoice);
    $('#response').html("");
    $('#submit').show()
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

    if(selectedSongID == 'null'){
      alert('Please Search for and Select a Song');
      return;
    };
    if(selectFeatures[0]==selectedSongID && selectFeatures.length ==1){
      alert('Please Check at Least One Audio Feature')
      return;
    };

    $('#loader').show();
    var jsonArr = JSON.stringify(selectFeatures);

    $.ajax(
        {
          url:'callPy.php',
          method:'POST',
          data:{features: jsonArr},
          cache: false,

        error: function() {
          console.log("something went wrong");
          $('#loader').hide();
        },
        success: function(data){
          var df = JSON.parse(data);
          console.log(df)
          $('#playlistGrid').show();
          var tblarr = Array('name','artists','year','acousticness','danceability','energy','instrumentalness','key','liveness','loudness','mode','popularity','speechiness','tempo','valence','distance');

          //then use jquery to put playlist items in grid
          for(var i = 0;i < 10;i++){
            $("#playlistGrid").append("<tr id = songrow".concat(i.toString()).concat("></tr>"));
            for(var j = 0;j<tblarr.length;j++){
              $("#songrow".concat(i.toString())).append("<td>".concat(df[tblarr[j]][i]).concat("</td>"));
            }
          }
          $('#loader').hide();
        }
      }
    );
  });
});
