(function ($) {

   var infowindow;
   var map;
   var geocoder;
   
   function setAddress( address ) 
   {
       var result = "";
       geocoder.geocode( { 'address': address }, function(results, status) {       
          if (status == google.maps.GeocoderStatus.OK) {
             //console.log(results[0]);
             showPosition(results[0].geometry.location.k,results[0].geometry.location.B,address);                                  
          } else {
             result = "Unable to find address: " + status;
          }
       });
       return result;
   }   
   
   function setSurveyDate() {
      var ay_survey_date = $('#date').text().split(",");      
      
      $('.year').text(ay_survey_date[0].substr(0,4));
      
      $('.survey-date thead').append('<tr>');
      $('.survey-date thead tr:last').append('<th class="col-md-3"></th>');
      console.log(ay_survey_date);
      $.each( ay_survey_date, function( key, value ) {     
         if ( value != '' ) {
            var tmp = value.split(' ');
            var survey_date = tmp[0].substr(5,5);
            var survey_time = tmp[1];
            var survey_flag = tmp[2];        
            $('.survey-date thead tr:last').append('<th class="success">' + survey_date + '<br />' + survey_time + survey_flag + '</th>');            
            //var d = value.substr(0,5);
            //$('.survey-date thead tr:last').append('<th class="success">' + d + '</th>');
         }
      });
      
      if ($('#survey').text() != '' ) {
         var ay_survey_data = JSON.parse($('#survey').text());
         var count = Object.keys(ay_survey_data[0]).length;
      
         $.each( ay_survey_data, function( key, obj ) { 
            $('.survey-date tbody').append('<tr>');         
            $('.survey-date tbody tr:last').append('<td class="col-md-3 tmp-username">' + obj.name + '</td>');   
         
            $.each(obj, function(key, value) {
               if ( key != 'name' ) {                           
                  if ( value == 0 ) {
                     $('.survey-date tbody tr:last').append('<td></td>');
                  } else {
                     $('.survey-date tbody tr:last').append('<td>V</td>');
                  }
               }             
            });
         });      
      }
            
      $('.survey-date tbody').append('<tr>');      
      $('.survey-date tbody tr:last').append('<td class="col-md-3 tmp-username"><input type="text" class="form-control"></td>');     
      
      $.each( ay_survey_date, function( key, value ) {
         $('.survey-date tbody tr:last').append('<td><input id="' + key + '" type="checkbox"></td>');   
      });    
         
   }
      
   
   function showPosition(lat,lng,name) 
   {
       radius = 1000;
       //lat = position.coords.latitude;
       //lng = position.coords.longitude;
       latlng = new google.maps.LatLng(lat, lng)
       mapholder = document.getElementById('surveydate-map');
       mapholder.style.height = '180px';
       mapholder.style.width = '540px';

       var myOptions = {
           center: latlng, 
           zoom: 14,
           mapTypeId: google.maps.MapTypeId.ROADMAP,
           mapTypeControl: false,
           navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL }
       };

       map = new google.maps.Map(mapholder, myOptions);
       var marker = new google.maps.Marker({ position: latlng, map: map, title: name });
       infowindow = new google.maps.InfoWindow();

       var populationOptions = {
           strokeColor: '#FF0000',
           strokeOpacity: 0.4,
           strokeWeight: 2,
           fillColor: '#0099FF',
           fillOpacity: 0.15,
           map: map,
           center: latlng,
           radius: 1000
       };
   }

   $(document).ready( function () {

      geocoder = new google.maps.Geocoder();
      setAddress($('#location').text());  
      setSurveyDate();     
      
      $('#update-survey' ).click(function() {
         var curpath = $(location).attr('pathname');
         curpath = curpath.substr(8,curpath.length-1);       
         
         var inputs = $('.survey-date tbody tr:last').find('input');
         
         var oSurvey = new Object();;
         
         inputs.each(function( index ) {                     
            if ( $(this).attr('type') == 'text' ) {
               oSurvey['name'] = $(this).val();          
            } else {
               var id = $(this).attr('id');
               if ( $(this)[0].checked ) {
                  oSurvey[id] = 1; 
               } else {
                  oSurvey[id] = 0; 
               }
            }
         });         
         
         var oSend = new Object();
         
         oSend.path = curpath;
         oSend.data = oSurvey;
         
         $.ajax({
            url: '?q=update_surveydate',
            type: 'post',         
            dataType: 'json',
            data: JSON.stringify(oSend),
            beforeSend: function () {
               //$('#loading-indicator').show();
            },
            success: function (data) {             
               console.log(data);
               if (data.code == '1') {
                  alert(data.message);
                  location.reload();            
               } else {
                  alert(data.message);
               } 
            },
            error: function (data) {
               console.log(data);
               //showMessage(false, data);
            },
            complete: function () {
               //$('#loading-indicator').hide();
            }
         });
      });

   });

})(jQuery);
