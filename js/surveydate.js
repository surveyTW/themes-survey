(function ($) {

  var gmap_inited = 0;
  var timeSlotNumber = 1;
  var geocoder;
  var map;
  var markers = [];

  // Add a marker to the map and push to the array.
  function addMarker(title, location) {
    var marker = new google.maps.Marker({
      map: map,
      title: title,
      position: location
    });
    markers.push(marker);
  }

  // Sets the map on all markers in the array.
  function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

  // Removes the markers from the map, but keeps them in the array.
  function clearMarkers() {
    setAllMap(null);
  }

  // Shows any markers currently in the array.
//  function showMarkers() {
//    setAllMap(map);
//  }

  // Deletes all markers in the array by removing references to them.
  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }

  // Get Google map location
  function getMapLatLng(latLng) {
    var latlng = latLng.lat() + ", " + latLng.lng();
    console.log(latlng);
    document.getElementsByName('latlng')[0].value = latlng;
  }

  function gmapInitialize() {
    var mapholder = document.getElementById('surveymap');
    mapholder.style.height = '380px';
    mapholder.style.width = '100%';
    //mapholder.style.width = '540px';

    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(mapholder, {
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(21.718679, 119.399414),
            new google.maps.LatLng(25.423431, 122.222900));
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
    google.maps.event.addListener(searchBox, 'places_changed', function () {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      deleteMarkers();

      // For each place, get the icon, place name, and location.
      var bounds = new google.maps.LatLngBounds();
      for (var i = 0, place; place = places[i]; i++) {
        getMapLatLng(place.geometry.location);
        addMarker(place.name, place.geometry.location);
        bounds.extend(place.geometry.location);
      }

      map.fitBounds(bounds);
      map.setZoom(14);
    });
    // [END region_getplaces]

    // Bias the SearchBox results towards places that are within the bounds of the
    // current map's viewport.
    google.maps.event.addListener(map, 'bounds_changed', function () {
      var bounds = map.getBounds();
      searchBox.setBounds(bounds);
    });

    // Activate the click
    google.maps.event.addListener(map, 'click', function (event) {
      getMapLatLng(event.latLng);
      clearMarkers();
      addMarker("", event.latLng);

      geocoder.geocode({'latLng': event.latLng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {
            input.value = results[0].formatted_address;
          } else {
            console.log('No results found');
          }
        } else {
          console.log('Geocoder failed due to: ' + status);
        }
      });
    });
  }

//  function get_location_woeid() {
//    var location = document.getElementById('edit-location');
//    var query = 'select * from geo.places where text="' + location.value + '"';
//    var api = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent(query) + '&format=json&callback=?';
//    var woeid = 0;
//    // Send request
//    $.ajax({
//      type: 'GET',
//      url: api,
//      dataType: 'json',
//      success: function (data) {
//        if (data.query.count > 0) {
//          // List multiple returns
//          if (data.query.count > 1) {
//            woeid = data.query.results.place[0].woeid;
//          }
//          else {
//            woeid = data.query.results.place.woeid;
//          }
//        }
//        console.log(woeid);
//        var input = document.getElementsByName('woeid');
//        input[0].value = woeid;
//      }
//    });
//  }

  function setTextDate() {
    var ayDate = [];
    $('#selecttime .row').each(function (index, date) {
      var localAyDate = [];
      var otherTime = 0;
      $(this).find('.bootstrap-timepicker').each(function (index1, time) {
        var duplicate = 0;
        var tmpTime = $(date).find('.date').eq(0).val() + ' ' + $(time).val();
        if ($(time).val() != '') {
          otherTime = 1;
        }
        //see if this duplicates before array value
        for (i = 0; i < localAyDate.length; i++) {
          if (!tmpTime.localeCompare(localAyDate[i])) {
            duplicate = 1;
            break;
          }
        }
        if (!duplicate) {
          localAyDate.push(tmpTime);
        }

      });
      if (otherTime == 1) {
        //remove time.val() == ''
        for (i = 0; i < localAyDate.length; i++) {
          if (localAyDate[i] == ($(date).find('.date').eq(0).val() + ' ')) {
            localAyDate.splice(i, 1);
            break;
          }
        }
      }

      ayDate.push(localAyDate);
    });
    $('#edit-date').val(ayDate.join());
  }

  function addDivTime(row) {
    var div_time = document.createElement('div');
    div_time.className = 'col-md-2';

    var div_input_group = document.createElement('div');
    div_input_group.className = 'input-group';

    var input_time = document.createElement('input');
    input_time.className = 'form-control bootstrap-timepicker';
    $(input_time).timepicker({defaultTime: false});
    $(input_time).attr('type', 'text');

    var button_timepicker = document.createElement('button');
    button_timepicker.className = 'btn btn-default timepicker';
    $(button_timepicker).attr('type', 'button');
    $(button_timepicker).append('<span class="glyphicon glyphicon-time"></span>');
    $(button_timepicker).click(function () {
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

  function addNewDate(dateText, currentRow) {
    var row = document.createElement('div');
    var div_date = document.createElement('div');

    row.className = 'row selectdateRow form-group';
    div_date.className = 'col-md-2';

    var input = document.createElement('input');
    input.className = 'form-control date';
    $(input).val(dateText);
    $(div_date).append(input);

    $(row).append(div_date);
    for (i = 0; i < timeSlotNumber; i++) {
      addDivTime(row);
    }
    if (currentRow == -1) {
      $('#selecttime').append(row);
    }
    else {
      var selectTimeElement = document.getElementById('selecttime');
      selectTimeElement.insertBefore(row, selectTimeElement.childNodes[currentRow]);
    }
  }

  function buildSelectTime() {
    var selectedDate = $('#selectdate').multiDatesPicker('getDates');
    var partsOfStr = selectedDate.toString().split(',');
    var row = document.getElementsByClassName('selectdateRow');
    for (oI = 0, nI = 0; oI < row.length && nI < partsOfStr.length; oI++, nI++) {
      //var child = value.getElementsByClassName('date')[0].value;
      //alert(row[oI].getElementsByClassName('date')[0].value);
      oldDateText = row[oI].getElementsByClassName('date')[0].value;
      tmp = partsOfStr[nI].split('/');
      newDateText = tmp[2] + '/' + tmp[0] + '/' + tmp[1];
      var date1 = new Date(newDateText);
      var date2 = new Date(oldDateText);
      if (date1 > date2) {
        /*remove old date*/
        row[oI].remove();
        nI--;
        oI--;
      }
      else if (date2 > date1) {
        /*add new date*/
        addNewDate(newDateText, oI);
      }
      else {
        /*both move to next*/
      }
    }
    if (oI < row.length) {
      for (; oI < row.length; oI++) {
        row[oI].remove();
      }
    }
    if (nI < partsOfStr.length) {
      for (; nI < partsOfStr.length; nI++) {
        tmp = partsOfStr[nI].split('/');
        newDateText = tmp[2] + '/' + tmp[0] + '/' + tmp[1];
        addNewDate(newDateText, -1);
      }
    }
  }

  function addOneTimeSlot() {
    timeSlotNumber++;
    $('.selectdateRow').each(function (i, val) {
      addDivTime(val);
    });
  }

  function copyFromFirstRow() {
    for (i = 0; i < timeSlotNumber; i++) {
      $('.selectdateRow').each(function (index, val) {
        if (index != 0) {
          cloneOne = $('.selectdateRow')[0].childNodes[i + 1].cloneNode(true);
          $(val.childNodes[i + 1]).replaceWith(cloneOne);
        }
      });
    }
  }

  function validation1() {
    if ($('#edit-title').val() == "") {
      alert('請填聚會名稱');
      return 0;
    }
    else if ($('#selectdate').multiDatesPicker('getDates').toString() == "") {
      alert('請至少選擇一天');
      return 0;
    }
    else {
      return 1;
    }
  }

  $(document).ready(function () {
    document.onkeydown = function (e) {
      if (e.keyCode == 13) {
        e.returnValue = false;
        e.cancel = true;
      }
    };

    $('#edit-date').hide();

    if ($("input[name$='survey_path']").val() == '') {
      $('#survey-end').hide();
    }
    else {
      //$('#survey_url').tooltip('show');
      $('#survey-body').hide();
    }

    $('#1st-Next').on('click', function () {
      if (validation1()) {
        $('#second-step').removeClass('hidden').addClass('show');
        $('#first-step').removeClass('show').addClass('hidden');
        buildSelectTime();
      }
    });

    $('#2nd-Prev').on('click', function () {
      $('#second-step').removeClass('show').addClass('hidden');
      $('#first-step').removeClass('hidden').addClass('show');
    });

    $('#2nd-Next').on('click', function () {
      $('#second-step').removeClass('show').addClass('hidden');
      if (!gmap_inited) {
        gmapInitialize();
        gmap_inited = 1;
      }
      $('#third-step').removeClass('hidden').addClass('show');
    });

    $('#3rd-Prev').on('click', function () {
      $('#third-step').removeClass('show').addClass('hidden');
      $('#second-step').removeClass('hidden').addClass('show');
    });

    $('#add-timeslots').on('click', addOneTimeSlot);
    $('#copy-from-first-row').on('click', copyFromFirstRow);

    $('#selectdate').multiDatesPicker({
      minDate: 0,
    });

    $('#edit-submit').click(function () {
//      get_location_woeid();
      setTextDate();
    });
  });

})(jQuery);
