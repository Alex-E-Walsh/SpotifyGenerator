$(document).ready(function() {
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
    var songChoice = $(this).text();
    console.log(songChoice);
    $('#songsearch').val(songChoice);
    $('#response').html("");
  });
});
