@extends('dashboard.layouts.app')
@section('style')
{{--    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="{{asset('assets/css/form-validation.css')}}" />
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQ0j4pXyZ7pPWTjRK2TKSTKAXAGZCryOY&libraries=places">
    </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #error-msg {
        color: red;
    }
    #valid-msg {
        color: #00C900;
    }
    input.error {
        border: 1px solid #FF7C7C;
    }
    .hide {
        display: none;
    }
</style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">{{__('Home')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('orders.index',$status)}}">{{__('Orders')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('orders.edit',[$status,$package->id])}}">Order #ES{{$package->order_no}}</a>
                </li>
                <li class="breadcrumb-item active">{{__('Edit Address')}}</li>
                <!-- Basic table -->


                <!--/ Basic table -->
            </ol>
        </nav>

    </div>
    <div id="kt_content_container" class="container" data-select2-id="select2-data-kt_content_container">

                <div class="card mb-4">
                    <div class="card-body pt-3">
                        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="mainAdd" method="post" action="javascript:void(0)" >
                            <div class="portlet__body">
                                <div class="row add-address me-md-auto ">

                                    <div class="col-md-7 col-12">
                                        <div class="mb-3">
                                            <label for="nikename">{{__('Company Name')}}</label>
                                            <input type="text" id="nikename" name="nikename" value="{{$address->nikename}}" class="form-control" placeholder="{{__('Company Name')}}" aria-label="Company Name" aria-describedby="Company Name">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <div class="mb-3">
                                            <label for="full_name">{{__("Full Name")}}</label>
                                            <input type="text" id="full_name" name="full_name" value="{{$address->full_name}}" class="form-control" placeholder="{{__('Full Name')}}" aria-label="Full Name" aria-describedby="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <div class="mb-3">
                                            <label for="email">{{__("Email")}}</label>
                                            <input type="email" id="email" name="email" value="{{$address->email}}" class="form-control" placeholder="{{__('Email')}}" aria-label="Email" aria-describedby="Email">
                                        </div>
                                    </div>
{{--                                    <div class="col-md-7 col-12">--}}
{{--                                        <label for="phone">{{__("Telephone")}}</label>--}}

{{--                                        <div class="input-group mb-3">--}}
{{--                                    <span class="input-group-text input-group-calculator">--}}
{{--                                        <i class="fa-solid fa-phone"></i>--}}
{{--                                    </span>--}}
{{--                                            <input type="text" id="phone" name="phone" value="{{$address->phone}}" class="form-control" placeholder="{{__("Telephone")}}" aria-label="Telephone" aria-describedby="Telephone">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-7 col-12">
                                        <label for="phone">{{__("Telephone")}}</label>
                                        <div class="mb-3">
                                            <input type="text" id="phone" name="phone" value="{{$address->full_phone}}"  class="form-control" placeholder="{{__("Telephone")}}" aria-label="Telephone" aria-describedby="Telephone">
                                            <span id="valid-msg_phone" class="hide">✓ Valid</span>
                                            <span id="error-msg_phone" class="hide"></span>
                                            {{--                                    <input type="hidden" id="full_phone" name="full_phone" value="{{$user_address->phone}}">--}}
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <label for="email">{{__("Country")}}</label>

                                        <div class="input-group mb-3">
                                    <span class="input-group-text input-group-calculator" id="basic-addon1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                            <select autocomplete="do-not-autofill" class="form-control js-example-basic-single" id="country"  name="country" aria-required="true">
                                                <option></option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-7 col-12">
                                        <label for="email">{{__("Address 1")}}</label>

                                        <div class="input-group mb-3">
                                    <span class="input-group-text input-group-calculator" id="basic-addon1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                            <input type="text" id="address_1" name="address_1" value="{{$address->address_1}}" class="form-control" placeholder="{{__('Address 1')}}" aria-label="Address 1" aria-describedby="Address 1">


                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <label for="email">{{__("Address 2 (Optional)")}}</label>

                                        <div class="input-group mb-3">
                                    <span class="input-group-text input-group-calculator" id="basic-addon1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                            <input type="text" id="address_2" name="address_2" value="{{$address->address_2}}" class="form-control" placeholder="{{__('Address 2')}}" aria-label="Address 2" aria-describedby="Address 2">


                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <label for="state_province_region">{{__("State/Province")}}</label>

                                        <div class="input-group mb-3">
                                    <span class="input-group-text input-group-calculator" id="basic-addon1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
{{--                                            <input type="text" id="state_province_region" name="state_province_region" value="{{$address->state_province_region}}" class="form-control" placeholder="{{__('State/Province/Region')}}" aria-label="State/Province/Region" aria-describedby="State/Province/Region">--}}
                                            <input type="text" id="state_province_region_input" {{$address->country=='US'?'disabled':''}} value="{{$address->state_province_region}}" name="state_province_region" style="display: {{$address->country=='US'?'none':'block'}}" class="form-control" placeholder="{{__('State/Province/Region')}}" aria-label="State/Province/Region" aria-describedby="State/Province/Region">
                                            <select autocomplete="do-not-autofill" class="form-select" {{$address->country=='US'?'':'disabled'}} id="state_province_region_select" name="state_province_region" aria-required="true" style="display: {{$address->country=='US'?'block':'none'}}">
                                                <option></option>
                                            </select>
                                            {{-- <input type="text" id="state_province_region" name="state_province_region" value="{{$address->state_province_region}}" class="form-control" placeholder="{{__('State/Province/Region')}}" aria-label="State/Province/Region" aria-describedby="State/Province/Region">--}}
{{--                                            <select autocomplete="do-not-autofill" class="form-select" id="state_province_region" name="state_province_region" aria-required="true">--}}
{{--                                                <option></option>--}}
{{--                                            </select>--}}

                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <label for="city">{{__("City")}}</label>

                                        <div class="input-group mb-3">
                                    <span class="input-group-text input-group-calculator" id="basic-addon1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                            <input type="text" id="city" name="city" class="form-control" value="{{$address->city}}" placeholder="{{__('City')}}" aria-label="City" aria-describedby="City">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <label for="postal_code">{{__("Postal Code")}}</label>

                                        <div class="input-group mb-3">
                                    <span class="input-group-text input-group-calculator" id="basic-addon1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                            <input type="text" id="postal_code" name="postal_code" value="{{$address->postal_code}}" class="form-control" placeholder="{{__('Postal Code')}}" aria-label="Postal Code" aria-describedby="Postal Code">
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary " id="add_form" name="submit" value="Submit" >
                                        {{__('Save Changes')}}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

    </div>
@endsection
@section('scripts')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js" integrity="sha512-+gShyB8GWoOiXNwOlBaYXdLTiZt10Iy6xjACGadpqMs20aJOoh+PJt3bwUVA6Cefe7yF7vblX6QwyXZiVwTWGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var input = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg_phone"),
            validMsg = document.querySelector("#valid-msg_phone");
        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["{{__('Invalid number')}}", "{{__('Invalid country code')}}", "{{__('Too short')}}", "{{__('Too long')}}", "{{__('Invalid number')}}"];

        // initialise plugin
        var iti = window.intlTelInput(input, {
            // initialCountry: "auto",
            hiddenInput: "full_phone",
            // geoIpLookup: function(success, failure) {
            //     $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //         var countryCode = (resp && resp.country) ? resp.country : "us";
            //         success(countryCode);
            //
            //     });
            // },
            customContainer: "col-md-12 no-padding intelinput-styles",
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
            preferredCountries: ["lu", "gb","iq","jo","ps","de"],
            // excludeCountries: ["us"]
        });

        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        // on blur: validate
        input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {

                if (iti.isValidNumber()) {
                    validMsg.classList.remove("hide");
                } else {
                    input.classList.add("error");
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        });

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('countrychange', function() {
            var countryData = iti.getSelectedCountryData();
            // console.log(countryData.iso2)
            var country =countryData.iso2.toUpperCase();
            $('#country').val(country).trigger('change');


        });

        input.addEventListener('keyup', reset);
        $("#country").change(function(){
            var country = $(this).find("option:selected").val();
            iti.setCountry(country.toLowerCase());

        });

    </script>
    <script>
        $(document).ready(function() {
            var autocompleteFrom;
            var placeSearch;

            var componentForm = {
                postal_code: 'short_name',
                city: 'short_name'
            };
            autocompleteFrom = new google.maps.places.Autocomplete((document.getElementById('address_1')), {
                types: ['address'],
                // componentRestrictions: {
                //     // country: 'us'
                // }
            });
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocompleteFrom.addListener('place_changed', fillInAddress);

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocompleteFrom.getPlace();

                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];

                    if (addressType === 'country') {
                        val = place.address_components[i]['short_name'];
                        // country(val);
                        localStorage.setItem('country',val);

                    }
                }
                // console.log(place.address_components[6]);
                // console.log($.inArray('country', place.address_components));
                // for (var component in componentForm) {
                //     document.getElementById(component).value = place.address_components;
                // document.getElementById(component).disabled = false;
                // }

                // Get each component of the address from the place details,
                // and then fill-in the corresponding field on the form.
                // console.log(place.address_components.types[0]);
                var street='';
                for (var i = 0; i < place.address_components.length; i++) {
                    // let country='';
                    var addressType = place.address_components[i].types[0];
                    if (addressType === 'locality') {
                        var val = place.address_components[i]['short_name'];
                        document.getElementById('city').value = val;
                    }
                    if (addressType === 'postal_code') {
                        var val = place.address_components[i]['short_name'];
                        document.getElementById('postal_code').value = val;
                    }
                    if (addressType === 'locality') {
                        var val = place.address_components[i]['short_name'];
                        document.getElementById('city').value = val;
                    }
                    if (addressType === 'country') {
                        val = place.address_components[i]['short_name'];
                        // country(val);
                        $('#country').val(val).trigger('change');

                        if (val==='US'){
                            $('#state_province_region_input').hide();
                            $('#state_province_region_select').show();
                            $('#state_province_region_select').next().show();
                        }else {
                            // alert(country)
                            $('#state_province_region_input').show();
                            $('#state_province_region_select').hide();
                            $('#state_province_region_select').next().hide();
                        }
                    }
                    if (addressType==='street_number') {
                        var street_number = place.address_components[i]['short_name'];
                        street = street_number;
                        document.getElementById('address_1').value = street_number;
                    }
                    if (addressType === 'route' ) {
                        // if (add)
                        var val = place.address_components[i]['short_name'];
                        // var street=document.getElementById('address_1_edit_shipping').value

                        document.getElementById('address_1').value = street+' '+ val;

                    }
                    if (addressType === 'administrative_area_level_1') {
                        var state = place.address_components[i]['short_name'];
                        var country=localStorage.getItem('country');

                        if (country==='US'){

                            $('#state_province_region_select').val(state).trigger('change');
                        }else {
                            $('#state_province_region_input').val(state);
                        }

                    }
                }
            }
        });
    </script>
    <script>

        var isoCountries = [
                @foreach( $countries as $country)
{{--                @if($country->ISO=="US")--}}
            { id: '{{$country->ISO}}', text: '{{$country->Country}}'},
{{--            @endif--}}
            @endforeach
        ];
        var states = [

                @foreach ($states as $state)
            {
                id: '{{ $state->code }}',
                text: '{{ $state->name }}'
            },
            @endforeach
        ];

        function formatCountry (country) {
            if (!country.id) { return country.text; }
            var $country = $(
                '<span class="fi fi-'+ country.id.toLowerCase()+' fis"></span>' +
                '<span class="flag-text">'+ country.text+"</span>"
            );
            return $country;
        };
        $("#country").select2({
            placeholder: "Select a country",
            templateResult: formatCountry,
            theme: 'bootstrap-5',
            data: isoCountries
        }).on('change', function (e) {
            var str = $("#s2id_search_code .select2-choice span").text();

            if(this.value==='US'){
                $('#state_province_region_input').hide();
                $('#state_province_region_select').show();
                $('#state_province_region_select').attr('disabled',false);
                $('#state_province_region_input').attr('disabled',true);
                $('#state_province_region_select').next().show();
            }else{
                $('#state_province_region_input').show();
                $('#state_province_region_select').hide();
                $('#state_province_region_select').attr('disabled',true);
                $('#state_province_region_input').attr('disabled',false);
                $('#state_province_region_select').next().hide();
            }
            //this.value
        });
        $("#state_province_region_select").select2({
            placeholder: "{{__('Select a State')}}",
            // templateResult: formatCountry,
            theme: 'bootstrap-5',
            data: states
        });


    </script>
    <script>
        $(document).ready(function() {

            $(document).on("click", "#add_form", function() {
                let form = $(this.form);

                if(! form.valid()) {
                    return false
                };
                if (form.valid()) {
                    var postData = new FormData(this.form);

                    // var phone=$('#phone').val();
                    // $.getJSON("https://phonevalidation.abstractapi.com/v1/?api_key=5d66242e37fa4c9fa1251b365fdff1fd&phone="+phone, function(data) {
                    //         if (data.valid==true) {
                    //             console.log(data)
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }

                                });


                                $.ajax({
                                    url: "{{ route('orders.update-address',$address->id)}}",
                                    type: "POST",
                                    data: postData,
                                    processData: false,
                                    contentType: false,
                                    beforeSend() {
                                        $('.u-loading').fadeIn(10);

                                    },
                                    complete: function () {
                                        $('.u-loading').fadeOut();
                                    },

                                    success: function (response) {

                                        setTimeout(function () {
                                            swal.fire("Success!", response.success, "success").then(function() {
                                                {{--$('#send').html('{{__('Verify')}}');--}}
                                                window.location = '{{route('orders.edit',[$status,$package->id])}}';
                                            });
                                        }, 200);
                                    },
                                    error: function (data) {
                                        $('.custom-error').remove();

                                        var response = data.responseJSON;
                                        // console.log(data)
                                        if (data.status == 422) {
                                            if (typeof (response.responseJSON) != "undefined") {
                                                swal.fire("Error!", response.message, "error");

                                            }
                                        } else {
                                            swal.fire("Error!", response.message, "error");
                                        }
                                    }
                                });
                            {{--}else {--}}
                            {{--    swal.fire("Error!", "{{__('Phone Number Not Valid')}}", "error");--}}
                            {{--}--}}
                        }
            });
            // });

        });

    </script>
    <script>
        $(document).ready(function() {
            $("#state_province_region").val('{{$address->state_province_region}}').trigger("change");
            $("#country").val('{{$address->country}}').trigger("change");
        });
    </script>

@endsection

