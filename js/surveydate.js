(function ($) {
   function setTextDate()
   {
      var ayDate = $('#selectdate').multiDatesPicker('getDates');
      $('#edit-textdate').val(ayDate.join());
   }

   $(document).ready( function () {
      $('#edit-textdate').hide();
      $('#selectdate').multiDatesPicker();

      $( "#edit-submit" ).click(function() {
         setTextDate();
      });
   });

})(jQuery);

