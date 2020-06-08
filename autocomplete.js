$(document).ready(function() {
  // $('#SelectedSongPreview').hide();

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
          var embedcode = "https://open.spotify.com/embed/track/".concat(data);
          $('#SelectedSongPreview').attr("src",embedcode);
          console.log(embedcode);
          // $('#SelectedSongPreview').show();
        }
      }
    );


  });

});
