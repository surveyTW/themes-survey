(function ($) {
    var aySurvey = [];
    var ayVote_result = [];
    var user_uid;
    var user_name;
    var voted_count;
    var weekday = new Array(7);

    function initParam() {
        voted_count = 0;

        weekday[0] = "Sun";
        weekday[1] = "Mon";
        weekday[2] = "Tue";
        weekday[3] = "Wed";
        weekday[4] = "Thu";
        weekday[5] = "Fri";
        weekday[6] = "Sat";

        if ( $.trim($('#survey').text()) != '' ) {
           aySurvey = JSON.parse($('#survey').text());
        }
        
        if ( $.trim($('#result').text()) != '' ) {
           ayVote_result = JSON.parse($('#result').text());
        }        

        user_uid = $('#user-uid').text();
        user_name = $('#user-name').text();
    }

    function getWeekday(source) {
        var date = new Date(source);
        return weekday[date.getDay()];
    }

    function getVotersByDate(vote_date_key) {
        arr = $.grep(aySurvey, function (obj, i) { // just use arr
            return obj[vote_date_key] > 0;
        });
        return arr;
    }

    function getVoterByUid(uid) {
        arr = $.grep(aySurvey, function (obj, i) { // just use arr
            return obj.uid == uid;
        });
        return arr;
    }

    function setMeet() {
        voted_count = aySurvey.length;
        $('.voted').text(voted_count);
        $('.voted').attr("data-title", "已投票" + voted_count + "人");
    }

    function checkCantMakeIt() {
        var result = false;
        if (user_uid != 0) {

            ayVoter = getVoterByUid(user_uid);

            if (ayVoter.length != 0) {
                var cantMakeItKey = $('input[name="cant-make-it"]')[0].id;
                $.each(ayVoter[0], function(key, value){
                    if(key == cantMakeItKey && value == 1){
                        result = true;
                    }
                });
            }
        }

        return result;
    }

    function setMeetList() {
        var ayDate = $('#date').text().split(",");
        //為了再最後確認有勾無法參加的話 要把正常checkbox disable掉
        var isCantMakeIt = 0;

        $.each(ayDate, function (key, value) {
            if (value != '') {
                var cantMakeIt = '無法參加';
                var tmp = value.split(' ');
                //無法參加不需要getWeekday
                if(!cantMakeIt.localeCompare(tmp[0])){
                    isCantMakeIt = 1;
                    vote_date = tmp[0];
                }
                else{
                    vote_date = tmp[0] + ' ' + getWeekday(tmp[0]);
                }
                vote_time = '';

                if (tmp.length >= 3) {
                    vote_time = tmp[1] + ' ' + tmp[2];
                }

                voted_percent = 0;
                voted_count_by_date = 0;
                
                if (voted_count != 0) {
                   voted_count_by_date = ayVote_result[key];
                   voted_percent = ayVote_result[key] / voted_count * 100;
                } 
                
                //無法參加用特別的name方便接收change event
                if(!cantMakeIt.localeCompare(tmp[0])){
                    html = '<tr><td><input id="' + key + '" type="checkbox" name="cant-make-it" class="form-control input-sm checkbox"></td>';
                }
                else{
                    html = '<tr><td><input id="' + key + '" type="checkbox" class="form-control input-sm checkbox normal-date-checkbox"></td>';
                }
                html += '<td data-date="' + value + '">' + vote_date + '</td>';
                html += '<td>' + vote_time + '</td>';
                html += '<td><a href="#" class="showvoter" data-title="' + vote_date + ' ' + vote_time + ' ' + voted_count_by_date + '人" data-votedatekey="' + key + '" data-toggle="modal" data-target="#Modal-Voter">' + voted_count_by_date + '</a></td>';
                html += '<td><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="' + voted_percent + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + voted_percent + '%"></div></div></td>';
                html += '</tr>';
                $('.checkmeet-list table tbody').append(html);
            }
        });

        //set vote tr
        html = '<tr><td></td><td class="col-xs-3 tmp-username"><input type="text" class="form-control" placeholder="姓名"></td><td class="col-xs-3"><button class="btn btn-danger" id="update-survey" type="submit" data-thmr="thmr_178">送出投票</button></td><td></td><td></td></tr>';
        $('.checkmeet-list table tbody').append(html);

        //diable normal date checkbox if isCantMakeIt
        if(isCantMakeIt && checkCantMakeIt()){
            $('.normal-date-checkbox').attr("disabled", true);
        }
    }

    function setUser() {
        if (user_uid != 0) {
            $('.tmp-username input').val(user_name);

            ayVoter = getVoterByUid(user_uid);

            if (ayVoter.length != 0) {
                $.each(ayVoter[0], function (key, value) {
                    if (key == 'name') {
                        return false;
                    }

                    if (value) {
                        $('#' + key).prop("checked", true);
                    }
                });
            }
        }
    }

    function updateMeet() {
        if ($('.tmp-username input').val() == '') {
            $('#alert-message').text('請填寫姓名!');
            $('#alert-message').show();
            $('.tmp-username input').focus();
            return;
        }

        //Block UI...by Dun
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
        //Block UI end

        var curpath = $(location).attr('pathname');
        var pathary = curpath.split('/');
        curpath = pathary[pathary.length - 1];

        var inputs = $('.checkmeet-list table tbody').find('input');
        var oSurvey = new Object();

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
        oSurvey['uid'] = $('#user-uid').text();

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
    }

    function showPosition(lat, lng, location) {
        //var radius = 1000;
        //var lat = position.coords.latitude;
        //var lng = position.coords.longitude;
        var latlng = new google.maps.LatLng(lat, lng);
        var mapholder = document.getElementById('surveydate-map');
        mapholder.style.height = '380px';
        mapholder.style.width = '100%';
        //mapholder.style.width = '540px';

        var mapOptions = {
            center: latlng,
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL }
        };

        var map = new google.maps.Map(mapholder, mapOptions);
        var marker = new google.maps.Marker({ position: latlng, map: map, title: location });

        return map;

        //    var populationOptions = {
        //      strokeColor: '#FF0000',
        //      strokeOpacity: 0.4,
        //      strokeWeight: 2,
        //      fillColor: '#0099FF',
        //      fillOpacity: 0.15,
        //      map: map,
        //      center: latlng,
        //      radius: 1000
        //    };
    }

    $(document).ready(function () {
        var map;
        $('#alert-message').hide();
        initParam();

        setMeet();
        setMeetList();
        setUser();

        var latlng = $('#latlng').text();
        if (latlng.length) {
            var n = latlng.indexOf(", ");
            map = showPosition(latlng.substr(0, n), latlng.substr(n + 2, latlng.length), $('#location').text());
        }

        //for 無法參加
        $('input[type="checkbox"][name="cant-make-it"]').change(function() {
            if(this.checked) {
                $('.normal-date-checkbox').removeAttr('checked');
                $('.normal-date-checkbox').attr("disabled", true);
            }
            else{
                $('.normal-date-checkbox').removeAttr('disabled');
            }
        });

        //need to resize when we change div size
        $('#Modal-Map').on('shown.bs.modal', function (event) {
            var currentCenter = map.getCenter();
            google.maps.event.trigger(map, 'resize');
            map.setCenter(currentCenter); // Re-set previous center
        })

        $('#Modal-Voter').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var title = button.data('title'); // Extract info from data-* attributes
            var vote_date_key = button.data('votedatekey');

            var modal = $(this);
            var Voters = [];
            modal.find('.modal-title').text(title);
            //99 means all voter
            if(vote_date_key == 99){
                $.each(aySurvey, function (key, obj) {
                    Voters.push(obj.name);
                });
            }
            else{
                ayVoters = getVotersByDate(vote_date_key);

                $.each(ayVoters, function (key, obj) {
                    Voters.push(obj.name);
                });
            }
            modal.find('.modal-body').text(Voters.join(", "));
        })

        $('#update-survey').click(function () {
            updateMeet();
        });

        if ($('#weather-content').length) {
            var nodeWoeid = $('#weather-content').attr("value");
            if (nodeWoeid !== 0) {
                $('#weather-content').weatherfeed([nodeWoeid], {
                    image: true,
                    wind: false,
                    forecast: true,
                    link: false,
                    woeid: true
                }, weatherCB);
            }
        }
    });

    function weatherCB(w) {
        $w = $(w);
        $(".weatherCity").html("Today");
        $(".weatherDesc").hide();
        $(".weatherForecastDay").hide();
        $(".weatherForecastText").hide();

        $(".weatherForecastItem").each(function (index) {
            $obj = $(this);

            if (index === 0) {
                $obj.hide();
                return;
            }

            $obj.css("background-image", function (index, value) {
                return value.replace("s.png", "d.png");
            });

            //      $tempRange = $obj.find(".weatherForecastRange").text();
            //      console.log("weatherForecastRange: " + $tempRange);
        });

        //    $tempRange = $(".weatherRange").text();
        //    console.log("weatherRange: " + $tempRange);
    }
})(jQuery);
