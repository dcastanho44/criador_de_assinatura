$(document).ready(function() {
    var clipboard = new Clipboard('.clipboard');

    $('#search-box').keyup(function(){
      var query = $(this).val();
      if(query != ''){
        $.ajax({
          url: 'buscar.php',
          method: 'POST',
          data: {query: query},
          success: function(data){
            $('#search-results').html(data);
          }
        });
      }
    });

});