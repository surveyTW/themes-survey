(function ($) {

   var gmap_inited = 0;

   function gmapInitialize() {
	var markers = [];
	mapholder = document.getElementById('surveymap');
       	mapholder.style.height = '380px';
       	mapholder.style.width = '540px';
		
	var map = new google.maps.Map(mapholder, {
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var defaultBounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(22.037001, 119.760972),
		new google.maps.LatLng(25.316727, 122.367231));
	map.fitBounds(defaultBounds);

	// Create the search box and link it to the UI element.
	var input = /** @type {HTMLInputElement} */(
		document.getElementById('edit-location'));
	//map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	
	var searchBox = new google.maps.places.SearchBox(
			/** @type {HTMLInputElement} */(input));

	// [START region_getplaces]
	// Listen for the event fired when the user selects an item from the
	// pick list. Retrieve the matching places for that item.
	google.maps.event.addListener(searchBox, 'places_changed', function() {
		var places = searchBox.getPlaces();

		if (places.length == 0) {
			return;
		}
		for (var i = 0, marker; marker = markers[i]; i++) {
			marker.setMap(null);
		}

		// For each place, get the icon, place name, and location.
		markers = [];
		var bounds = new google.maps.LatLngBounds();
		for (var i = 0, place; place = places[i]; i++) {

			// Create a marker for each place.
			var marker = new google.maps.Marker({
				map: map,
			    //icon: image,
			    title: place.name,
			    position: place.geometry.location
			});

			markers.push(marker);
			bounds.extend(place.geometry.location);
		}

		map.fitBounds(bounds);
		map.setZoom(14);
	});
	// [END region_getplaces]

	// Bias the SearchBox results towards places that are within the bounds of the
	// current map's viewport.
	google.maps.event.addListener(map, 'bounds_changed', function() {
		var bounds = map.getBounds();
		searchBox.setBounds(bounds);
	});
   }


   function setTextDate() 
   {
      var ayDate = [];
      $('#selecttime .row').each(function( index ) {
         ayDate.push($(this).find('.date').eq(0).val() + ' ' + $(this).find('.bootstrap-timepicker').eq(0).val());
      });
      $('#edit-date').val(ayDate.join());
   }    

   function addNewDate(dateText, currentRow){
	   var row = document.createElement('div');
	   var div_date = document.createElement('div');
	   var div_time = document.createElement('div');
	   var div_add = document.createElement('div');

	   row.className = 'row selectdateRow';
	   div_date.className = 'col-md-6';

	   var input = document.createElement('input');
	   input.className = 'form-control date';
	   $(input).val(dateText);
	   $(div_date).append(input);

	   div_time.className = 'col-md-4';

	   var div_input_group = document.createElement('div');
	   div_input_group.className = 'input-group';

	   var input_time = document.createElement('input');
	   input_time.className = 'form-control bootstrap-timepicker';             
	   $(input_time).timepicker({defaultTime: false});
	   $(input_time).attr('type','text');                      

	   var button_timepicker = document.createElement('button');             
	   button_timepicker.className = 'btn btn-default timepicker';              
	   $(button_timepicker).attr('type','button');             
	   $(button_timepicker).append('<span class="glyphicon glyphicon-time"></span>');              
	   $(button_timepicker).click(function() {
		   var div = $(this).parents('div .input-group').eq(0);
		   $(div).find('input').eq(0).click();
	   });             

	   var span = document.createElement('span');
	   span.className = 'input-group-btn';                
	   $(span).append(button_timepicker);

	   $(div_input_group).append(input_time);             
	   $(div_input_group).append(span);
	   $(div_time).append(div_input_group);

	   /*div_add.className = 'col-md-2';

	     var button = document.createElement('button');
	     button.className = 'btn btn-default addtime'; 
	     $(button).attr('type','button');
	     $(button).append('<span class="glyphicon glyphicon-plus"></span>');             
	     $(div_add).append(button);*/

	   $(row).append(div_date);
	   $(row).append(div_time);
	   //$(row).append(div_add);
	   if(currentRow == -1){
		$('#selecttime').append(row);
	   }
	   else{
	   	var selectTimeElement = document.getElementById('selecttime');
	   	selectTimeElement.insertBefore(row, selectTimeElement.childNodes[currentRow]);	
	   }
   }

   function buildSelectTime()
   {
      var selectedDate = $('#selectdate').multiDatesPicker('getDates');
      var partsOfStr = selectedDate.toString().split(',');
      var row = document.getElementsByClassName('selectdateRow');
      for(oI = 0, nI = 0; oI < row.length && nI < partsOfStr.length; oI++, nI++){
	     //var child = value.getElementsByClassName('date')[0].value;
	     //alert(row[oI].getElementsByClassName('date')[0].value);
	     oldDateText = row[oI].getElementsByClassName('date')[0].value;
	     tmp = partsOfStr[nI].split('/');
             newDateText = tmp[2] + '/' + tmp[0] + '/' + tmp[1];
	     var date1 = new Date(newDateText);
	     var date2 = new Date(oldDateText);
	     if(date1 > date2){
		     /*remove old date*/
		     row[oI].remove();
		     nI--;
		     oI--;
	     }
	     else if(date2 > date1){
		     /*add new date*/
		     addNewDate(newDateText, oI);
	     }
      	     else{
		     /*both move to next*/
	     }
      }
      if(oI < row.length){
	      for( ; oI < row.length; oI++){
		      row[oI].remove();
	      }
      }
      if(nI < partsOfStr.length){
	      for( ; nI < partsOfStr.length; nI++){
		      tmp = partsOfStr[nI].split('/');
		      newDateText = tmp[2] + '/' + tmp[0] + '/' + tmp[1];
		      addNewDate(newDateText, -1);
	      }
      }
   }

   $(document).ready( function () {

      //google.maps.event.addDomListener(window, 'load', gmapInitialize);

      $('#edit-date').hide();

      $('#1st-Next').on('click', function(){
	      $('#second-step').removeClass('hidden').addClass('show');
	      $('#first-step').removeClass('show').addClass('hidden');
	      buildSelectTime();
      });
      $('#2nd-Prev').on('click', function(){
	      $('#second-step').removeClass('show').addClass('hidden');
	      $('#first-step').removeClass('hidden').addClass('show');
      });
      $('#2nd-Next').on('click', function(){
	      $('#second-step').removeClass('show').addClass('hidden');
	      if(!gmap_inited){
	      	gmapInitialize();
		gmap_inited = 1;
	      }
	      $('#third-step').removeClass('hidden').addClass('show');
      });
      $('#3rd-Prev').on('click', function(){
	      $('#third-step').removeClass('show').addClass('hidden');
	      $('#second-step').removeClass('hidden').addClass('show');
      });
      $('#3rd-Next').on('click', function(){
	      $('#third-step').removeClass('show').addClass('hidden');
	      $('#forth-step').removeClass('hidden').addClass('show');
      });
      $('#4th-Prev').on('click', function(){
	      $('#forth-step').removeClass('show').addClass('hidden');
	      $('#third-step').removeClass('hidden').addClass('show');
      });
      
      $('#selectdate').multiDatesPicker({
	  minDate: 0,
      });   
            
      $( '#edit-submit' ).click(function() {
         setTextDate();
      });
   
   });

})(jQuery);
