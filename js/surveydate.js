(function ($) {

   var gmap_inited = 0;
   var timeSlotNumber = 1;

   function gmapInitialize() {
	var markers = [];
	mapholder = document.getElementById('surveymap');
       	mapholder.style.height = '380px';
       	mapholder.style.width = '50%';
       	//mapholder.style.width = '540px';
		
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
	   $('#selecttime .row').each(function( index, date) {
		   var localAyDate = [];
		   var otherTime = 0;
		   $(this).find('.bootstrap-timepicker').each(function( index1, time){
			   var duplicate = 0;
			   var tmpTime = $(date).find('.date').eq(0).val() + ' ' + $(time).val();
			   if($(time).val() != ''){
				   otherTime = 1;
			   }
			   //see if this duplicates before array value
			   for(i=0; i<localAyDate.length; i++){
				   if(!tmpTime.localeCompare(localAyDate[i])){
					   duplicate = 1;
					   break;
				   }
			   }
			   if(!duplicate){
				   localAyDate.push(tmpTime);
			   }

		   });
		   if(otherTime == 1){
			   //remove time.val() == ''
			   for(i=0; i<localAyDate.length; i++){
				   if(localAyDate[i] == ($(date).find('.date').eq(0).val() + ' ')){
					   localAyDate.splice(i, 1);
					   break;
				   }
			   }
		   }

		   ayDate.push(localAyDate);
	   });
	   $('#edit-date').val(ayDate.join());
   }    

   function addDivTime(row){
	   var div_time = document.createElement('div');
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
	   $(row).append(div_time);
   }

   function addNewDate(dateText, currentRow){
	   var row = document.createElement('div');
	   var div_date = document.createElement('div');

	   row.className = 'row selectdateRow';
	   div_date.className = 'col-md-4';

	   var input = document.createElement('input');
	   input.className = 'form-control date';
	   $(input).val(dateText);
	   $(div_date).append(input);

	   $(row).append(div_date);
	   for(i=0; i<timeSlotNumber; i++){
	   	addDivTime(row);
	   }
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

   function addOneTimeSlot(){
	   timeSlotNumber++;
	   $('.selectdateRow').each(function(i, val){
		addDivTime(val);
	   });
   }

   function copyFromFirstRow(){
	   for(i=0; i<timeSlotNumber; i++){
		   $('.selectdateRow').each(function(index, val){
			   if(index != 0){
		   		   cloneOne = $('.selectdateRow')[0].childNodes[i+1].cloneNode(true);
				   $(val.childNodes[i+1]).replaceWith(cloneOne);
			   }
		   });
	   }
   }

   function validation1(){
	if($('#selectdate').multiDatesPicker('getDates').toString() == ""){
		alert('請至少選擇一天');
		return 0;
	}
	else{
		return 1;
	}
   }

   $(document).ready( function () {

	   //google.maps.event.addDomListener(window, 'load', gmapInitialize);

	   document.onkeydown = function (e){ 
		   if(event.keyCode == 13){ 
			   event.returnValue=false;        
			   event.cancel = true;      
		   }
	   }


	   $('#edit-date').hide();

	   if($("input[name$='survey_path']").val() == ''){
		   $('#survey-end').hide();
	   }
	   else{
		   $('#survey-body').hide();
	   }

	   $('#1st-Next').on('click', function(){
		   if(validation1()){
			   $('#second-step').removeClass('hidden').addClass('show');
			   $('#first-step').removeClass('show').addClass('hidden');
			   buildSelectTime();
		   }
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

	   $('#add-timeslots').on('click', addOneTimeSlot);
	   $('#copy-from-first-row').on('click', copyFromFirstRow);

	   $('#selectdate').multiDatesPicker({
		   minDate: 0,
	   });   

	   $( '#edit-submit' ).click(function() {
		   setTextDate();
	   });
	   $( '#copytext' ).click(function() {
		   $('#survey-end').zclip({ 
		   path:'sites/all/themes/survey/js/zclip/ZeroClipboard.swf', 
		   copy: $('#text-to-copy').val(),
		   afterCopy: function() {
      	   console.log('copied');
      		alert('已複製到剪貼薄');
   			 } 
		   }); 
		  
		  
	   });	
   });

})(jQuery);
