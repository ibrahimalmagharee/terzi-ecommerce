@extends('layouts.site')

@section('title')
    تسجيل الاشتراك تاجر
@endsection
@section('content')
    <div class="container-fluid ">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="container">
                <div class="text-lg-right text-center  mx-5 my-1">
                    <h3> <a class="px-5 my-1 text-warning MontserratArabic text-decoration-none" href="{{route('index')}}">
                            @isset($logo)
                                <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px">

                            @else
                                ترزي.
                            @endisset
                        </a></h3>
                    <p class="pr-lg-5  pt-3 MontserratArabicLight">
                        تسجيل الدخول
                    </p>
                </div>
                <form method="post" action="{{route('vendor.register')}}" class="form justify-content-center px-lg-5 px-sm-2 mx-lg-5  ml-lg-5 needs-validation reg-form-custom" _lpchecked="1">
                    @csrf
                    <div class="row" style="height: 70px">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input  type="text" id="name" class="form-control" name="name" value="{{old('name')}}" placeholder=" ">
                            <label for="name" class="MontserratArabicLight label" >اسم الشركة</label>
                            <div class="row position-absolute">
                            @error('name')
                            <span id="name" class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 8px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row my-2" style="height: 70px">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input  type="text" id="pac-input" class="form-control" name="location" value="{{old('location')}}" placeholder=" ">
                            <label for="location"  class="MontserratArabicLight label" >موقع الشركة</label>
                            <span class="after-input"><i class="fa fa-map-marker" ></i>
                        </span>
                            <div class="row position-absolute">
                            @error('location')
                            <span id="location" class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 8px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row my-3 " style="height: 70px">
                        <div role="group" class="col-md-6 col-sm-12 ">
                            <input  type="text" id="commercial_registration_No" class="form-control" name="commercial_registration_No" placeholder=" " value="{{old('commercial_registration_No')}}">
                            <label for="commercial_registration_No"  class="MontserratArabicLight label" >رقم السجل التجاري</label>
                            <div class="row position-absolute">
                            @error('commercial_registration_No')
                            <span id="commercial_registration_No" class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 8px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div role="group" class="col-md-6 col-sm-12 ">
                            <input  type="text" id="mobile_No" name="mobile_No" value="{{old('mobile_No')}}" class="form-control" placeholder=" ">
                            <label for="mobile_No"  class="MontserratArabicLight label" >رقم الجوال</label>
                            <div class="row position-absolute">
                            @error('mobile_No')
                            <span id="mobile_No" class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 8px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row my-2" style="height: 70px">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input  type="text" id="national_Id" class="form-control" name="national_Id" value="{{old('national_Id')}}" placeholder=" ">
                            <label for="national_Id" class="MontserratArabicLight label" >الهوية الوطنية</label>
                            <div class="row position-absolute">
                                @error('national_Id')
                                <span id="national_Id" class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 8px; margin-right: 15px; text-align: center">{{$message}}</span>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="row my-2" style="height: 70px; position: relative; top: 8px">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input  type="email" id="email" name="email" value="{{old('email')}}" class="form-control" placeholder=" " >
                            <label for="email" class="MontserratArabicLight label" >البريد الالكتروني</label>
                            <div class="row position-absolute">
                                @error('email')
                                <span id="email" class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 8px; margin-right: 15px; text-align: center">{{$message}}</span>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="row my-2" style="height: 70px">
                        <div role="group" class="col-md-12 col-sm-12">
                            <select name="type_activity" id="type_activity" class="form-control MontserratArabicLight">
                                <option value="" >حدد نوع النشاط</option>
                                <option value="تفصيل" >تفصيل</option>
                                <option value="أقمشة" >أقمشة</option>
                                <option value="الاثنين معا" >الاثنين معا</option>
                            </select>
                            @error('type_activity')
                            <span id="type_activity" class="text-danger MontserratArabicLightPure float-right span">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-2" style="height: 70px">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input  type="password" id="password" class="form-control" name="password" placeholder=" ">
                            <label for="password" class="MontserratArabicLight label" >كلمة المرور</label>
                            <span class="after-input"><i toggle="#password" class="fa fa-eye toggle-password" ></i></span>
                            <br>

                            <div class="row position-absolute">

                                @error('password')
                                <span class="text-danger MontserratArabicLightPure float-right mr-3" style="position: relative; bottom: 20px;">{{$message}}</span>

                                @else
                                    <span><small class="float-right MontserratArabicLightPure mr-3" style="position: relative; bottom: 20px;">كلمة المرور يجب ان تكون ما بين 4 الى 6 احرف</small></span>

                                    @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row my-2" style="height: 70px">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input  type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control" placeholder=" ">
                            <label for="password_confirmation" class="MontserratArabicLight label" >تاكيد كلمة المرور</label>
                            <span class="after-input"><i toggle="#password_confirmation" class="fa fa-eye toggle-password"></i>
                        </span>
                            <div class="row position-absolute">
                                @error('password')
                                <span class="text-danger MontserratArabicLightPure float-right span" style="position: relative; bottom: -1px; right: 13px">{{$message}}</span>
                                @enderror
                            </div>

                        </div>

                    </div>
{{--                    <div id="map" style="height: 500px;width: 500px;"></div>--}}
                    <div class="row">
                        <button class="btn btn-yellow w-100 m-2">تسجيل </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 register-img">
            <div class="position text-right">
                <h3 class="p-4 my-2 text-warning MontserratArabic">منصة ترزي</h3>

                <p class="px-2 text-white MontserratArabicLight">
                    هي منصة تتيح لك اختيار ذوق اللبس الخاص بك بنوع القماش الذي يناسبك                    </p>
                <a class="m-2 btn btn-yellow" href="{{route('customer.login.page')}}">تسجيل الدخول ك عميل  </a>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')

    <script>
        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".focus").on("focusin", function () {
            $(this).parent().find("label").addClass("active2");
            $(this).parent().find("input").addClass("active-input");
        });
        $(".focus").on("focusout", function () {
            if (!this.value) {
                $(this).parent().find("label").removeClass("active2");
                $(this).parent().find("input").removeClass("active-input");
            }
        });
    </script>
{{--    <script>--}}
{{--        $("#pac-input").focusin(function() {--}}
{{--            $(this).val('');--}}
{{--        });--}}
{{--        $('#latitude').val('');--}}
{{--        $('#longitude').val('');--}}
{{--        // This example adds a search box to a map, using the Google Place Autocomplete--}}
{{--        // feature. People can enter geographical searches. The search box will return a--}}
{{--        // pick list containing a mix of places and predicted search terms.--}}
{{--        // This example requires the Places library. Include the libraries=places--}}
{{--        // parameter when you first load the API. For example:--}}
{{--        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">--}}
{{--        function initAutocomplete() {--}}
{{--            var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--                center: {lat: 24.740691, lng: 46.6528521 },--}}
{{--                zoom: 13,--}}
{{--                mapTypeId: 'roadmap'--}}
{{--            });--}}
{{--            // move pin and current location--}}
{{--            infoWindow = new google.maps.InfoWindow;--}}
{{--            geocoder = new google.maps.Geocoder();--}}
{{--            if (navigator.geolocation) {--}}
{{--                navigator.geolocation.getCurrentPosition(function(position) {--}}
{{--                    var pos = {--}}
{{--                        lat: position.coords.latitude,--}}
{{--                        lng: position.coords.longitude--}}
{{--                    };--}}
{{--                    map.setCenter(pos);--}}
{{--                    var marker = new google.maps.Marker({--}}
{{--                        position: new google.maps.LatLng(pos),--}}
{{--                        map: map,--}}
{{--                        title: 'موقعك الحالي'--}}
{{--                    });--}}
{{--                    markers.push(marker);--}}
{{--                    marker.addListener('click', function() {--}}
{{--                        geocodeLatLng(geocoder, map, infoWindow,marker);--}}
{{--                    });--}}
{{--                    // to get current position address on load--}}
{{--                    google.maps.event.trigger(marker, 'click');--}}
{{--                }, function() {--}}
{{--                    handleLocationError(true, infoWindow, map.getCenter());--}}
{{--                });--}}
{{--            } else {--}}
{{--                // Browser doesn't support Geolocation--}}
{{--                console.log('dsdsdsdsddsd');--}}
{{--                handleLocationError(false, infoWindow, map.getCenter());--}}
{{--            }--}}
{{--            var geocoder = new google.maps.Geocoder();--}}
{{--            google.maps.event.addListener(map, 'click', function(event) {--}}
{{--                SelectedLatLng = event.latLng;--}}
{{--                geocoder.geocode({--}}
{{--                    'latLng': event.latLng--}}
{{--                }, function(results, status) {--}}
{{--                    if (status == google.maps.GeocoderStatus.OK) {--}}
{{--                        if (results[0]) {--}}
{{--                            deleteMarkers();--}}
{{--                            addMarkerRunTime(event.latLng);--}}
{{--                            SelectedLocation = results[0].formatted_address;--}}
{{--                            console.log( results[0].formatted_address);--}}
{{--                            splitLatLng(String(event.latLng));--}}
{{--                            $("#pac-input").val(results[0].formatted_address);--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {--}}
{{--                var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};--}}
{{--                /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/--}}
{{--                $('#latitude').val(markerCurrent.position.lat());--}}
{{--                $('#longitude').val(markerCurrent.position.lng());--}}
{{--                geocoder.geocode({'location': latlng}, function(results, status) {--}}
{{--                    if (status === 'OK') {--}}
{{--                        if (results[0]) {--}}
{{--                            map.setZoom(8);--}}
{{--                            var marker = new google.maps.Marker({--}}
{{--                                position: latlng,--}}
{{--                                map: map--}}
{{--                            });--}}
{{--                            markers.push(marker);--}}
{{--                            infowindow.setContent(results[0].formatted_address);--}}
{{--                            SelectedLocation = results[0].formatted_address;--}}
{{--                            $("#pac-input").val(results[0].formatted_address);--}}
{{--                            infowindow.open(map, marker);--}}
{{--                        } else {--}}
{{--                            window.alert('No results found');--}}
{{--                        }--}}
{{--                    } else {--}}
{{--                        window.alert('Geocoder failed due to: ' + status);--}}
{{--                    }--}}
{{--                });--}}
{{--                SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());--}}
{{--            }--}}
{{--            function addMarkerRunTime(location) {--}}
{{--                var marker = new google.maps.Marker({--}}
{{--                    position: location,--}}
{{--                    map: map--}}
{{--                });--}}
{{--                markers.push(marker);--}}
{{--            }--}}
{{--            function setMapOnAll(map) {--}}
{{--                for (var i = 0; i < markers.length; i++) {--}}
{{--                    markers[i].setMap(map);--}}
{{--                }--}}
{{--            }--}}
{{--            function clearMarkers() {--}}
{{--                setMapOnAll(null);--}}
{{--            }--}}
{{--            function deleteMarkers() {--}}
{{--                clearMarkers();--}}
{{--                markers = [];--}}
{{--            }--}}
{{--            // Create the search box and link it to the UI element.--}}
{{--            var input = document.getElementById('pac-input');--}}
{{--            $("#pac-input").val("أبحث هنا ");--}}
{{--            var searchBox = new google.maps.places.SearchBox(input);--}}
{{--            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);--}}
{{--            // Bias the SearchBox results towards current map's viewport.--}}
{{--            map.addListener('bounds_changed', function() {--}}
{{--                searchBox.setBounds(map.getBounds());--}}
{{--            });--}}
{{--            var markers = [];--}}
{{--            // Listen for the event fired when the user selects a prediction and retrieve--}}
{{--            // more details for that place.--}}
{{--            searchBox.addListener('places_changed', function() {--}}
{{--                var places = searchBox.getPlaces();--}}
{{--                if (places.length == 0) {--}}
{{--                    return;--}}
{{--                }--}}
{{--                // Clear out the old markers.--}}
{{--                markers.forEach(function(marker) {--}}
{{--                    marker.setMap(null);--}}
{{--                });--}}
{{--                markers = [];--}}
{{--                // For each place, get the icon, name and location.--}}
{{--                var bounds = new google.maps.LatLngBounds();--}}
{{--                places.forEach(function(place) {--}}
{{--                    if (!place.geometry) {--}}
{{--                        console.log("Returned place contains no geometry");--}}
{{--                        return;--}}
{{--                    }--}}
{{--                    var icon = {--}}
{{--                        url: place.icon,--}}
{{--                        size: new google.maps.Size(100, 100),--}}
{{--                        origin: new google.maps.Point(0, 0),--}}
{{--                        anchor: new google.maps.Point(17, 34),--}}
{{--                        scaledSize: new google.maps.Size(25, 25)--}}
{{--                    };--}}
{{--                    // Create a marker for each place.--}}
{{--                    markers.push(new google.maps.Marker({--}}
{{--                        map: map,--}}
{{--                        icon: icon,--}}
{{--                        title: place.name,--}}
{{--                        position: place.geometry.location--}}
{{--                    }));--}}
{{--                    $('#latitude').val(place.geometry.location.lat());--}}
{{--                    $('#longitude').val(place.geometry.location.lng());--}}
{{--                    if (place.geometry.viewport) {--}}
{{--                        // Only geocodes have viewport.--}}
{{--                        bounds.union(place.geometry.viewport);--}}
{{--                    } else {--}}
{{--                        bounds.extend(place.geometry.location);--}}
{{--                    }--}}
{{--                });--}}
{{--                map.fitBounds(bounds);--}}
{{--            });--}}
{{--        }--}}
{{--        function handleLocationError(browserHasGeolocation, infoWindow, pos) {--}}
{{--            infoWindow.setPosition(pos);--}}
{{--            infoWindow.setContent(browserHasGeolocation ?--}}
{{--                'Error: The Geolocation service failed.' :--}}
{{--                'Error: Your browser doesn\'t support geolocation.');--}}
{{--            infoWindow.open(map);--}}
{{--        }--}}
{{--        function splitLatLng(latLng){--}}
{{--            var newString = latLng.substring(0, latLng.length-1);--}}
{{--            var newString2 = newString.substring(1);--}}
{{--            var trainindIdArray = newString2.split(',');--}}
{{--            var lat = trainindIdArray[0];--}}
{{--            var Lng  = trainindIdArray[1];--}}
{{--            $("#latitude").val(lat);--}}
{{--            $("#longitude").val(Lng);--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script--}}
{{--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZpt6mWf6P8oYFjrkkVM0k9aP4UBqTuMQ&libraries=places&callback=initAutocomplete&language=ar&region=PA--}}
{{--         async defer"></script>--}}

@endsection
