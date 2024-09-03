@extends('dashboard.layouts.app')
@section('style')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- Row Group CSS -->
    {{--    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />--}}
    <link rel="stylesheet" href="{{asset('assets/css/form-validation.css')}}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        :root {
            --min-color: #08173D;
            --red-color: #E02626;
            --secand-color: #08173D;
            --silver-color: #787878;
            --sky-color: #5FC7E8;
            --transition: 0.3s;
            --pink-color: #F1A8A0;
            --bg-color: #FAFAFA;
        }
        .address-box {
            background-color: var(--bg-color);
            padding: 1.5rem;
            border: 1px solid var(--red-color);
            border-radius: 10px;
            margin-bottom: 2rem;
            z-index: 1;
            width: 100%;

        }
        .ui-datepicker-trigger {
            padding: 0px;
            padding-left: 5px;
            vertical-align: baseline;
            position: relative;
            top: 12px;
            height: 28px;
        }
        .address .toolContent {
            position: absolute;
            width: 400px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--bg-color);
            z-index: 2;
            display: none;
        }
        @media (max-width: 767px) {
            .address {
                width: 100%;
            }

            .address .line {
                border: none !important;
            }

            .address .classifyDiv {
                width: 100% !important;
                border: none !important;
            }

            .address .classifyDiv button {
                margin-bottom: 1rem;
            }

            .address .toolContent {
                width: 200px;
                left: unset;
                transform: unset;
                max-height: 150px;
                overflow: scroll;
                padding: 1rem;
            }
        }
    </style>
    <style>
        .shipping-calculator input{
            min-height: 44px;
        }
        .row-dimension img{
            height: 16px;
        }
        .row-dimension .form-select{
            padding: 3px 26px;

        }
        .row-dimension{
            border: 1px solid;
        }
        .div_dimension{
            display: flex;
        }
        .div_dimension .div_item_dimension{
            width: 20%;
            margin: 0 1%;
        }
        #btn_add_new_package{

        }
    </style>
    <style>
        .shipping-calculator input{
            min-height: 44px;
        }
        .row-dimension img{
            height: 16px;
        }
        .row-dimension .form-select{
            padding: 3px 26px;
        }
        .div_dimension{
            display: flex;
        }
        .div_dimension .div_item_dimension{
            width: 20%;
            margin: 0 1%;
        }
        #btn_add_new_package{

        }
    </style>
    <style>
        /* variables */
        :root {
            /* colors */
            --ri5-color-primary-hsl: 242, 69%, 52%;
            --ri5-color-bg-hsl: 0, 0%, 100%;
            --ri5-color-contrast-high-hsl: 230, 7%, 23%;
            --ri5-color-contrast-higher-hsl: 230, 13%, 9%;
            --ri5-color-bg-darker-hsl: 240, 4%, 90%;
            --ri5-color-white-hsl: 0, 0%, 100%;

            /* typography */
            --ri5-text-sm: 0.833rem;

            --radio-switch-width: 186px;
            --radio-switch-height: 46px;
            --radio-switch-padding: 1px;
            --radio-switch-radius: 100vw;
            --radio-switch-animation-duration: 0.3s;
        }

        .radio-switch {
            position: relative;
            display: inline-flex;
            padding: var(--radio-switch-padding);
            border-radius: 10px;
            background-color: hsl(var(--ri5-color-bg-darker-hsl));
        }
        .radio-switch:focus-within, .radio-switch:active {
            box-shadow: 0 0 0 2px hsla(var(--ri5-color-contrast-higher-hsl), 0.15);
        }

        .radio-switch__item {
            position: relative;
            display: inline-block;
            height: calc(var(--radio-switch-height) - 2*var(--radio-switch-padding));
            width: 30px;
        }

        .radio-switch__label {
            position: relative;
            z-index: 2;
            display: flex;
            height: 100%;
            align-items: center;
            justify-content: center;
            font-weight:700;
            border-radius:15px;
            cursor: pointer;
            font-size: var(--ri5-text-sm);
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: all var(--radio-switch-animation-duration);
        }
        .radio-switch__input:checked ~ .radio-switch__label {
            color: hsl(var(--ri5-color-white-hsl));
        }
        .radio-switch__input:focus ~ .radio-switch__label {
            background-color: hsla(var(--ri5-color-primary-hsl), 0.6));
        }
        .radio-switch__label :not(*):focus-within, .radio-switch__input:focus ~ .radio-switch__label {
            background-color: transparent;
        }

        @if(App::isLocale('en'))
        .radio-switch__marker {
            position: absolute;
            z-index: 1;
            top: 0;
            left: -100%;
            border-radius: 10px;
            background-color: #df3a27;
            height: calc(var(--radio-switch-height) - 2*var(--radio-switch-padding));
            width: 30px;
            box-shadow: 0 0.9px 1.5px rgba(0, 0, 0, 0.03),0 3.1px 5.5px rgba(0, 0, 0, 0.08),0 14px 25px rgba(0, 0, 0, 0.12);
            transition: -webkit-transform var(--radio-switch-animation-duration);
            transition: transform var(--radio-switch-animation-duration);
            transition: transform var(--radio-switch-animation-duration), -webkit-transform var(--radio-switch-animation-duration);
        }
        @else
        .radio-switch__marker {
            position: absolute;
            z-index: 1;
            top: 0;
            right: -100%;
            border-radius: 10px;
            background-color: #df3a27;
            height: calc(var(--radio-switch-height) - 2*var(--radio-switch-padding));
            width: 30px;
            box-shadow: 0 0.9px 1.5px rgba(0, 0, 0, 0.03),0 3.1px 5.5px rgba(0, 0, 0, 0.08),0 14px 25px rgba(0, 0, 0, 0.12);
            transition: -webkit-transform var(--radio-switch-animation-duration);
            transition: transform var(--radio-switch-animation-duration);
            transition: transform var(--radio-switch-animation-duration), -webkit-transform var(--radio-switch-animation-duration);
        }
        @endif
        .radio-switch__input:checked ~ .radio-switch__marker {
            -webkit-transform: translateX(100%);
            transform: translateX(100%);
        }

        /* utility classes */
        .ri5-sr-only {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
            clip-path: inset(50%);
            width: 1px;
            height: 1px;
            overflow: hidden;
            padding: 0;
            border: 0;
            white-space: nowrap;
        }

        /* ------------------------ Watermark (Please Ignore) ----------------------- */
        .watermark-ctr {
            --clr-button-bg: #141414;
            --clr-button: 72, 39, 236;
            --clr-text: #ffffff;

            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 1000;
        }
        .watermark-ctr a {
            text-decoration: none;
            color: inherit;
            display: flex;
        }
        .generate-button {
            --generate-button-star-1-opacity: 0.25;
            --generate-button-star-1-scale: 1;
            --generate-button-star-2-opacity: 1;
            --generate-button-star-2-scale: 1;
            --generate-button-star-3-opacity: 0.5;
            --generate-button-star-3-scale: 1;
            --generate-button-dots-opacity: 0;
            appearance: none;
            outline: none;
            border: none;
            padding: 14px 24px 14px 20px;
            border-radius: 29px;
            margin: 0;
            background-color: var(--clr-button-bg);
            color: var(--clr-text);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            z-index: 1;
            transform: scale(var(--generate-button-scale, 1)) translateZ(0);
            box-shadow: 0px 0px 120px var(--generate-button-shadow-wide, transparent),
            0px 4px 12px rgba(0, 0, 0, 0.05), 0px 1px 2px rgba(0, 0, 0, 0.1),
            inset 0px 1px 1px
            var(--generate-button-shadow-inset, rgba(255, 255, 255, 0.04)),
            0 0 0 var(--generate-button-shadow-outline, 0px)
            rgba(var(--clr-button), 0.4);
            transition: transform 0.3s, background-color 0.3s, box-shadow 0.3s, color 0.3s;
        }
        .generate-button:before {
            content: "";
            display: block;
            position: absolute;
            right: 20%;
            height: 20px;
            left: 20%;
            bottom: -10px;
            background: rgba(204, 204, 204, 0.4);
            filter: blur(12.5px);
            z-index: 2;
            clip-path: inset(-200% -30% 10px -30% round 29px);
            opacity: 0;
            transition: opacity 0.4s;
            transform: translateZ(0);
        }
        .generate-button span {
            position: relative;
            z-index: 1;
            font-family: "Poppins", Arial;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.005em;
            display: block;
            user-select: none;
        }
        .generate-button .stroke {
            mix-blend-mode: hard-light;
        }
        .generate-button .stroke svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            fill: none;
            stroke-width: 0.75px;
            stroke: #e2d9ff;
            stroke-dasharray: 1.5 14;
            stroke-dashoffset: 22;
            opacity: 0;
        }
        .generate-button .stroke svg:nth-child(2) {
            stroke-width: 1px;
            stroke-opacity: 0.5;
            filter: blur(3px);
        }

        .generate-button svg.icon {
            width: 18px;
            height: 20px;
            margin-right: 10px;
            fill: currentColor;
        }
        .generate-button svg.icon path:nth-child(1) {
            opacity: var(--generate-button-star-1-opacity);
            transform: scale(var(--generate-button-star-1-scale)) translateZ(0);
            transform-origin: 25% 14.58%;
        }
        .generate-button svg.icon path:nth-child(2) {
            opacity: var(--generate-button-star-2-opacity);
            transform: scale(var(--generate-button-star-2-scale)) translateZ(0);
            transform-origin: 60.42% 50%;
        }
        .generate-button svg.icon path:nth-child(3) {
            opacity: var(--generate-button-star-3-opacity);
            transform: scale(var(--generate-button-star-3-scale)) translateZ(0);
            transform-origin: 25% 85.42%;
        }
        .generate-button:hover {
            --generate-button-scale: 1.01;
            --generate-button-shadow-wide: rgba(var(--clr-button), 0.4);
            --generate-button-shadow-inset: rgba(255, 255, 255, 0.35);
            --generate-button-shadow-outline: 3px;
            color: var(--clr-text);
            background-color: rgba(var(--clr-button));
        }
        .generate-button:hover .stroke svg {
            animation: stroke 2s linear infinite;
        }
        .generate-button:hover:before {
            opacity: 1;
        }
        .generate-button:hover span:before {
            opacity: 0;
        }
        .generate-button:hover:active {
            --generate-button-scale: 1.05;
        }
        @keyframes stroke {
            0% {
                opacity: 0;
            }
            25%,
            75% {
                opacity: 1;
            }
            95%,
            100% {
                stroke-dashoffset: 6;
                opacity: 0;
            }
        }

    </style>
    <style>
        .weight-helper-txt {
            font-size: 10px;
        }

        .select2-container--bootstrap-5 .select2-selection--single {
            border-radius: unset !important;
        }

        .form-select {
            border-radius: 0.375rem !important;
        }
    </style>
    <style>
        :focus-visible {
            outline: unset;
        }

        .section_cal label {
            background: #e3e3e3;
            width: 100%;
            padding: 5px;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .section_cal .input-group-text {
            background: #f2f2f2 !important;
            border: 0px;
            border-radius: 0px;
            height: 50px;


        }

        .section_cal select,
        .section_cal input {
            background-color: #f2f2f2;
            border: 0px;
            border-radius: 0px;
            height: 50px;
        }

        .fa-xmark {
            color: #999999;
            border: 1px solid #999999;
            border-radius: 50%;
            padding: 8px;
            cursor: pointer;
        }

        #unit {
            width: 20%;
        }

        .nother-package {
            text-decoration: none;
            font-weight: bold;
            color: #32b5d8;
            margin-top: 10px;
        }

        .nother-package:hover {
            color: #df3a27;
        }
        .repeater .data-repeater-item:not(:first-child) label {
            display: none !important;
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
                <li class="breadcrumb-item active">{{__('Order Details')}}</li>
                <!-- Basic table -->


                <!--/ Basic table -->
            </ol>
        </nav>
        <div class="container-fluid">

            <div class="container">
                <!-- Title -->
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #ES{{$package->order_no}}</h2>
                    <h2 class="h5 mb-0"><a href="{{route('users.edit',$package->user_id)}}" class="text-muted">User: {{$package->user->name}}</a> </h2>

                </div>

                <!-- Main content -->
                <div class="row address">
                     <div class="col-lg-8">
                        <div class="address ">
                            <form action="javascript:void(0)" id="from_package_details" name="from_package_details">
                                @csrf
                                <div class="card">

                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <h5 class="fw-bold mb-4">
                                                                    {{ __('Why Are You Sending This Shipment?') }}</h5>
                                                                <p class="text-muted lh-lg mb-4">
                                                                    {{ __('Please provide the reason you will be sending your package') }}
                                                                </p>

                                                                <div>
                                                                    <div class="from-group">
                                                                        <select class="form-select address-select"
                                                                                id="reason_sending" name="reason_sending">
                                                                            <option value=""
                                                                                {{ $package->reason_sending == null ? 'selected' : '' }}>
                                                                                {{ __('Select a reason') }}</option>
                                                                            <option value="1"
                                                                                {{ $package->reason_sending == 1 ? 'selected' : '' }}>
                                                                                {{ __('It is a gift') }}</option>
                                                                            <option value="2"
                                                                                {{ $package->reason_sending == 2 ? 'selected' : '' }}>
                                                                                {{ __('I sold this') }}</option>
                                                                            <option value="3"
                                                                                {{ $package->reason_sending == 3 ? 'selected' : '' }}>
                                                                                {{ __('These are documents') }}</option>
                                                                            <option value="4"
                                                                                {{ $package->reason_sending == 4 ? 'selected' : '' }}>
                                                                                {{ __('This needs to be repaired') }}
                                                                            </option>
                                                                            <option value="5"
                                                                                {{ $package->reason_sending == 5 ? 'selected' : '' }}>
                                                                                {{ __('These are samples') }}</option>
                                                                            <option value="6"
                                                                                {{ $package->reason_sending == 6 ? 'selected' : '' }}>
                                                                                {{ __('Personal not for sell') }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="box">
                                                                    <h4 class="fw-bold mb-4">
                                                                        {{ __("What's in the Box?") }}</h4>
                                                                    <p class="text-muted lh-lg mb-4">
                                                                        {{ __('Provide a description and value for each unique item in your box to reduce the risk of customs delays or rejection.') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-4" id="add_item_btn"
                                                                 style="display: none">
                                                                <button type="button" class="btn btn-success"
                                                                        data-bs-toggle="modal" data-bs-target="#newItem">
                                                                    Add New Item
                                                                </button>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="table-responsive">
                                                                    <table class="table" id="package_items">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Description</th>
                                                                            <th>Quantity</th>
                                                                            <th>Price </th>
                                                                            <th>made in </th>
                                                                            <th>HS-Code</th>
                                                                            <th>status item</th>
                                                                            <th >Total</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <td colspan="9"
                                                                            class="text-center align-middle">
                                                                            <strong class="me-2"
                                                                                    style="font-size: 15px">{{ __('Please Add Item Press this button To ') }}</strong>
                                                                            <button type="button"
                                                                                    class="btn btn-success"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#newItem">
                                                                                Add New Item
                                                                            </button>
                                                                        </td>

                                                                        </tbody>
                                                                    </table>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="fw-bold mb-4">
                                                            Do You want add or edit,delete any package</h4>

                                                        <div class="col-md-12 section_cal">
                                                            <div class="row">
                                                                <div class="col-md-11" style="text-align: -webkit-right;">
                                                                    <div class="form-group">
                                                                        <select class="form-select" onchange="changeUnit()" id="unit"
                                                                                aria-label="Default select example">
                                                                            <option value="1" {{$package->packages[0]['unit_weight']==1?'selected':''}}>{{ __('lb/in') }}</option>
                                                                            <option value="2" {{$package->packages[0]['unit_dimension']==2?'selected':''}}>{{ __('kg/cm ') }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='repeater'>
                                                                <div data-repeater-list="packages">
                                                                    @foreach ($package->packages as $item)
                                                                        <div data-repeater-item>
                                                                            <input type="hidden" class="unit_weight_input" id="unit_weight" value="{{$package->packages[0]['unit_weight']}}" name="unit_weight"/>
                                                                            <input type="hidden" class="unit_dimension_input" id="unit_dimension" value="{{$package->packages[0]['unit_dimension']}}" name="unit_dimension"/>
                                                                            <div class="row mt-2 mb-0 ps-4" >
                                                                                <div class="col-12 col-md-5 p-0">
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-md-5 px-0">
                                                                                            <div class="form-group">
                                                                                                <label for="package-details__quantity-0">NO. of packages
                                                                                                    <span class="text-muted d-block">Max. 40</span></label>
                                                                                                <select class="form-select" name="qty"
                                                                                                        aria-label="Default select example">
                                                                                                    <option value="1" {{ $item['qty']==1?'selected':'' }}>1</option>
                                                                                                    <option value="2" {{ $item['qty']==2?'selected':'' }}>2</option>
                                                                                                    <option value="3"{{ $item['qty']==3?'selected':'' }}>3</option>
                                                                                                    <option value="4"{{ $item['qty']==4?'selected':'' }}>4</option>
                                                                                                    <option value="5"{{ $item['qty']==5?'selected':'' }}>5</option>
                                                                                                    <option value="6"{{ $item['qty']==6?'selected':'' }}>6</option>
                                                                                                    <option value="7"{{ $item['qty']==7?'selected':'' }}>7</option>
                                                                                                    <option value="8"{{ $item['qty']==8?'selected':'' }}>8</option>
                                                                                                    <option value="9"{{ $item['qty']==9?'selected':'' }}>9</option>
                                                                                                    <option value="10"{{ $item['qty']==10?'selected':'' }}>10</option>
                                                                                                    <option value="11"{{ $item['qty']==11?'selected':'' }}>11</option>
                                                                                                    <option value="12"{{ $item['qty']==12?'selected':'' }}>12</option>
                                                                                                    <option value="13"{{ $item['qty']==13?'selected':'' }}>13</option>
                                                                                                    <option value="14"{{ $item['qty']==14?'selected':'' }}>14</option>
                                                                                                    <option value="15"{{ $item['qty']==15?'selected':'' }}>15</option>
                                                                                                    <option value="16"{{ $item['qty']==16?'selected':'' }}>16</option>
                                                                                                    <option value="17"{{ $item['qty']==17?'selected':'' }}>17</option>
                                                                                                    <option value="18"{{ $item['qty']==18?'selected':'' }}>18</option>
                                                                                                    <option value="19"{{ $item['qty']==19?'selected':'' }}>19</option>
                                                                                                    <option value="20"{{ $item['qty']==20?'selected':'' }}>20</option>
                                                                                                    <option value="21"{{ $item['qty']==21?'selected':'' }}>21</option>
                                                                                                    <option value="22"{{ $item['qty']==22?'selected':'' }}>22</option>
                                                                                                    <option value="23"{{ $item['qty']==23?'selected':'' }}>23</option>
                                                                                                    <option value="24"{{ $item['qty']==24?'selected':'' }}>24</option>
                                                                                                    <option value="25"{{ $item['qty']==25?'selected':'' }}>25</option>
                                                                                                    <option value="26"{{ $item['qty']==26?'selected':'' }}>26</option>
                                                                                                    <option value="27"{{ $item['qty']==27?'selected':'' }}>27</option>
                                                                                                    <option value="28"{{ $item['qty']==28?'selected':'' }}>28</option>
                                                                                                    <option value="29"{{ $item['qty']==29?'selected':'' }}>29</option>
                                                                                                    <option value="30"{{ $item['qty']==30?'selected':'' }}>30</option>
                                                                                                    <option value="31"{{ $item['qty']==31?'selected':'' }}>31</option>
                                                                                                    <option value="32"{{ $item['qty']==32?'selected':'' }}>32</option>
                                                                                                    <option value="33"{{ $item['qty']==33?'selected':'' }}>33</option>
                                                                                                    <option value="34"{{ $item['qty']==34?'selected':'' }}>34</option>
                                                                                                    <option value="35"{{ $item['qty']==35?'selected':'' }}>35</option>
                                                                                                    <option value="36"{{ $item['qty']==36?'selected':'' }}>36</option>
                                                                                                    <option value="37"{{ $item['qty']==37?'selected':'' }}>37</option>
                                                                                                    <option value="38"{{ $item['qty']==38?'selected':'' }}>38</option>
                                                                                                    <option value="39"{{ $item['qty']==39?'selected':'' }}>39</option>
                                                                                                    <option value="40"{{ $item['qty']==40?'selected':'' }}>40</option>

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-7 px-1">
                                                                                            <div class="form-group">
                                                                                                <label for="package-details__weight-0">Weight per package
                                                                                                    <span class="text-muted d-block">Max. weight 150
                                                                        lb.</span></label>
                                                                                                <div class="input-group">
                                                                                                    <input type="text" class="form-control" required
                                                                                                           id="package-details__weight-0" max="150"
                                                                                                           name="weight" aria-required="true"
                                                                                                           maxlength="3" value="{{ $item['weight'] }}">
                                                                                                    <div class="input-group-append">
                                                                        <span
                                                                            class="input-group-text unit-weight">lb</span>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="package-details__ dimensions-0">Dimensions per package
                                                                                            <span class="text-muted d-block"> L × W × H (Optional)</span></label>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-4 col-md-4 pe-0">
                                                                                            <div class="form-group">
                                                                                                <div class="input-group">
                                                                                                    <input type="text" class="form-control"
                                                                                                           name="length" maxlength="3" value="{{$item['length']}}" required
                                                                                                           aria-label="Dimensions per package. Enter length."
                                                                                                           aria-describedby="package-details__dimensions-error-0">
                                                                                                    <span class="input-group-text ">x</span>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-4 p-0">
                                                                                            <div class="form-group">

                                                                                                <div class="input-group">
                                                                                                    <input type="text" class="form-control"
                                                                                                           name="width" maxlength="3" value="{{$item['width']}}" required
                                                                                                           aria-label="Dimensions per package. Enter width."
                                                                                                           aria-describedby="package-details__dimensions-error-0">
                                                                                                    <span class="input-group-text">x</span>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-4 ps-0">
                                                                                            <div class="form-group">

                                                                                                <div class="input-group">
                                                                                                    <input type="text" class="form-control"
                                                                                                           name="height" maxlength="3" value="{{$item['height']}}" required
                                                                                                           aria-label="Dimensions per package. Enter height."
                                                                                                           aria-describedby="package-details__dimensions-error-0">
                                                                                                    <span
                                                                                                        class="input-group-text unit-dimensions">in</span>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-12 col-md-1 pt-5 text-center">
                                                                                    <a data-repeater-delete class="text-danger delete-repeater"> <i
                                                                                            class="fa-solid fa-xmark"></i></a>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                                <div class="col-12">
                                                                    <!-- Add another package button -->
                                                                    <button data-repeater-create type="button"
                                                                            class="btn btn-link btn-sm nother-package">
                                                                        <span class="font-weight-bold pr-1">+</span> ADD A NOTHER PACKAGE
                                                                    </button>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-12">

                                                <h4 class="fs-3 fw-bold my-4">{{ __('Want to Protect Your Delivery?') }}
                                                </h4>

                                                <div class="radio custom">

                                                    <div class="rdio rdio-primary radio-inline">
                                                        <input name="protection" value="3" class="radio-check"
                                                               id="protection_basic" type="radio"
                                                            {{ $package->cost_protection == 3 ? 'checked' : '' }}>
                                                        <label
                                                            for="protection_basic">{{ __('No insurance, Shipment will be covered up to $100.') }}
                                                            <div class="d-inline-block position-relative">
                                                                <i class="fa-solid fa-circle-info text-primary"
                                                                   onclick="show_block(this)"></i>
                                                                <div class="address-box toolContent toolNormallprotection">
                                                                    <i class="fa-solid fa-xmark close-icon"
                                                                       onclick="hide_block(this)"></i>
                                                                    <p class="text-muted">{{ __('EarthShip Protect') }}
                                                                    </p>
                                                                    <ul>
                                                                        <li>{{ __('Protects you if your package is lost, up to time of delivery.') }}
                                                                        </li>
                                                                        <li>{{ __('Does not cover damage to your shipment. A new cardboard box is required to protect your items for shipping, and can be purchased at your local drop-off location.') }}
                                                                        </li>
                                                                        <li>{{ __('Does not cover shipments containing restricted or prohibited items.') }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </label>

                                                    </div>
                                                    <div class="rdio rdio-primary radio-inline">
                                                        <input name="protection" class="radio-check" id="protection_max"
                                                               type="radio" {{ $package->cost_protection > 3 ? 'checked' : '' }}>
                                                        <label
                                                            for="protection_max">{{ __('Add up to Total Box Value of delivery protection for 3%') }}
                                                            <div class="d-inline-block position-relative">
                                                                <i class="fa-solid fa-circle-info text-primary"
                                                                   onclick="show_block(this)"></i>
                                                                <div class="address-box toolContent toolprotection">
                                                                    <i class="fa-solid fa-xmark close-icon"
                                                                       onclick="hide_block(this)"></i>
                                                                    <p class="text-muted">{{ __('EarthShip Protect') }}
                                                                    </p>
                                                                    <ul>
                                                                        <li>{{ __('Protects you if your package is lost, up to time of delivery.') }}
                                                                        </li>
                                                                        <li>{{ __('Does not cover damage to your shipment. A new cardboard box is required to protect your items for shipping, and can be purchased at your local drop-off location.') }}
                                                                        </li>
                                                                        <li>{{ __('Does not cover shipments containing restricted or prohibited items.') }}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </label>

                                                    </div>
                                                    <div class="row" id="div_insurance"
                                                         style="{{ $package->full_cost_protection > 100 ? 'display:flex' : 'display:none' }} ">
                                                        <div class="col-md-3">
                                                            <label for="protection_value"
                                                                   class="form-label">{{ __('Insurance Value Up To :') }}
                                                                <span
                                                                    id="insurance_limit">${{ $package->total_cost_items }}</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-transparent color-main"
                                                                      id="us-zip-code">
                                                                    <i class="fa fa-dollar-sign"></i>
                                                                </span>
                                                                <input type="number" id="protection_value"
                                                                       name="protection_value"
                                                                       value="{{ $package->full_cost_protection > 100 ? $package->full_cost_protection : '' }}"
                                                                       class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="protection_pay_value"
                                                                   class="form-label">{{ __('The value that must be paid') }}
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text bg-transparent color-main"
                                                                      id="us-zip-code">
                                                                    <i class="fa fa-dollar-sign"></i>
                                                                </span>
                                                                <input type="number" id="protection_pay_value"
                                                                       value="{{ $package->full_cost_protection > 100 ? $package->cost_protection : '' }}"
                                                                       disabled name="protection_pay_value"
                                                                       class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    {{--                                    <div class="btn-group-step   mt-4"> --}}
                                    {{--                                        <a class="btn btn-main btn-back btn-danger" href="{{route('address-details-to')}}">{{__('Back')}}</a> --}}
                                    {{--                                        <button class="btn btn-main btn-continue btn-success" >{{__('Continue')}}</button> --}}

                                </div>
                                <div class="btn-group-step   mt-4 ">
                                    <a class="btn btn-main btn-back btn-danger"
                                       href="{{route('orders.index',$status)}}">{{ __('Back') }}</a>
                                    <button class="btn btn-main btn-continue btn-success">{{ __('Continue') }}</button>
                                </div>
                                <div class="modal fade" id="newItem" tabindex="-1" role="dialog"
                                     aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content modal-video">
                                            <div class="modal-header text-center" style="border-bottom: 0px;">
                                                <div class="row" style="width: 100%;">
                                                    <div class="col-12 text-center">
                                                        <h4 class="modal-title text-center fw-bold" id="myModalLabel">
                                                            {{ __("What's in the Box?") }}</h4>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>

                                            </div>
                                            <div class="modal-body  ">
                                                {{--                                            <h2 class="text-center mb-5"></h2> --}}
                                                <div class="col-md-12">
                                                    <fieldset class="itemForm">
                                                        <div class="row">
                                                            <div class="col-3 mb-md-2 mb-2">
                                                                <div class="form-group  ">
                                                                    <label for="desc1"
                                                                           class="form-label position-relative">

                                                                        {{ __('Item Description') }}

                                                                        <i class="fa-solid fa-circle-info text-primary"
                                                                           onclick="show_block(this)"></i>
                                                                        <div class="address-box toolContent toolDesc">
                                                                            <i class="fa-solid fa-xmark close-icon"
                                                                               onclick="hide_block(this)"></i>
                                                                            <p class="text-muted">
                                                                                {{ __('List each item separately, describing the item in a few words, including material (e.g. cotton, gold, etc.) and other details. For example:') }}
                                                                            </p>
                                                                            <ul>
                                                                                <li>{{ __('Blouse, rayon, women’s') }}</li>
                                                                                <li>{{ __('Pitcher, ceramic, antique') }}
                                                                                </li>
                                                                                <li>{{ __('Hand tool set, metal and plastic, new') }}
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                           name="item_description" id="desc"
                                                                           placeholder="E.g. Name Or Description">
                                                                </div>

                                                            </div>
                                                            <div class="col-3   mb-md-2 mb-2">
                                                                <div class="form-group ">
                                                                    <label for="package_dif"
                                                                           class="form-label position-relative">

                                                                        {{ __('Select Package') }}
                                                                        {{--                                        <i class="fa-solid fa-circle-info text-primary" ></i> --}}
                                                                        {{--                                        <div class="address-box toolContent toolDesc"> --}}
                                                                        {{--                                            <i class="fa-solid fa-xmark close-icon" onclick="hide_block_toolDesc()"></i> --}}
                                                                        {{--                                            <p class="text-muted">{{__('List each item separately, describing the item in a few words, including material (e.g. cotton, gold, etc.) and other details. For example:')}}</p> --}}
                                                                        {{--                                            <ul> --}}
                                                                        {{--                                                <li>{{__("Blouse, rayon, women’s")}}</li> --}}
                                                                        {{--                                                <li>{{__('Pitcher, ceramic, antique')}}</li> --}}
                                                                        {{--                                                <li>{{__('Hand tool set, metal and plastic, new')}}</li> --}}
                                                                        {{--                                            </ul> --}}
                                                                        {{--                                        </div> --}}
                                                                    </label>
                                                                    <select class="form-select form-control"
                                                                            name="package_dif" id="package_dif">
                                                                        <option value="">{{ __('Select Package') }}
                                                                        </option>
                                                                        @if (count($package->packages) > 0)
                                                                            @foreach ($package->packages as $item)
                                                                                <option value="{{ $item['id'] }}">
                                                                                    {{ $item['weight'] . ' lbs (' . $item['length'] . ' in x' . $item['width'] . ' in x' . $item['height'] . ' in )' }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif


                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-2   mb-2">
                                                                <div class="form-group">
                                                                    <label for="quantity1"
                                                                           class="form-label">{{ __('Quantity') }}</label>
                                                                    <input type="number" onchange="updatesum()"
                                                                           name="item_quantity" class="form-control"
                                                                           id="quantity" placeholder="0">
                                                                </div>
                                                            </div>
                                                            <div class="col-2   mb-2">
                                                                <div class="form-group">
                                                                    <label for="each1"
                                                                           class="form-label fd-6 position-relative">

                                                                        {{ __('Price') }}
                                                                        <i class="fa-solid fa-circle-info text-primary"
                                                                           onclick="show_block(this)"></i>
                                                                        <div class="address-box toolContent toolEach">
                                                                            <i class="fa-solid fa-xmark close-icon"
                                                                               onclick="hide_block(this)"></i>
                                                                            <p class="text-muted">
                                                                                {{ __('Be sure to provide accurate values for your item(s). Failure to do so can result in shipment delays or holds, and you may be fined or penalized.') }}
                                                                            </p>

                                                                        </div>
                                                                    </label>
                                                                    <input type="number" class="form-control"
                                                                           onchange="updatesum()" name="item_value"
                                                                           id="each" placeholder="$ 0">
                                                                </div>
                                                            </div>
                                                            <div class="col-3   mb-2">
                                                                <div class="form-group">
                                                                    <label for="country_made1"
                                                                           class="form-label position-relative">

                                                                        {{ __('Where was this made?') }}
                                                                        <i class="fa-solid fa-circle-info text-primary"
                                                                           onclick="show_block(this)"></i>
                                                                        <div class="address-box toolContent toolCountry">
                                                                            <p class="text-muted">
                                                                                {{ __('Provide the country that the item was assembled or manufactured in.') }}
                                                                            </p>
                                                                            <i class="fa-solid fa-xmark close-icon"
                                                                               onclick="hide_block(this)"></i>

                                                                        </div>
                                                                    </label>
                                                                    <select class="form-select form-control"
                                                                            name="item_country_made" id="country_made">
                                                                        <option value="">{{ __('Select Country') }}
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-3   mb-2">
                                                                <div class="form-group">
                                                                    <label for="hs_code1"
                                                                           class="form-label position-relative">

                                                                        {{ __('HS-Code(Optional)') }}
                                                                        <i class="fa-solid fa-circle-info text-primary"
                                                                           onclick="show_block(this)"></i>
                                                                        <div class="address-box toolContent toolHSCode">
                                                                            <p class="text-muted">
                                                                                {{ __('Provide the country that the item was assembled or manufactured in.') }}
                                                                                <a href="{{ env('SITE_URL'.'/hs_code') }}"
                                                                                   target="_blank">{{ __('HS Code') }}</a>
                                                                            </p>
                                                                            <i class="fa-solid fa-xmark close-icon"
                                                                               onclick="hide_block(this)"></i>

                                                                        </div>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                           name="hs_code" id="hs_code"
                                                                           placeholder="HS-Code">
                                                                </div>

                                                            </div>
                                                            <div class="col-2   mb-2">
                                                                <div class="form-group">
                                                                    <label for="condition_item1"
                                                                           class="form-label position-relative">

                                                                        <div class="address-box toolContent toolCondition">
                                                                            <i class="fa-solid fa-xmark close-icon"
                                                                               onclick="hide_block(this)"></i>
                                                                            <p class="text-muted">
                                                                                {{ __('Provide the condition of the item. This information helps our team accurately verify the contents of your package upon arrival at our facility.') }}
                                                                            </p>
                                                                            <ul>
                                                                                <li><strong>{{ __('New:') }}
                                                                                    </strong>{{ __('Brand new, unused, and free of damage') }}
                                                                                </li>
                                                                                <li><strong>{{ __('Used:') }}
                                                                                    </strong>{{ __('Previously used or worn and possibly damaged') }}
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        {{ __('Condition of Item') }}
                                                                        <i class="fa-solid fa-circle-info text-primary"
                                                                           onclick="show_block(this)"></i>
                                                                    </label>
                                                                    <select class="form-select form-control"
                                                                            name="item_condition" id="condition_item">
                                                                        <option value="">{{ __('Select Option') }}
                                                                        </option>
                                                                        <option value="1">{{ __('New') }}
                                                                        </option>
                                                                        <option value="2">{{ __('Used') }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 mb-2">
                                                                <div class="form-group">
                                                                    <label for="total"
                                                                           class="form-label">{{ __('Total Value') }}</label>
                                                                    <input type="hidden" name="item_total"
                                                                           id="item_total">
                                                                    <div
                                                                        class="form-control border-0 bg-transparent color-main">
                                                                        $ <span id="total">0</span></div>
                                                                </div>

                                                            </div>
                                                            <div class="text-center my-4">
                                                                <button type="button"
                                                                        class="btn btn-main-add btn-success"
                                                                        id="submitBtn">{{ __('Add This Item') }}</button>
                                                                <button type="button" class="btn btn-main btn-danger"
                                                                        onclick="hide_block_itemForm()" id="closeBtn"
                                                                        style="display: none">{{ __('Close') }}</button>
                                                            </div>
                                                        </div>

                                                    </fieldset>
                                                </div>
                                                <div class="col-md-12">
                                                    <div
                                                        class="classifyDiv py-4 mx-auto d-flex flex-column flex-md-row align-items-center justify-content-center border-top border-bottom">

                                                        <div class="position-relative ">
                                                            <i class="fa-solid fa-circle-info text-primary"
                                                               onclick="show_block(this)"></i>
                                                            {{ __('Review the List of') }} <a
                                                                href="{{ route('shipping-restrictions') }}"
                                                                target="_blank"
                                                                class="link">{{ __('Restricted & Prohibited Items') }}</a>
                                                            <div class="address-box toolContent toolProhibited">
                                                                <i class="fa-solid fa-xmark close-icon"
                                                                   onclick="hide_block(this)"></i>
                                                                <p class="text-muted">
                                                                    {{ __('List each item separately, describing the item in a few words, including material (e.g. cotton, gold, etc.) and other details. For example:') }}
                                                                </p>
                                                                <ul>
                                                                    <li>{{ __('Blouse, rayon, women’s') }}</li>
                                                                    <li>{{ __('Pitcher, ceramic, antique') }}</li>
                                                                    <li>{{ __('Hand tool set, metal and plastic, new') }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table" id="package_items">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Description</th>
                                                                <th>Quantity</th>
                                                                <th>Price </th>
                                                                <th>made in </th>
                                                                <th>HS-Code</th>
                                                                <th>status item</th>
                                                                <th >Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <td colspan="9"
                                                                class="text-center align-middle">
                                                                <strong class="me-2"
                                                                        style="font-size: 15px">{{ __('Please Add Item') }}</strong>

                                                            </td>

                                                            </tbody>
                                                        </table>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>


                    </div>
                    <div class="col-lg-4">
                        <!-- Customer Notes -->
                        @if(isset($package->tracking['events']))
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="h6">{{__('Estimated Delivery Date')}}</h3>
                                    <p class="delivery-day">{{date('l', strtotime($package->tracking['estimated_delivery_date'])) }}</p>
                                    <h4 class="delivery-month">{{date('F', strtotime($package->tracking['estimated_delivery_date'])) }}</h4>
                                    <h4 class="delivery-day-no">{{date('j', strtotime($package->tracking['estimated_delivery_date'])) }}</h4>                            </div>
                            </div>
                            <div class="card mb-4">
                                <!-- Shipping information -->
                                <div class="card-body">
                                    <h3 class="h6">Shipping Information</h3>
                                    <strong>{{$package->shipping_method}}</strong>
                                    <p>
                                        @if($package->tracking['status_code']=='AC')
                                            {{__('Accepted')}}
                                        @elseif($package->tracking['status_code']=='IT')
                                            {{__('In Transit')}}
                                        @elseif($package->tracking['status_code']=='DE')
                                            {{__('Delivered')}}
                                        @elseif($package->tracking['status_code']=='EX')
                                            {{__('Exception')}}
                                        @elseif($package->tracking['status_code']=='UN')
                                            {{__('Unknown')}}
                                        @elseif($package->tracking['status_code']=='AT')
                                            {{__('Delivery Attempt')}}
                                        @elseif($package->tracking['status_code']=='NY')
                                            {{__('Not Yet In System')}}
                                        @else
                                            {{__('Unknown')}}
                                        @endif
                                    </p>
                                    @if($package->status==1|| $package->status==4)
                                        <p class="track_number">{{__('Tracking:')}} <a href="https://www.fedex.com/fedextrack/?action=track&trackingnumber={{$package->tracking_number}}" class="link">{{$package->tracking_number}}</a></p>

                                    @else
                                        @if($package->shipping_company=='FEDEX')
                                            <p class="track_number">{{__('Tracking:')}} <a href="https://www.fedex.com/fedextrack/?action=track&trackingnumber={{$package->tracking_number}}" class="link">{{$package->tracking_number}}</a></p>

                                        @elseif($package->shipping_company=='UPS')
                                            <p class="track_number">{{__('Tracking:')}} <a href="https://wwwapps.ups.com/WebTracking/track?track=yes&trackNums={{$package->tracking_number}}&loc=en_us&requester=ST/trackdetails" class="link">{{$package->tracking_number}}</a></p>


                                        @elseif($package->shipping_company=='DHL')
                                            <p class="track_number">{{__('Tracking:')}} <a href="https://www.dhl.com/global-en/home/tracking/tracking-express.html?submit=1&tracking-id={{$package->tracking_number}}" class="link">{{$package->tracking_number}}</a></p>

                                        @endif
                                    @endif

                                </div>
                            </div>
                        @endif
                        <div class="card mb-4">
                            <!-- Shipping information -->
                            <div class="card-body">
                                <h3 class="h6">Address To</h3>
                                <address>
                                    <ul class="list-unstyled text-muted">
                                        <li class="mb-2">{{$package->address_going->full_name}}</li>
                                        <li class="mb-2">{{$package->address_going->address_1}}</li>
                                        <li class="mb-2">{{$package->address_going->city.','.$package->address_going->state_province_region.','.$package->address_going->postal_code}}</li>
                                        <li class="mb-2">{{$package->address_going->full_country?$package->address_going->full_country->Country:$package->address_going->country}}</li>
                                        <li class="mb-2">{{$package->address_going->full_phone}} </li>
                                        <li class="mb-2">{{$package->address_going->email}}</li>
                                        <li class="mb-2">
                                            <a href="{{route('orders.edit-address',[$status,$package->id,$package->to_address_id])}}" class="btn btn-warning">edit</a>
                                        </li>
                                    </ul>
                                </address>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <!-- Shipping information -->
                            <div class="card-body">
                                <h3 class="h6">Address From</h3>
                                <address>
                                    <ul class="list-unstyled text-muted">
                                        <li class="mb-2">{{$package->address_from->full_name}}</li>
                                        <li class="mb-2">{{$package->address_from->address_1}}</li>
                                        <li class="mb-2">{{$package->address_from->city.','.$package->address_from->state_province_region.','.$package->address_from->postal_code}}</li>
                                        <li class="mb-2">{{$package->address_from->full_country?$package->address_from->full_country->Country:$package->address_from->country}}</li>
                                        <li class="mb-2">{{$package->address_from->full_phone}}</li>
                                        <li class="mb-2">{{$package->address_from->email}}</li>
                                        <li class="mb-2">
                                            <a href="{{route('orders.edit-address',[$status,$package->id,$package->from_address_id])}}" class="btn btn-warning">edit</a>
                                        </li>
                                    </ul>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" ></script>--}}


    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/assets/js/app-user-view-security.js')}}"></script>--}}
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
<script>
    $(document).ready(function() {
        'use strict';
        window.id = 0;
        $('.repeater').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            initEmpty: false,
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            defaultValues: {
                'id': window.id,
            },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            show: function() {
                $(this).slideDown();
                var inputElement = $(this);
                var row = inputElement.closest('[data-repeater-item]');
                console.log(row)
                var index = row.index('[data-repeater-item]');

                $('[name="packages[' + index + '][unit_weight]"]').val($('[name="packages[0][unit_weight]"]').val()); // Set the value you want for unit_weight
                $('[name="packages[' + index + '][unit_dimension]"]').val($('[name="packages[0][unit_dimension]"]').val()); // Set the value you want for unit_dimension
                $('[name="packages[' + index + '][qty]"]').val(1); // Set the value you want for unit_dimension



                $('#cat-id').val(window.id);
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    window.id--;
                    $('#cat-id').val(window.id);

                    $(this).slideUp(deleteElement);
                    console.log($('.repeater').repeaterVal());
                }
            },
            // (Optional)
            // You can use this if you need to manually re-index the list
            // for example if you are using a drag and drop library to reorder
            // list items.
            ready: function(setIndexes) {},
            // (Optional)
            // Removes the delete button from the first list item,
            // defaults to false.
            isFirstItemUndeletable: true
        })
    });
</script>
<script>
    function changeUnit() {
        var unitSelect = document.getElementById('unit');
        var unitWeights = document.querySelectorAll('.unit-weight');
        var unitWeightsInputs = document.querySelectorAll('.unit_weight_input');
        var unitDimensions = document.querySelectorAll('.unit-dimensions');
        var unitDimensionsInputs = document.querySelectorAll('.unit_dimension_input');

        if (unitSelect.value === '1') {
            unitWeights.forEach(function(element) {
                element.textContent = 'lb';

            });
            unitWeightsInputs.forEach(function(element) {
                element.value  = '1';

            });

            // Loop through and update the text content for unit-dimensions elements
            unitDimensions.forEach(function(element) {
                element.textContent = 'in';

            });
            unitDimensionsInputs.forEach(function(element) {
                element.value  = '1';

            });

            // You can change classes here if needed
            // Example: unitText.classList.remove('some-class');
        } else if (unitSelect.value === '2') {
            unitWeights.forEach(function(element) {
                element.textContent = 'kg';
            });
            unitWeightsInputs.forEach(function(element) {
                element.value  = '2';
            });

            // Loop through and update the text content for unit-dimensions elements
            unitDimensions.forEach(function(element) {
                element.textContent = 'cm';
            });
            unitDimensionsInputs.forEach(function(element) {
                element.value  = '2';

            });
            // You can change classes here if needed
            // Example: unitText.classList.add('some-class');
        }
    }
</script>

<script>
    $(".rdio-primary input[type='radio']").on("change", function() {
        var test = $(this).val();
        // Regardless of WHICH radio was clicked, is the
        //  showSelect radio active?
        if (test == 3) {
            $('#div_insurance').hide()
        } else {
            var total = $('#item_total').val();
            $('#insurance_limit').text('$' + total);
            $('#insurance_limit').text('$' + total);
            if(total > 101){
                $("#protection_value").attr({
                    "max": total,
                    "min": 101
                })
                $('#div_insurance').show()

            }else{
                $("#protection_basic").prop("checked", true);
                swal.fire("Warning!", "The Total Items must be greater than 100", "warning");

                // $("#protection_value").attr({
                //     // "max": 101,
                //     "min": 101
                // })
                // $("#protection_value").val("101");
                // $('#div_insurance').show()
            }

        }
    })

    function checkChange($this) {
        var value = $this.val();

        var sv = $this.data("stored");

        if (value != sv)
            $this.trigger("simpleChange");

    }
    $(document).ready(function() {
        $(this).data("stored", $(this).val());
        $("#protection_value").bind("keyup mouseup keypress change mouseout", function(e) {
            checkChange($(this));
        });


        $("#protection_value").bind("simpleChange", function(e) {
            $('#protection_pay_value').val(Math.ceil($(this).val() * 0.03));
        });

    });
</script>
{{--    valdation --}}
<script>
    $(function() {
        function getWordCount(wordString) {
            var words = wordString.split(" ");
            words = words.filter(function(words) {
                return words.length > 0
            }).length;
            return words;
        }

        jQuery.validator.setDefaults({
            // where to display the error relative to the element
            errorPlacement: function(error, element) {
                if (element.parent().hasClass('input-group')) {
                    error.insertAfter(element.parent());
                } else if (element.parent().hasClass('form-group')) {
                    error.insertAfter(element.parent());
                } else if (element.parent()) {
                    error.insertAfter(element.parent().parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $("form[name='from_package_details']").validate({
            // Specify validation rules
            rules: {

                reason_sending: "required",
                item_description: {
                    required: true,
                    maxlength: 30,
                    wordCount: ['5'],
                    // lettersonlys:true
                },

                protection: "required",
                package_dif: "required",
                item_quantity: {
                    required: true,
                    number: true,
                },
                item_value: {
                    required: true,
                    number: true,
                },
                item_country_made: "required",
                item_condition: "required",

            },
            highlight: function(element) {
                // console.log($(element).parent());
                if ($(element).parent().hasClass('input-group')) {
                    $(element).parent().addClass('has-error');
                } else if ($(element).parent().hasClass('form-group')) {
                    $(element).parent().addClass('has-error');
                } else {
                    $(element).parent().addClass('has-error');
                }

            },
            unhighlight: function(element) {
                // console.log(element)
                if ($(element).parent().hasClass('input-group')) {
                    $(element).parent().removeClass('has-error');
                } else if ($(element).parent().hasClass('form-group')) {
                    // console.log($(element).parent())
                    $(element).parent().removeClass('has-error');
                    // $(element).parents().removeClass('has-error');
                } else {
                    $(element).parents().removeClass('has-error');
                }

            },
            // Specify validation error messages
            messages: {
                card_holder_name: "Please enter your card holder name",
                billing_address: "Please select or enter your billing address",
                full_name: "Please enter your full_name",
                email: "Please enter your email",
                phone: "Please enter your phone",
                country: "Please enter your country",
                city: "Please enter your city",
                address_1: {
                    required: "Please enter your address 1",
                    maxlength: "Can't exceed 25 characters",
                },
                state_province_region: "Please enter your state province region",
                postal_code: "Please enter your Postal Code (Zip Code)",
                full_name_edit: "Please enter your full_name",
                email_edit: "Please enter your email",
                phone_edit: "Please enter your phone",
                country_edit: "Please enter your country",
                city_edit: "Please enter your city",
                address_1_edit: "Please enter your address 1",
                state_province_region_edit: "Please enter your state province region",
                postal_code_edit: "Please enter your Postal Code (Zip Code)",

            },

            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
        jQuery.validator.addMethod("lettersonlys", function(value, element) {
            return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
        }, "Only English characters");
        //add the custom validation method
        jQuery.validator.addMethod("wordCount",
            function(value, element, params) {
                var count = getWordCount(value);
                if (count <= params[0]) {
                    return true;
                }
            },
            jQuery.validator.format("A maximum of {0} words is required here.")
        );
        jQuery.validator.addMethod("us_code", function(value, element) {
            return /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(value);
        }, "Please specify a valid US zip code.");
    });
</script>

<script>
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap5',
        minDate: today,
        modal: true,
        footer: true,
        maxDate: function() {
            var date = new Date();
            date.setDate(date.getDate() + 5);
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
        }
    });
</script>

{{--    select 2 --}}
<script>
    var isoCountries = [
            @foreach ($countries as $country)
        {
            id: '{{ $country->ISO }}',
            text: '{{ $country->Country }}'
        },
        @endforeach
    ];

    function formatCountry(country) {
        if (!country.id) {
            return country.text;
        }
        var $country = $(
            '<span class="fi fi-' + country.id.toLowerCase() + ' fis"></span>' +
            '<span class="flag-text">' + country.text + "</span>"
        );
        return $country;
    };
    $("#country_made").select2({
        placeholder: "Select a country",
        templateResult: formatCountry,
        theme: 'bootstrap-5',
        data: isoCountries
    });
    $('#country_made').val('US').trigger('change')
</script>
<script>
    $(function() {
        $("#datepicker").datepicker({
            // buttonText: '<i class="fa fa-calendar"></i>',
            // closeText: "Close",
            // defaultDate: +7,
            // currentText: "Now",
            showOn: 'both',
            buttonImageOnly: true,
            buttonImage: '{{ asset('assets/images/calendar.webp') }}',
            hideIfNoPrevNext: true,
            minDate: new Date(),
            maxDate: "+5d"
        });
    });
</script>
<script>
    function show_block(iconElement) {

        // Find the parent label element
        var labelElement = $(iconElement).closest('label, div');

        // Find the next div element within the same label
        var nextDiv = labelElement.find('div');
        console.log(labelElement);
        console.log(nextDiv);

        // Show the next div
        nextDiv.slideToggle();
    }

    function hide_block(closeIcon) {
        // Find the parent div element
        var divElement = $(closeIcon).closest('div');

        // Hide the div
        divElement.slideUp();
    }
</script>
<script>
    // start address page step two
    function updatesum() {
        var final_sum = quantityInput.value * eachInput.value;
        $('#total').text(final_sum)
        $('#item_total').val(final_sum)
    }

    let descInput = document.querySelector("#desc");
    let quantityInput = document.querySelector("#quantity");
    let eachInput = document.querySelector("#each");
    let hsCodeInput = document.querySelector("#hs_code");
    let countryInput = document.querySelector("#country_made");
    let conditionInput = document.querySelector("#condition_item");
    let packageInput = document.querySelector("#package_dif");
    let totalDiv = document.querySelector("#total");
    let submitBtn = document.querySelector("#submitBtn");


    let listItems = [];

    // Check if Theres Items In Local Storage
    @if ($items != null)
    // if (localStorage.getItem("items")) {
    @foreach ($items as $item)
    const item<?php echo $item->id; ?> = {
        id: {{ $loop->index + 1 }},
        Item: '{{ $item->item }}',
        Country: '{{ $item->country }}',
        Quantity: {{ $item->quantity }},
        'HSCode': '{{ $item->hs_code }}',
        Description: '{{ $item->description }}',
        Package: '{{ $item->package_id }}',
        Condition: '{{ $item->condition }}',
        Each: {{ $item->value }},
        Total: {{ $item->total }},
    };

    // Add Item To Array Of Items
    listItems.push(item<?php echo $item->id; ?>);
    @endforeach
    window.localStorage.setItem("items", JSON.stringify(listItems));

    listItems = JSON.parse(localStorage.getItem("items"));

    //  Checking the Array Of Items It's Not Empty
    if (listItems.length) {
        // viewElementsAtPage(listItems);
        viewElementsAtSectionBox(listItems);
        calculateTotal(listItems);

        // hide_block_itemForm();
        // $('#add_item').removeAttr('disabled')
    }
    @endif
        submitBtn ? (submitBtn.onclick = addItemToArray) : null;

    function addItemToArray() {
        var validator = $("form[name='from_package_details']").validate();
        // validator.element( "#myselect" );
        if ($(
            'input[name="item_description"], input[name="item_quantity"], input[name="item_value"], select[name="item_country_made"],select[name="package_dif"], select[name="item_condition"]')
            .valid()
        ) {
            const item = {
                id: Date.now(),
                Item: descInput.value,
                Country: countryInput.value,
                Quantity: quantityInput.value,
                'HSCode': hsCodeInput.value,
                Description: descInput.value,
                Condition: conditionInput.value,
                Package: packageInput.value,
                Each: eachInput.value,
                Total: quantityInput.value * eachInput.value,
            };

            // Add Item To Array Of Items
            listItems.push(item);

            // Add Item To Box Content In The Page
            // viewElementsAtPage(listItems);

            // Add Item To Box Section In The Page
            viewElementsAtSectionBox(listItems);

            // Calculate Total
            calculateTotal(listItems);

            // Empty Input Field
            descInput.value = "";
            quantityInput.value = "";
            eachInput.value = "";
            // countryInput.value = "";
            hsCodeInput.value = "";
            conditionInput.value = "";
            packageInput.value = "";
            totalDiv.textContent = "0";

            // Hide Form

            $('#add_item').removeAttr('disabled')
            addDataToLocalStorage(listItems);
        } else {
            return false;
        }
    }



    function viewElementsAtSectionBox(listItems) {
        let boxSection = $("#package_items tbody");

        // Empty Box Section
        boxSection.html('');

        listItems.forEach((item, index) => {
            var new_item = '<tr>' +
                '<td class="text-center align-middle">' + index + 1 + '</td>' +
                '<td class="text-center align-middle">' + item["Item"] + '</td>' +
                // '<td class="text-center align-middle">'+item["Package"]+'</td>'+
                '<td class="text-center align-middle">' + item["Quantity"] + '</td>' +
                '<td class="text-center align-middle">' + item["Each"] + ' </td>' +
                '<td class="text-center align-middle">' + item["Country"] + '</td>' +
                '<td class="text-center align-middle">' + item["HSCode"] + '</td>' +
                '<td class="text-center align-middle">' + ((item["Condition"] === "1") ?
                    "{{ __('New') }}" : "{{ __('Used') }}") + '</td>' +
                '<td class="text-center align-middle">' + item["Total"] + '</td>' +
                '<td class="text-center align-middle">' +
                '<a href="javascript:;" class="  text-success text-decoration-none   me-2" onclick="editItem(' +
                item.id + ')"><i class="fa-regular fa-edit"></i></a>' +
                '<a href="javascript:;" class="  text-danger   text-decoration-none  " onclick="deleteItem(' +
                item.id + ')"><i class="fa-regular fa-trash-can"></i></a>' +
                '</td>' +
                '</tr>';
            boxSection.append(new_item)
        });
        if (listItems.length>0){
            if ($("#newItem").hasClass("show")) {
                // $("#newItem").modal("hide");
            }
            $('#add_item_btn').show();
        }

    }


    function deleteItem(id) {
        listItems.map((item) => {
            if (item.id === id) {
                listItems.splice(item, 1);

                // Empty Input Field
                descInput.value = "";
                quantityInput.value = "";
                eachInput.value = "";
                // countryInput.value = "";
                packageInput.value = "";
                hsCodeInput.value = "";
                conditionInput.value = "";
                totalDiv.textContent = "0";


                // show_block_itemForm()
                addDataToLocalStorage(listItems);
                // Return View Items ON Box Content In The Page
                // viewElementsAtPage(listItems);

                // Return View Items ON Box Section In The Page
                viewElementsAtSectionBox(listItems);

                // Calculate Total
                calculateTotal(listItems);
            }
        });
        // console.log(listItems.length);
        if (listItems.length == 0) {
            $('#package_items tbody').append('<tr><td   colspan="9" class="text-center align-middle" >' +
                '<strong class="me-2" style="font-size: 15px">{{ __('Please Add Item Press this button To ') }}</strong>' +
                '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newItem">' +
                'Add New Item' +
                '</button>' +
                '</td></tr>');
            $('#add_item_btn').hide();
        }

    }

    function editItem(id) {
        let item = listItems.find((item) => {
            return item.id === id;
        });
        descInput.value = item.Description;
        quantityInput.value = item.Quantity;
        eachInput.value = item.Each;
        countryInput.value = item.Country;
        packageInput.value = item.Package;
        hsCodeInput.value = item.HSCode;
        conditionInput.value = item.Condition;
        totalDiv.textContent = item.Total;
        submitBtn.textContent = "{{ __('Update Item') }}";
        submitBtn.onclick = () => updateItem(id);
        // Show Form With Item Data
        $('#newItem').modal('show');
        $('#country_made').append(item.Country).trigger('change');
        if (item.Package === '0') {
            $("#package_dif").val('Master').change();
        }

    }

    function updateItem(id) {
        if (
            descInput.value &&
            quantityInput.value &&
            eachInput.value &&
            countryInput.value &&
            packageInput.value &&
            conditionInput.value
        ) {
            listItems.map((item) => {
                if (item.id === id) {
                    item.Description = descInput.value;
                    item.Item = descInput.value;
                    item.Quantity = quantityInput.value;
                    item.Each = eachInput.value;
                    item.Country = countryInput.value;
                    item.Package = packageInput.value;
                    item.HSCode = hsCodeInput.value;
                    item.Condition = conditionInput.value;
                    item.Total = quantityInput.value * eachInput.value;
                    // viewElementsAtPage(listItems);

                    // Return View Items ON Box Section In The Page
                    viewElementsAtSectionBox(listItems);

                    // Calculate Total
                    $('#protection_value').val('')
                    $('#protection_pay_value').val('')
                    calculateTotal(listItems);

                    // Empty Input Field
                    descInput.value = "";
                    quantityInput.value = "";
                    eachInput.value = "";
                    // countryInput.value = "";
                    packageInput.value = "";
                    hsCodeInput.value = "";
                    conditionInput.value = "";
                    totalDiv.textContent = "0";

                    // Hide Form With Update Data
                    // $('#newItem').modal('hide');

                    // Return submitBtn To Add Item
                    submitBtn.textContent = "{{ __('Add This Item') }}";
                    submitBtn.onclick = addItemToArray;
                    addDataToLocalStorage(listItems);
                }
            });
            // Return View Items ON Box Content In The Page

        }
    }

    function addDataToLocalStorage(arrayOfItems) {
        window.localStorage.setItem("items", JSON.stringify(arrayOfItems));
    }

    function calculateTotal(listItems) {
        let total = listItems.reduce((acc, curr) => {
            return (acc += curr.Total);
        }, 0);
        $('#total').text(total)
        $('#item_total').val(total)
        $('#insurance_limit').text('$'+total);

        $("#protection_value").attr({
            "max" : total,        // substitute your own
            "min" : 101          // values (or variables) here
        })
    }

</script>

    <script>
        $(document).ready(function() {

            $("#from_package_details").submit(function() {
                let myform  =  $('#from_package_details');

                if(! myform .valid()) {
                    swal.fire("Error!", '{{__('Please fill out all fields.')}}', "error");
                    return false
                };
                if (myform .valid()) {
                    var postData = new FormData($( 'form#from_package_details' )[ 0 ]);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    postData.append('items', localStorage.getItem('items'));
                    $.ajax({
                        url: "{{route('orders.update-orders-details',$package->id)}}",
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        beforeSend() {
                            $(".layout-page").block({
                                message: '<div class="spinner-border text-primary" role="status"></div>',
                                // timeout: 1000,
                                css: {
                                    backgroundColor: "transparent",
                                    border: "0"
                                },
                                overlayCSS: {
                                    backgroundColor: "#000",
                                    opacity: 0.25
                                }
                            })


                        },
                        complete: function () {
                            $(".layout-page").unblock();
                        },

                        success: function (response) {
                            localStorage.removeItem("items");
                            setTimeout(function () {
                                window.location = '{{route('orders.index',$status)}}';

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
                }
            });

        });

    </script>










@endsection
