$(document).ready(function()
{
  //when javascript is enabled, it is possible to delete the search button
  $('.search input[type="submit"]').hide();

  $('#search_keywords').keyup(function(key)
  {
    if (this.value.length >= 3 || this.value == '')
    {
      $('#loader').show();
      $('#jobs').load(  //call ajax in the server
        $(this).parents('form').attr('action'),{ query: this.value + '*' },
        function() { $('#loader').hide(); }
      );
    }
  });
});
