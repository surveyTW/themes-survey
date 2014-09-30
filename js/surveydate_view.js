(function ($) {
   $(document).ready( function () {
      $('.webform-component--selectdate').hide();

      var selectdate = $('#edit-submitted-selectdate').find('input');
      $('.year').text($(selectdate[0]).val().substr(6,4));
      $('.date thead').append('<tr>');
      $('.date thead tr:last').append('<th class="col-md-3"></th>');
      selectdate.each(function( index ) {
         var d = $(this).val().substr(0,5);
         $('.date thead tr:last').append('<th class="success">' + d + '</th>');
      });

      $('.date tbody').append('<tr>');
      $('.date tbody tr:last').append('<td class="col-md-3 tmp-username"></td>');
      $('.webform-component--username').prependTo('.tmp-username');
      selectdate.each(function( index ) {
         var id = $(this).attr('id');
         $('.date tbody tr:last').append('<td>');
         $('#' + id).prependTo('.date tbody td:last');
      });
   });
})(jQuery);

