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
    #qr-shaded-region{
        border-width: 261px 473px;
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
                    <a href="{{route('orders.index',1)}}">{{__('Orders')}}</a>
                </li>

                <li class="breadcrumb-item active">{{__('Scan')}}</li>
                <!-- Basic table -->


                <!--/ Basic table -->
            </ol>
        </nav>

    </div>
    <div id="kt_content_container" class="container" data-select2-id="select2-data-kt_content_container">
        <div id="reader" width="600px"></div>
                <div class="card mb-4">
                    <div class="card-body pt-3">
                        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="mainAdd" method="post" action="javascript:void(0)" >
                            <div class="portlet__body">
                                <div class="row add-address me-md-auto ">
                                    <div class="input-group">
                                        <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="Cari Kode Barang/ Barcode">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" id="btnsearch" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                     width="40" height="40"
                                                     viewBox="0 0 50 50"
                                                     style=" fill:#000000;"><path d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"></path></svg>
                                            </button>
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
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            alert(`Code matched = ${decodedText}`, decodedResult);
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    </script>

@endsection

