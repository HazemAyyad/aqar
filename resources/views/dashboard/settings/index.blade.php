@extends('dashboard.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/form-validation.css')}}" />
@endsection
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.dashboard')}}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('admin.settings.index')}}">{{__('Settings')}}</a>
                </li>
                <li class="breadcrumb-item active">{{__('Edit Settings')}}</li>
                <!-- Basic table -->


                <!--/ Basic table -->
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('Edit Settings')}}</h5>
                    </div>
                    <div class="card-body">
                        <form id="mainAdd" method="post" action="javascript:void(0)">
                            @csrf






                            <div class="form-group">
                                <label class="form-label" for="whatsapp">{{__('Whatsapp')}}</label>
                                <input type="text" class="form-control" id="whatsapp" value="{{$setting['whatsapp']}}" name="whatsapp"  placeholder="{{__('Whatsapp')}}" required/>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="youtube">{{__('Youtube')}}</label>
                                <input type="text" class="form-control" id="youtube" value="{{$setting['youtube']}}" name="youtube"  placeholder="{{__('Youtube')}}" required/>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="twitter">{{__('Twitter')}}</label>
                                <input type="text" class="form-control" id="twitter" value="{{$setting['twitter']}}" name="twitter"  placeholder="{{__('Twitter')}}" required/>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="facebook">{{__('Facebook')}}</label>
                                <input type="text" class="form-control" id="facebook" value="{{$setting['facebook']}}" name="facebook"  placeholder="{{__('Facebook')}}" required/>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="instagram">{{__('Instagram')}}</label>
                                <input type="text" class="form-control" id="instagram" value="{{$setting['instagram']}}" name="instagram"  placeholder="{{__('Instagram')}}" required/>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="linkedin">{{__('Linkedin')}}</label>
                                <input type="text" class="form-control" id="linkedin" value="{{$setting['linkedin']}}" name="linkedin"  placeholder="{{__('Linkedin')}}" required/>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="slogan">{{__('Slogan')}}</label>
                                <textarea   class="form-control" id="slogan" required name="slogan"  rows="5">{{$setting['slogan']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="slogan">{{__('Slogan Ar')}}</label>
                                <textarea   class="form-control" id="slogan" required name="slogan_ar"  rows="5">{{$setting['slogan_ar']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="desc_contact_us">{{__('Description Contact Us')}}</label>
                                <textarea   class="form-control" id="desc_contact_us" required name="contact_us"  rows="5">{{$setting['contact_us']}}</textarea>
                            </div>
                               <div class="form-group">
                                <label class="form-label" for="desc_contact_us">{{__('Description Contact Us Ar')}}</label>
                                <textarea   class="form-control" id="desc_contact_us" required name="contact_us_ar"  rows="5">{{$setting['contact_us_ar']}}</textarea>
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

        </div>
    </div>
    <!-- / Content -->

@endsection

@section('scripts')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <!-- END: Page JS-->


    <script>

        var data_update_url='{{ route('admin.settings.update')}}'

        $(document).ready(function() {
            function myHandel(obj, id) {
                if ('responseJSON' in obj)
                    obj.messages = obj.responseJSON;
                $('input,select,textarea').each(function () {
                    var parent = "";
                    if ($(this).parents('.form-group').length > 0)
                        parent = $(this).parents('.form-group');
                    if ($(this).parents('.input-group').length > 0)
                        parent = $(this).parents('.input-group');
                    var name = $(this).attr("name");
                    if (obj.messages && obj.messages[name] && ($(this).attr('type') !== 'hidden')) {
                        var error_message = '<div class="col-md-8 offset-md-3 custom-error"><p style="color: red">' + obj.messages[name][0] + '</p></div>'
                        parent.append(error_message);
                    }
                });
            }

            $(document).on("click", "#add_form", function() {
                var form = $(this.form);
                if(! form.valid()) {
                    return false
                };
                if (form.valid()) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    var postData = new FormData(this.form);
                    $('#add_form').html('');
                    $('#add_form').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('Saving')}}...</span>');
                    $.ajax({
                        url: data_update_url,
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('#add_form').html('{{__('Save')}}');
                            setTimeout(function () {
                                toastr['success'](
                                    response.success,
                                    {
                                        closeButton: true,
                                        tapToDismiss: false
                                    }
                                );
                            }, 200);
                            // document.getElementById("mainAdd").reset();
                            $('.custom-error').remove();
                            {{--window.location.href='{{route('dashboard')}}'--}}

                        },
                        error: function (data) {
                            $('.custom-error').remove();
                            $('#add_form').empty();
                            $('#add_form').html('{{__('Save')}}');
                            var response = data.responseJSON;
                            if (data.status == 422) {
                                if (typeof (response.responseJSON) != "undefined") {
                                    myHandel(response);
                                    setTimeout(function () {
                                        toastr['error'](
                                            response.message,
                                            {
                                                closeButton: true,
                                                tapToDismiss: false
                                            }
                                        );
                                    }, 200);
                                }
                            } else {
                                swal.fire({
                                    icon: 'error',
                                    title: response.message
                                });
                            }
                        }
                    });
                }
            });

        });

    </script>
@endsection
