@extends('site.layouts.app')

@section('style')
    <style>
        .icon-box{
            width: 80px;
            height: 80px;
        }
        .icon-box img{
            width: 80px;
            height: 80px;
        }
    </style>
    <!-- Add your styles here if needed -->
@endsection

@section('content')
    <!-- Page Title -->
    <section class="flat-title-page style-2">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('site.index')}}">{{__('Home')}}</a></li>
                <li>/ {{__('Pages')}}</li>
                <li>/ {{__('Contact Us')}}</li>
            </ul>
            <h2 class="text-center">{{__('Contact Us')}}</h2>
        </div>
    </section>
    <!-- End Page Title -->


    <section class="flat-section flat-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-content">
                        <h5>{{__('Drop Us A Line')}}</h5>
                        <p class="body-2 text-variant-1">{{__('Feel free to connect with us through our online channels for updates, news, and more')}}.</p>
                        <form  class="form-contact" id="mainAdd" method="post" action="javascript:void(0)">
                            <div class="box grid-2">
                                <fieldset>
                                    <label for="name">{{__('Full Name')}}:</label>
                                    <input type="text" class="form-control style-1" placeholder="{{__('Name')}}" name="name" id="name" required>
                                </fieldset>
                                <fieldset>
                                    <label for="email">{{__('Email Address')}}:</label>
                                    <input type="text" class="form-control style-1" placeholder="{{__('Email')}}" name="email" id="email" required>
                                </fieldset>
                            </div>
                            <div class="box grid-2">
                                <fieldset>
                                    <label for="phone">{{__('Phone Numbers')}}:</label>
                                    <input type="text" class="form-control style-1" placeholder="ex 012345678" name="phone" id="phone" required>
                                </fieldset>
                                <fieldset>
                                    <label for="subject">{{__('Subject')}}:</label>
                                    <input type="text" class="form-control style-1" placeholder="{{__('Enter Keyword')}}" name="subject" id="subject" required>
                                </fieldset>
                            </div>
                            <fieldset class="box">
                                <label for="message">{{__('Your Message')}}:</label>
                                <textarea name="message" class="form-control" cols="30" rows="10" placeholder="{{__('Message')}}" name="message" id="message" required></textarea>
                            </fieldset>
                            <div class="send-wrap">
                                <button class="tf-btn primary size-1" id="add_form" type="submit">{{__('Send Message')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-info">
                        <h5>{{__('Contact Us')}}</h5>
                        <ul>
                            <li class="box">
                                <div class="text-1 title">{{__('Address')}}:</div>
                                <p class="p-16 text-variant-1">{{$data_settings['address']}}</p>
                            </li>
                            <li class="box">
                                <div class="text-1 title">{{__('Infomation')}}:</div>
                                <p class="p-16 text-variant-1">{{$data_settings['phone']}} <br> {{$data_settings['email']}}</p>
                            </li>

                            <li class="box">
                                <div class="text-1 title">{{__('Follow Us')}}:</div>
                                <ul class="box-social">
                                    <li><a href="{{$data_settings['facebook']}}" class="item">
                                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.00879 10.125L9.50871 6.86742H6.38297V4.75348C6.38297 3.86227 6.81961 2.99355 8.21953 2.99355H9.64055V0.220078C9.64055 0.220078 8.35102 0 7.11809 0C4.54395 0 2.86137 1.56023 2.86137 4.38469V6.86742H0V10.125H2.86137V18H6.38297V10.125H9.00879Z" fill="#161E2D"/>
                                            </svg>
                                        </a></li>
                                    <li><a href="{{$data_settings['instagram']}}" class="item">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.00245 4.38427C6.4484 4.38427 4.38828 6.44438 4.38828 8.99844C4.38828 11.5525 6.4484 13.6126 9.00245 13.6126C11.5565 13.6126 13.6166 11.5525 13.6166 8.99844C13.6166 6.44438 11.5565 4.38427 9.00245 4.38427ZM9.00245 11.9983C7.35195 11.9983 6.00264 10.653 6.00264 8.99844C6.00264 7.34392 7.34794 5.99862 9.00245 5.99862C10.657 5.99862 12.0023 7.34392 12.0023 8.99844C12.0023 10.653 10.653 11.9983 9.00245 11.9983ZM14.8816 4.19552C14.8816 4.79388 14.3997 5.27176 13.8054 5.27176C13.207 5.27176 12.7291 4.78986 12.7291 4.19552C12.7291 3.60118 13.211 3.11928 13.8054 3.11928C14.3997 3.11928 14.8816 3.60118 14.8816 4.19552ZM17.9376 5.28782C17.8694 3.84615 17.5401 2.56912 16.4839 1.51697C15.4318 0.46483 14.1547 0.135534 12.7131 0.0632491C11.2272 -0.021083 6.77368 -0.021083 5.28782 0.0632491C3.85016 0.131518 2.57313 0.460815 1.51697 1.51296C0.460815 2.5651 0.135534 3.84213 0.0632491 5.28381C-0.021083 6.76966 -0.021083 11.2232 0.0632491 12.7091C0.131518 14.1507 0.460815 15.4278 1.51697 16.4799C2.57313 17.532 3.84615 17.8613 5.28782 17.9336C6.77368 18.018 11.2272 18.018 12.7131 17.9336C14.1547 17.8654 15.4318 17.5361 16.4839 16.4799C17.5361 15.4278 17.8654 14.1507 17.9376 12.7091C18.022 11.2232 18.022 6.77368 17.9376 5.28782ZM16.0181 14.3033C15.7048 15.0904 15.0985 15.6968 14.3073 16.0141C13.1227 16.4839 10.3116 16.3755 9.00245 16.3755C7.6933 16.3755 4.87821 16.4799 3.69756 16.0141C2.91046 15.7008 2.30407 15.0944 1.98682 14.3033C1.51697 13.1187 1.6254 10.3076 1.6254 8.99844C1.6254 7.68928 1.52099 4.8742 1.98682 3.69355C2.30006 2.90645 2.90645 2.30006 3.69756 1.98281C4.88223 1.51296 7.6933 1.62139 9.00245 1.62139C10.3116 1.62139 13.1267 1.51697 14.3073 1.98281C15.0944 2.29604 15.7008 2.90243 16.0181 3.69355C16.4879 4.87821 16.3795 7.68928 16.3795 8.99844C16.3795 10.3076 16.4879 13.1227 16.0181 14.3033Z" fill="#161E2D"/>
                                            </svg>

                                        </a></li>
                                    <li><a href="{{$data_settings['youtube']}}" class="item">
                                            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.2775 2.16608C19.051 1.31346 18.3839 0.641967 17.5368 0.414086C16.0013 0 9.84445 0 9.84445 0C9.84445 0 3.68759 0 2.15212 0.414086C1.30502 0.642003 0.637857 1.31346 0.411419 2.16608C0 3.71149 0 6.93586 0 6.93586C0 6.93586 0 10.1602 0.411419 11.7056C0.637857 12.5583 1.30502 13.2018 2.15212 13.4296C3.68759 13.8437 9.84445 13.8437 9.84445 13.8437C9.84445 13.8437 16.0013 13.8437 17.5368 13.4296C18.3839 13.2018 19.051 12.5583 19.2775 11.7056C19.6889 10.1602 19.6889 6.93586 19.6889 6.93586C19.6889 6.93586 19.6889 3.71149 19.2775 2.16608ZM7.8308 9.86334V4.00837L12.9767 6.93593L7.8308 9.86334Z" fill="#161E2D"/>
                                            </svg>

                                        </a></li>
                                    <li><a href="{{$data_settings['twitter']}}" class="item">
                                            <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.9797 3.83062C16.9917 3.99873 16.9917 4.16688 16.9917 4.33498C16.9917 9.46249 13.089 15.3706 5.95611 15.3706C3.75858 15.3706 1.71719 14.7341 0 13.6294C0.312227 13.6654 0.612403 13.6774 0.936643 13.6774C2.74986 13.6774 4.41904 13.065 5.75196 12.0203C4.04678 11.9843 2.61779 10.8675 2.12545 9.33042C2.36563 9.36643 2.60578 9.39045 2.85798 9.39045C3.20621 9.39045 3.55447 9.3424 3.87868 9.25838C2.10146 8.8981 0.768498 7.33705 0.768498 5.45175V5.40373C1.28483 5.69193 1.8853 5.87205 2.52169 5.89604C1.47697 5.19955 0.792524 4.01075 0.792524 2.66581C0.792524 1.94533 0.984621 1.28487 1.32087 0.70847C3.2302 3.06209 6.10019 4.59912 9.31838 4.76727C9.25835 4.47907 9.22231 4.17889 9.22231 3.87868C9.22231 1.74118 10.9515 0 13.101 0C14.2177 0 15.2264 0.468321 15.9349 1.22484C16.8115 1.05674 17.6521 0.732496 18.3966 0.288201C18.1084 1.18884 17.496 1.94536 16.6915 2.42566C17.472 2.34164 18.2285 2.12545 18.925 1.82527C18.3967 2.59377 17.7362 3.27821 16.9797 3.83062Z" fill="#161E2D"/>
                                            </svg>
                                        </a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="flat-section pt-0">
        <div class="container">
            <div id="map-contact" class="map-contact"  data-map-zoom="16" data-map-scroll="true"></div>

        </div>
    </section>
@endsection

@section('scripts')
    <!-- Add your scripts here if needed -->
    <script>

        var data_url='{{ route('site.contact-site')}}'

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
                    // var Content = CKEDITOR.instances['description'].getData();

                    var postData = new FormData(this.form);
                    // postData['description']=Content

                    // console.log(postData)
                    $('#add_form').html('');
                    $('#add_form').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('Sending')}}...</span>');
                    $.ajax({
                        url: data_url,
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('#add_form').empty();
                            $('#add_form').html('{{__('Send')}}');
                            // swal.fire({
                            //     type: 'success',
                            //     title: response.success
                            // });
                            setTimeout(function () {
                                toastr['success'](
                                    response.success,
                                    {
                                        closeButton: true,
                                        tapToDismiss: false
                                    }
                                );
                            }, 200);
                            document.getElementById("mainAdd").reset();
                            $('.custom-error').remove();

                        },
                        error: function (data) {
                            $('.custom-error').remove();
                            $('#add_form').empty();
                            $('#add_form').html('{{__('Sending')}}');
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
