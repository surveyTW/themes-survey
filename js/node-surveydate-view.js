(function ($) {

    var infowindow;
    var map;
    var geocoder;

    function setAddress(address)
    {
        var result = "";
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                //console.log(results[0]);
                showPosition(results[0].geometry.location.k, results[0].geometry.location.D, address);
            } else {
                result = "Unable to find address: " + status;
            }
        });
        return result;
    }

    function setSurveyDate() {
        var ay_survey_date = $('#date').text().split(",");
        
        
        
   

	this_user = $('#uid').text();
	first_time = 1;

        $('.year').text(ay_survey_date[0].substr(0, 4));

        $('.survey-date thead').append('<tr>');
        $('.survey-date thead tr:last').append('<th class="col-md-3 info">與會者名字</th>');
     //   console.log(ay_survey_date);
        $.each(ay_survey_date, function (key, value) {
            if (value != '') {
                var tmp = value.split(' ');
                var survey_year = tmp[0].substr(0, 4);
                var survey_date = tmp[0].substr(5, 5);
                var survey_time = tmp[1];
                var survey_flag = tmp[2];
                var weekday = new Array(7);
                weekday[0] = "Sun";
                weekday[1] = "Mon";
                weekday[2] = "Tue";
                weekday[3] = "Wed";
                weekday[4] = "Thu";
                weekday[5] = "Fri";
                weekday[6] = "Sat";
                var d = new Date(tmp[0]);
                if (!survey_flag) {
                    survey_flag = '';
                }
                $('.survey-date thead tr:last').append('<th class="info">' + survey_date + '/' + survey_year + '<br />' + weekday[d.getDay()] + ' ' + survey_time + survey_flag + '</th>');
                //var d = value.substr(0,5);
                //$('.survey-date thead tr:last').append('<th class="success">' + d + '</th>');
            }
        });

	if ($('#survey').text() != '') {
		var ay_survey_data = JSON.parse($('#survey').text());
		
		var data2=ay_survey_data;
		
		var count = Object.keys(ay_survey_data[0]).length;
		
		var colums_count=0;
	//	console.log(ay_survey_date[0]);
		$.each(ay_survey_data, function (key, obj) {
			if(this_user != 0 && this_user == obj.uid){
				first_time = 0;
				$('.survey-date tbody').append('<tr>');
				$('.survey-date tbody tr:last').append('<td class="col-md-3 tmp-username success"><input type="text" class="form-control info" value="' + obj.name + '"></td>');
				$.each(obj, function (key, value) {
					if (key != 'name' && key !='uid') {
						if (value == 0) {
							data2[colums_count][key]=" ";
							$('.survey-date tbody tr:last').append('<td class="success"><input id="' + key + '" type="checkbox"></td>');
						}
						else{
							data2[colums_count][key]="Ok";
							$('.survey-date tbody tr:last').append('<td class="success"><input id="' + key + '" type="checkbox" checked></td>');
						}
					}
				});
			}
			else{
//				$('.survey-date tbody').append('<tr>');
//				$('.survey-date tbody tr:last').append('<td class="col-md-3 tmp-username">' + obj.name + '</td>');

				$.each(obj, function (key, value) {
					if (key != 'name' && key !='uid') {
						if (value == 0) {
						    data2[colums_count][key]=" ";
				//			$('.survey-date tbody tr:last').append('<td></td>');
						} else {
							data2[colums_count][key]="Ok";
				//			$('.survey-date tbody tr:last').append('<td>V</td>');
						}
					}
				});
			}
			colums_count++;	
		});
	}

	if(first_time){
		$('.survey-date tbody').append('<tr>');
		$('.survey-date tbody tr:last').append('<td class="col-md-3 tmp-username warning"><input type="text" class="form-control"></td>');

		$.each(ay_survey_date, function (key, value) {
			$('.survey-date tbody tr:last').append('<td class="warning"><input id="' + key + '" type="checkbox"></td>');
		});
	}

        if ($('#result').text() != '') {
            var ay_survey_result = JSON.parse($('#result').text());
            $('.survey-date tfoot').append('<tr>');
            $('.survey-date tfoot tr:last').append('<td class="col-md-3 tmp-username">result</td>');
            $.each(ay_survey_result, function (key, value) {
                if (key != 'name') {
                    $('.survey-date tfoot tr:last').append('<td>' + value + '</td>');
                }
            });
        }
 
        	
    $('#table').bootstrapTable({
       
                cache: false,
                height: 400,
                striped: true,
                pagination: true,
                pageSize: 50,
                pageList: [10, 25, 50, 100, 200],
                search: true,
                showColumns: true,
                showRefresh: true,
                minimumCountColumns: 2,
                clickToSelect: true,            
      			data:data2
    			
		});

    
    }


    function showPosition(lat, lng, name)
    {
        radius = 1000;
        //lat = position.coords.latitude;
        //lng = position.coords.longitude;
        latlng = new google.maps.LatLng(lat, lng);
        mapholder = document.getElementById('surveydate-map');
        mapholder.style.height = '180px';
        mapholder.style.width = '50%';
        //mapholder.style.width = '540px';

        var myOptions = {
            center: latlng,
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL}
        };

        map = new google.maps.Map(mapholder, myOptions);
        var marker = new google.maps.Marker({position: latlng, map: map, title: name});
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

    $(document).ready(function () {

        geocoder = new google.maps.Geocoder();
        setAddress($('#location').text());
        setSurveyDate();

        $('#update-survey').click(function () {
	    if($('.tmp-username input').val() == ''){
		    alert('請記得填名字!');
		    return;
	    }

            //Block UI...by Dun

            $.blockUI({css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }});


            //Block UI end
            var curpath = $(location).attr('pathname');
            var pathary = curpath.split('/');
            curpath = pathary[pathary.length - 1];

            var inputs = $('.survey-date tbody').find('input');

            var oSurvey = new Object();
            ;

            inputs.each(function (index) {
                if ($(this).attr('type') == 'text') {
                    oSurvey['name'] = $(this).val();
                } else {
                    var id = $(this).attr('id');
                    if ($(this)[0].checked) {
                        oSurvey[id] = 1;
                    } else {
                        oSurvey[id] = 0;
                    }
                }
            });
	    oSurvey['uid'] = $('#uid').text();

            var oSend = new Object();

            oSend.path = curpath;
            oSend.data = oSurvey;

            $.ajax({
                url: 'update_surveydate',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(oSend),
                beforeSend: function () {
                    //$('#loading-indicator').show();
                },
                success: function (data) {
                   // console.log(data);
                    if (data.code == '1') {

                        $.unblockUI({
                            onUnblock: function () {
                                alert(data.message);
                                location.reload();
                            }
                        });
                        // alert(data.message);
                        //    location.reload();
                    } else {
                        $.unblockUI({
                            onUnblock: function () {
                                alert(data.message);
                            }
                        });
                    }
                },
                error: function (data) {
                    $.unblockUI({
                        onUnblock: function () {
                            alert(data.message);
                        }
                    });
                    //console.log(data);
                    //showMessage(false, data);
                },
                complete: function () {
                    //$('#loading-indicator').hide();
                }
            });
        });

        var nodeWoeid = $('#yqlWeather').attr("value");
        if (nodeWoeid !== 0) {
            $('#yqlWeather').weatherfeed([nodeWoeid], {
                woeid: true,
                forecast: true
            });
        }

    });

})(jQuery);
