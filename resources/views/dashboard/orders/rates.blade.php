@extends('dashboard.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}"/>
    <link rel="stylesheet"
          href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}"/>

    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}"/>
    {{--    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />--}}
    <link rel="stylesheet" href="{{asset('assets/css/form-validation.css')}}"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/spinkit/spinkit.css')}}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        .address-box {
            width: 100%;
        }

        .address-box {
            background-color: #f8f8f8;
            padding: 1.5rem;
            border: 1px solid #DF3A27;
            border-radius: 10px;
            margin-bottom: 2rem;
            z-index: 1;
            width: 100%;
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
                <li class="breadcrumb-item active">{{__('Rates')}}</li>
                <!-- Basic table -->


                <!--/ Basic table -->
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="container-fluid">

                <div class="container">
                    <!-- Title -->
                    <div class="d-flex justify-content-between align-items-center py-3">
                        <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #ES{{$package->order_no}}</h2>
                        <h2 class="h5 mb-0"><a href="{{route('users.edit',$package->user_id)}}" class="text-muted">User: {{$package->user->name}}</a> </h2>

                    </div>

                    <!-- Main content -->
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Details -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <div>
                                            <span class="me-3">{{$package->shipping_date}}</span>
                                            <span class="me-3">#ES{{$package->order_no}}</span>
                                            <span class="me-3">
                                             @if($package->type_pay=='zelle')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='venmo')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='paypal')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='paylater')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='Cash App')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='new card')
                                                    {{$package->payments_response['card_details']['card']['card_brand']}}
                                                @elseif($package->type_pay=='Saved card')
                                                    {{$package->payments_response['card_details']['card']['card_brand']}}
                                                @endif
                                        </span>
                                            <span class="badge rounded-pill bg-info">
                                           @if($package->status==1)
                                                    {{__('Pending')}}
                                                @elseif($package->status==5)
                                                    {{__('Shipped Out')}}
                                                @elseif($package->status==2)
                                                    {{__('Delivered')}}
                                                @elseif($package->status==3)
                                                    {{__('Cancelled')}}
                                                @elseif($package->status==4)
                                                    {{__('Need Pay')}}
                                                @endif
                                        </span>
                                        </div>
                                        <div class="d-flex">
                                            <a target="_blank" href="{{route('orders.invoices',[$status,$package->id])}}" class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></a>
                                            {{--                                        <div class="dropdown">--}}
                                            {{--                                            <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">--}}
                                            {{--                                                <i class="bi bi-three-dots-vertical"></i>--}}
                                            {{--                                            </button>--}}
                                            {{--                                            <ul class="dropdown-menu dropdown-menu-end">--}}
                                            {{--                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>--}}
                                            {{--                                                <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>--}}
                                            {{--                                            </ul>--}}
                                            {{--                                        </div>--}}
                                        </div>
                                    </div>
                                    <table class="table table-borderless">
                                        <tbody>
                                        @foreach($package->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-shrink-0">
                                                            {{$loop->index+1}}
                                                        </div>
                                                        <div class="flex-lg-grow-1 ms-3">
                                                            <h6 class="small mb-0">
                                                                <span  class="text-reset">{{$item->description}}</span>
                                                            </h6>
                                                            <span class="small mx-2">Made In: {{$item->full_country->Country}}</span>
                                                            <span class="small mx-2">QTY: {{$item->quantity}}</span>
                                                            {{--                                                    <span class="small mx-5">Item Value: ${{$item->value}}</span>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Item Value: ${{$item->value}}</td>
                                                <td class="text-end">${{$item->total}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr class="text-warning">
                                            <td colspan="2">{{__('Total custom items')}}</td>
                                            <td class="text-end">${{$package->total_cost_items}}</td>
                                        </tr>
                                        <tr class="text-success">
                                            <td colspan="2">{{$package->shipping_method}}</td>
                                            <td class="text-end">${{$package->shipping_cost}}</td>
                                        </tr>
                                        @if($package->cost_protection>0)
                                            <tr class="text-danger">
                                                <td colspan="2">EarthShip Protect</td>
                                                <td class="text-end">${{$package->cost_protection}}</td>
                                            </tr>
                                        @endif
                                        @if($package->promo_code_value!=null)
                                            <tr>
                                                <td colspan="2">Discount</td>
                                                <td class="text-danger text-end">-${{$package->promo_code_value}}</td>
                                            </tr>
                                        @endif
                                        @if($package->discount_golden>0)
                                            <tr>
                                                <td colspan="2">Golden Discount</td>
                                                <td class="text-danger text-end">-${{$package->discount_golden}}</td>
                                            </tr>

                                        @endif
                                        @if($package->credit_card_fee>0)
                                            <tr>
                                                <td colspan="2">Credit Card Fee</td>
                                                <td class="text-primary text-end">${{$package->credit_card_fee}}</td>
                                            </tr>
                                        @endif
                                        <tr class="fw-bold">
                                            <td colspan="2">TOTAL</td>
                                            <td class="text-end">${{($package->shipping_cost+$package->cost_protection-$package->promo_code_value)-
                    (intval($package->shipping_cost*($package->discount_golden/100)))-
                    ($package->discount_coins)+$package->additional_cost+$package->credit_card_fee
                    }}</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- Payment -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="h6">Package Details</h3>
                                            <div class="mb-3">
                                                <span class="text-muted d-block">lbs (L x W x H) QTY</span>
                                                @if($package->type_v==0)
                                                    <span class="fw-bold d-block">{{$package->weight}} lbs ({{$package->length}} in x {{$package->width}} in x {{$package->height}} in)</span>
                                                    @if(count($package->multi_package)>0)
                                                        @foreach($package->multi_package as $item)
                                                            <span class="fw-bold d-block">{{$item['weight']}} lbs ({{$item['length']}} in x {{$item['width']}} in x {{$item['height']}} in)</span>

                                                        @endforeach
                                                    @endif
                                                @else
                                                    @if(count($package->packages)>0)
                                                        @foreach($package->packages as $item)
                                                            <span class="fw-bold d-block">{{$item['weight']}} {{$item['unit_weight']=='1'?'lbs':'KG'}} ({{$item['length']}}  x {{$item['width']}}  x {{$item['height']}} ) {{$item['unit_dimension']=='1'?'in':'cm'}} {{$item['qty']}}</span>

                                                            @endforeach
                                                    @endif

                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <span class="text-muted d-block">{{__('Ship Date')}}</span>
                                                <span class="fw-bold d-block">{{$package->shipping_date}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="h6">Payment Method</h3>
                                            <p>@if($package->type_pay=='zelle')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='venmo')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='paypal')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='paylater')
                                                    {{$package->type_pay}}
                                                @elseif($package->type_pay=='new card')
                                                    {{$package->payments_response['card_details']['card']['card_brand']}}
                                                @elseif($package->type_pay=='Saved card')
                                                    {{$package->payments_response['card_details']['card']['card_brand']}}
                                                @endif <br>
                                                ${{$package->cost_protection+$package->shipping_cost-$package->promo_code_value}} <span class="badge bg-success rounded-pill">PAID</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- Title -->
                            <div class="card mb-4">
                                <h5 class="card-header">Rates</h5>
                                <div class="card-body">
                                    <form action="javascript:void(0)" name="add_order" id="add_order" method="POST">
                                        @csrf


                                        <div class="row" id="fedex_rates"></div>
                                        <div class="row" id="ups_rates"></div>
                                        <div class="row" id="dhl_rates"></div>

                                        <div class="row" id="form_address">

                                                <div class="col-md-12">
                                                    <div class="from-group">
                                                        <label for="from_address_id"></label>
                                                        <select onchange="toggleShippingForm()" class="form-select address-select"
                                                                id="shipping-select" name="shipping-select">
                                                            <option value="" >Select Warehouse Address</option>
                                                            @foreach ($addresses as $address)

                                                                <option value="{{ $address->id }}">
                                                                    {{ $address->nikename   }}</option>

                                                            @endforeach
                                                            <option value="enter-new-address">{{ __('Enter a New Address') }}</option>
                                                        </select>


                                                    </div>
                                                </div>
                                                <div class="col-md-12 px-md-5 p-3">

                                                    <!-- start shipping form -->
                                                    <hr>
                                                    <div class="block-shipping-form"
                                                         style="{{ count($addresses) == 0 ? 'display: none;' : 'display: none' }}">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-2">
                                                                    <label for="nikename_shipping"
                                                                           class="form-label">{{ __('Company Name (Optional)') }}</label>
                                                                    <input type="text" class="form-control" name="nikename_shipping"
                                                                           id="nikename_shipping"
                                                                           placeholder="{{ __('Company Name (Optional)') }}"
                                                                        {{ count($addresses) == 0 ? '' : 'disabled' }}>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-2">
                                                                    <label for="full_name_shipping"
                                                                           class="form-label">{{ __('Full Name') }}</label>
                                                                    <input type="text" class="form-control" name="full_name_shipping"
                                                                           required id="full_name_shipping"
                                                                           placeholder="{{ __('Full Name') }}"
                                                                        {{ count($addresses) == 0 ? '' : 'disabled' }}>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">

                                                                <div class="mb-2">
                                                                    <label for="email">{{ __('Telephone') }}</label>

                                                                    <div class="input-group mb-3">
                                                            <span class="input-group-text input-group-calculator"
                                                                  id="phone_shipping">
                                                                <span class="fi fi-us fis"></span> +1
                                                            </span>
                                                                        <input type="number" id="phone_shipping"
                                                                               name="phone_shipping" required
                                                                               {{ count($addresses) == 0 ? '' : 'disabled' }}
                                                                               class="form-control" placeholder="{{ __('Telephone') }}"
                                                                               aria-label="Address 1" aria-describedby="Telephone">


                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-2">
                                                                    <label for="email">{{ __('Address 1') }}</label>

                                                                    <div class="input-group mb-3">
                                                            <span class="input-group-text input-group-calculator"
                                                                  id="basic-addon1">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                                        <input type="text" id="address_1_shipping"
                                                                               name="address_1_shipping" required
                                                                               {{ count($addresses) == 0 ? '' : 'disabled' }}
                                                                               class="form-control" placeholder="{{ __('Address 1') }}"
                                                                               aria-label="Address 1" aria-describedby="Address 1">


                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-2">
                                                                    <label for="email">{{ __('Address 2 (Optional)') }}</label>

                                                                    <div class="input-group mb-3">
                                                            <span class="input-group-text input-group-calculator"
                                                                  id="basic-addon1">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                                        <input type="text" id="address_2_shipping"
                                                                               name="address_2_shipping"
                                                                               {{ count($addresses) == 0 ? '' : 'disabled' }}
                                                                               class="form-control" placeholder="{{ __('Address 2') }}"
                                                                               aria-label="Address 2" aria-describedby="Address 2">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-2">
                                                                    <label
                                                                        for="state_province_region_shipping">{{ __('State/Province') }}</label>

                                                                    <div class="input-group mb-3">
                                                            <span class="input-group-text input-group-calculator"
                                                                  id="basic-addon1">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                                        {{-- <input type="text" id="state_province_region" name="state_province_region" value="{{$address->state_province_region}}" class="form-control" placeholder="{{__('State/Province/Region')}}" aria-label="State/Province/Region" aria-describedby="State/Province/Region"> --}}
                                                                        <select autocomplete="do-not-autofill" class="form-select"
                                                                                required {{ count($addresses) == 0 ? '' : 'disabled' }}
                                                                                id="state_province_region_shipping"
                                                                                name="state_province_region_shipping"
                                                                                aria-required="true">
                                                                            <option></option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-2">
                                                                    <label for="city">{{ __('City') }}</label>

                                                                    <div class="input-group mb-3">
                                                            <span class="input-group-text input-group-calculator"
                                                                  id="basic-addon1">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                                        <input type="text" id="city_shipping" name="city_shipping"
                                                                               required class="form-control"
                                                                               {{ count($addresses) == 0 ? '' : 'disabled' }}
                                                                               placeholder="{{ __('City') }}" aria-label="City"
                                                                               aria-describedby="City">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="mb-2">
                                                                    <label
                                                                        for="postal_code">{{ __('Postal Code (Zip Code)') }}</label>

                                                                    <div class="input-group mb-3">
                                                            <span class="input-group-text input-group-calculator"
                                                                  id="basic-addon1">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                                        <input type="text" id="postal_code_shipping"
                                                                               name="postal_code_shipping" required
                                                                               {{ count($addresses) == 0 ? '' : 'disabled' }}
                                                                               class="form-control"
                                                                               placeholder="{{ __('Postal Code (Zip Code)') }}"
                                                                               aria-label="Postal Code (Zip Code)"
                                                                               aria-describedby="Postal Code (Zip Code)">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12"></div>
                                                            <div class="col-md-12 col-12"></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12"></div>
                                                            <div class="col-md-12 col-12"></div>
                                                        </div>
                                                        {{--                                <div class="mb-2"> --}}
                                                        {{--                                    <label for="email_shipping" class="form-label">{{__('Email')}}</label> --}}
                                                        {{--                                    <input type="email" class="form-control" name="email_shipping" id="email_shipping" placeholder="{{__('Email')}}" {{count($addresses)==0?'':'disabled'}}> --}}
                                                        {{--                                </div> --}}





                                                        {{--                                <div class="mb-2"> --}}
                                                        {{--                                    <label for="organization_shipping">{{__("Organization")}} </label> --}}
                                                        {{--                                    <input type="text" id="organization_shipping" name="organization_shipping" {{count($addresses)==0?'':'disabled'}} class="form-control" placeholder="{{__('Organization')}}" aria-label="Organization" aria-describedby="Organization"> --}}

                                                        {{--                                </div> --}}

                                                    </div>
                                                    <!-- start shipping card -->
                                                    @foreach ($addresses as $address)
                                                        <div class="block-shipping-card-{{ $address->id }}   "
                                                             id="block_shipping_card_{{ $address->id }}"


                                                                 style="display: none"



                                                        >
                                                            <div class="d-flex">
                                                                <div class="address-box">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center mb-2">
                                                                        <h5 class="fw-bold mb-0">
                                                                            {{ $address->nikename ?? $address->full_name }}</h5>
                                                                        <a class="color-main"
                                                                           onclick="edit_address_shipping({{ $address->id }})"
                                                                           href="javascript:void(0)">{{ __('Edit Address') }}</a>
                                                                    </div>
                                                                    <ul class="text-muted list-unstyled">
                                                                        <li class="mb-2">{{ $address->full_name }}</li>
                                                                        <li class="mb-2">{{ $address->address_1 }}</li>
                                                                        <li class="mb-2">
                                                                            {{ $address->city . ',' . $address->state_province_region . ',' . $address->postal_code }}
                                                                        </li>
                                                                        {{--                                                                    <li class="mb-2">{{ $address->full_country->Country }}</li>--}}
                                                                        <li class="mb-2"> {{ $address->full_phone }}</li>
                                                                        <li>{{ $address->email }}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    @endforeach
                                                    <div class="text-center text-md-start" id="add_shipping_form"
                                                         style="{{ count($addresses) == 0 ? 'display:none ' : 'display: none;' }}">
                                                        <button onclick="show_block_shipping_form()"
                                                                class="btn btn-main btn-secondary mb-5"
                                                                type="button">{{ __('Add a New Address') }}</button>
                                                    </div>
                                                    <div class="col-12 " id="div_edit_shipping_address" style="display: none">
                                                        <input type="hidden" name="type" value="0" />

                                                        <div class="row">
                                                            <div class="col-md-12 col-12 col-12">
                                                                <div class="from-group mb-3">
                                                                    <label
                                                                        for="nikename_edit_shipping">{{ __('Company Name (Optional)') }}</label>
                                                                    <input type="text" id="nikename_edit_shipping"
                                                                           name="nikename_shipping" disabled="disabled"
                                                                           class="form-control"
                                                                           placeholder="{{ __('Company Name (Optional)') }}"
                                                                           aria-label="Full Name" aria-describedby="Full Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12 col-12">
                                                                <div class="from-group mb-3">
                                                                    <label for="full_name">{{ __('Full Name') }}</label>
                                                                    <input type="text" id="full_name_edit_shipping"
                                                                           name="full_name_shipping" required disabled="disabled"
                                                                           class="form-control" placeholder="{{ __('Full Name') }}"
                                                                           aria-label="Full Name" aria-describedby="Full Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12 col-12">


                                                                <div class="mb-2">
                                                                    <label for="email">{{ __('Telephone') }}</label>

                                                                    <div class="input-group mb-3">
                                                            <span class="input-group-text input-group-calculator"
                                                                  id="phone_edit_shipping">
                                                                <span class="fi fi-us fis"></span> +1
                                                            </span>
                                                                        <input type="number" id="phone_edit_shipping"
                                                                               name="phone_shipping" required disabled="disabled"
                                                                               class="form-control" placeholder="{{ __('Telephone') }}"
                                                                               aria-label="Address 1" aria-describedby="Telephone">


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12 col-12">
                                                                <label for="email">{{ __('Address 1') }}</label>

                                                                <div class="input-group mb-3">
                                                        <span class="input-group-text input-group-calculator"
                                                              id="basic-addon1">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                                    <input type="text" id="address_1_edit_shipping"
                                                                           name="address_1_shipping" required disabled="disabled"
                                                                           class="form-control" placeholder="{{ __('Address 1') }}"
                                                                           aria-label="Address 1" aria-describedby="Address 1">


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12 col-12">
                                                                <label for="email">{{ __('Address 2 (Optional)') }}</label>

                                                                <div class="input-group mb-3">
                                                        <span class="input-group-text input-group-calculator"
                                                              id="basic-addon1">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                                    <input type="text" id="address_2_edit_shipping"
                                                                           name="address_2_shipping" disabled="disabled"
                                                                           class="form-control" placeholder="{{ __('Address 2') }}"
                                                                           aria-label="Address 2" aria-describedby="Address 2">


                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12 col-12">
                                                                <label
                                                                    for="state_province_region_edit_shipping">{{ __('State/Province') }}</label>

                                                                <div class="input-group mb-3">
                                                        <span class="input-group-text input-group-calculator"
                                                              id="basic-addon1">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                                    <select autocomplete="do-not-autofill" class="form-select"
                                                                            required disabled="disabled"
                                                                            id="state_province_region_edit_shipping"
                                                                            name="state_province_region_shipping" aria-required="true">
                                                                        <option></option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-12 col-12">
                                                                <label for="city">{{ __('City') }}</label>

                                                                <div class="input-group mb-3">
                                                        <span class="input-group-text input-group-calculator"
                                                              id="basic-addon1">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                                    <input type="text" id="city_edit_shipping"
                                                                           name="city_shipping" required disabled="disabled"
                                                                           class="form-control" placeholder="{{ __('City') }}"
                                                                           aria-label="City" aria-describedby="City">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12 col-12">
                                                                <label for="postal_code">{{ __('Postal Code (Zip Code)') }}</label>

                                                                <div class="input-group mb-3">
                                                        <span class="input-group-text input-group-calculator"
                                                              id="basic-addon1">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                                    <input type="text" id="postal_code_edit_shipping"
                                                                           name="postal_code_shipping" required disabled="disabled"
                                                                           class="form-control"
                                                                           placeholder="{{ __('Postal Code (Zip Code)') }}"
                                                                           aria-label="Postal Code (Zip Code)"
                                                                           aria-describedby="Postal Code (Zip Code)">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-4 text-center">
                                                <button type="submit" form="add_order" class="btn btn-primary waves-effect waves-light " id="add_form"   >
                                                    {{__('Create Label')}}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="tracking"></div>

                        </div>

                        <div class="col-lg-4">
                            <!-- Customer Notes -->
                            <div id="tracking_side"></div>
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
                                            <li class="mb-2">{{$package->address_going->full_phone}}</li>
                                            <li class="mb-2">{{$package->address_going->email}}</li>
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
                                            <li class="mb-2"> {{$package->address_from->full_phone}}</li>
                                            <li class="mb-2">{{$package->address_from->email}}</li>
                                        </ul>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    @if ($status==1)
                                        <a href="{{route('orders.view',[$package->id,$status] )}}" target="_blank" class="ms-2 btn btn-primary">View</a>
                                        <a href="{{route('orders.edit',[$status,$package->id] )}}" target="_blank" class="ms-2 btn btn-success">Edit</a>
                                        <a href="{{route('orders.invoices',[$status,$package->id] )}}" target="_blank" class="ms-2 btn btn-warning">Invoices</a>
                                        <a href="{{route('orders.labels',[$status,$package->id] )}}" target="_blank" class="ms-2 btn btn-danger">Labels</a>
                                    @else
                                        <a href="{{route('orders.view',[$package->id,$status] )}}" target="_blank" class="ms-2 btn btn-primary">View</a>
                                        <a href="{{route('orders.invoices',[$status,$package->id] )}}" target="_blank" class="ms-2 btn btn-warning">Invoices</a>
                                        <a href="{{route('orders.labels',[$status,$package->id] )}}" target="_blank" class="ms-2 btn btn-danger">Labels</a>
                                    @endif
                                </div>
                            </div>
                            <div class="card mb-4">
                                <form method="POST" enctype="multipart/form-data" class="form p-5" id="form_status_order"  novalidate="novalidate">

                                    <input type="text" name="package_id" value="{{$package->id}}" hidden>
                                    <div class="form-group">
                                        <label class="form-label" for="status_order"> Status</label>
                                        <select class=" form-select form-control-lg" name="status" id="status_order">
                                            <option value="1" {{ $package->status==1?'selected':''}}>{{__('Pending')}}</option>
                                            <option value="5" {{ $package->status==5?'selected':''}} >{{__('Shipped Out')}}</option>
                                            <option value="2" {{ $package->status==2?'selected':''}} >{{__('Delivered')}}</option>
                                            <option value="3" {{ $package->status==3?'selected':''}} >{{__('Cancelled')}}</option>

                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalOutLabel">Add Out Label</button>
                                </div>
                                <div class="card-datatable table-responsive pt-0">
                                    <div class="table-responsive mb-3">
                                        <table class="table datatable border-top">
                                            <thead>
                                            <tr>
                                                <th>tracking number</th>
                                                <th>carrierCode</th>
                                                <th>shipmentCost</th>
                                                <th>Status</th>
                                                <th>Create Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <div class="modal fade " id="modalOutLabel" tabindex="-1"   aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Label</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_form_out_label" method="post" name="add_form_out_label"  action="javascript:void(0)" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="tracking_number" class="form-label">tracking_number</label>
                                <div class="input-group">

                                    <input type="text"   class="form-control" id="tracking_number" name="tracking_number" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="tracking_url" class="form-label">tracking_url</label>
                                <div class="input-group">

                                    <input type="text"   class="form-control" id="tracking_url" name="tracking_url" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="shipment_cost" class="form-label">shipment_cost</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text"   class="form-control" id="shipment_cost" name="shipment_cost" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="shipping_company" class="form-label">shipping_company</label>
                                <select name="shipping_company" class="form-select" id="shipping_company">
                                    <option value="FEDEX">FEDEX</option>
                                    <option value="UPS">UPS</option>
                                    <option value="DHL">DHL</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="serviceName" class="form-label">serviceName</label>
                                <select name="serviceName" id="serviceName" class="form-select">
                                    <option value="ups_worldwide_saver">ups_worldwide_saver</option>
                                    <option value="ups_worldwide_expedited">ups_worldwide_expedited</option>
                                    <option value="fedex_international_economy">fedex_international_economy</option>
                                    <option value="fedex_international_connect_plus">fedex_international_connect_plus</option>
                                    <option value="fedex_international_priority">fedex_international_priority</option>
                                    <option value="express_worldwide">express_worldwide</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="commercial_invoice" class="form-label">commercial_invoice</label>
                                <div class="input-group">
                                    <input type="file"  class="form-control" id="commercial_invoice" name="commercial_invoice" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="label" class="form-label">label</label>
                                <div class="input-group">
                                    <input type="file"   class="form-control" id="label" name="label" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="add_form_label">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/assets/js/app-user-view-security.js')}}"></script>--}}
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/block-ui/block-ui.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    @if($package->address_going->full_phone==null)
        <script>
            swal.fire({
                icon: 'error',
                title: 'Phone going to not found'
            });
        </script>
    @endif

    <script>

        var data_url_table = '{{ route('orders.get_labels',$package->id)}}'

        var dt;
        $(function () {

            dt = $('.datatable').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: data_url_table,
                columns: [
                    {data: 'tracking_number', name: 'tracking_number'},
                    {data: 'carrier_code', name: 'carrier_code'},
                    {data: 'shipment_cost', name: 'shipment_cost'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ],
                displayLength: 10,
                lengthMenu: [7, 10, 25, 50, 75, 100],

                language: {
                    "lengthMenu": "{{__('Show')}} _MENU_ {{__('entries')}}",
                    "processing": "{{__('Processing...')}}",
                    "search": "{{__('Search:')}}",
                    "info": "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
                    "zeroRecords": "{{__('No matching records found')}}",
                    "emptyTable": "{{__('No data available in table')}}",
                    "infoEmpty": "{{__('Showing')}} 0 {{__('to')}} 0 {{__('of')}} 0 {{__('entries')}}",
                    "infoFiltered": "({{__('filtered from')}} _MAX_ {{__('total entries')}} )",
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
            });

        });


    </script>
    {{--    create labels--}}
    <script>

        var data_url_user = '{{ route('orders.create-labels',$package->id)}}'

        $(document).ready(function () {
            function myHandel(obj, id) {
                if ('responseJSON' in obj)
                    obj.messages = obj.responseJSON;
                $('input,select,textarea').each(function () {
                    var parent = "";
                    if ($(this).parents('.fv-row').length > 0)
                        parent = $(this).parents('.fv-row');
                    if ($(this).parents('.input-group').length > 0)
                        parent = $(this).parents('.input-group');
                    var name = $(this).attr("name");
                    if (obj.messages && obj.messages[name] && ($(this).attr('type') !== 'hidden')) {
                        var error_message = '<div class="col-md-8 offset-md-3 custom-error"><p style="color: red">' + obj.messages[name][0] + '</p></div>'
                        parent.append(error_message);
                    }
                });
            }

            $("#add_order").submit(function () {
                let myform = $('#add_order');

                if (!myform.valid()) {
                    return false
                }
                ;
                if (myform.valid()) {
                    var postData = new FormData($('form#add_order')[0]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    $('#add_form').html('');
                    $('#add_form').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('creating')}}...</span>');
                    $.ajax({
                        url: data_url_user,
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        beforeSend() {
                            $('.layout-container').block({
                                message:
                                    '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                                // timeout: 1000,
                                css: {
                                    backgroundColor: 'transparent',
                                    color: '#fff',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                }
                            });

                        },
                        complete:function (){
                            $('.layout-container').unblock();
                        },
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
                            window.location.reload();
                            $('.datatable').DataTable().ajax.reload();
                            $('.custom-error').remove();

                        },
                        error: function (data) {
                            // $(".layout-page").unblock();
                            $('.layout-container').unblock();
                            $('.custom-error').remove();
                            $('#add_form').empty();
                            $('#add_form').html('{{__('Save')}}');
                            var response = data.responseJSON;
                            if (data.status == 422) {
                                if (typeof (response.responseJSON) != "undefined") {
                                    // myHandel(response);
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
    {{--    save address--}}
    <script>

        var data_url  = '{{ route('orders.store_address_details_from')}}'

        $(document).ready(function () {
            function myHandel(obj, id) {
                if ('responseJSON' in obj)
                    obj.messages = obj.responseJSON;
                $('input,select,textarea').each(function () {
                    var parent = "";
                    if ($(this).parents('.fv-row').length > 0)
                        parent = $(this).parents('.fv-row');
                    if ($(this).parents('.input-group').length > 0)
                        parent = $(this).parents('.input-group');
                    var name = $(this).attr("name");
                    if (obj.messages && obj.messages[name] && ($(this).attr('type') !== 'hidden')) {
                        var error_message = '<div class="col-md-8 offset-md-3 custom-error"><p style="color: red">' + obj.messages[name][0] + '</p></div>'
                        parent.append(error_message);
                    }
                });
            }

            $("#save_address").click(function () {
                alert('dsf');
                let addressForm = $('#form_address');
                console.log(addressForm);

                if (!addressForm.valid()) {
                    return false
                }
                ;
                if (addressForm.valid()) {
                    var postData_address = new FormData($('form#form_address')[0]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    $('#add_form').html('');
                    $('#add_form').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('creating')}}...</span>');
                    $.ajax({
                        url: data_url,
                        type: "POST",
                        data: postData_address,
                        processData: false,
                        contentType: false,
                        beforeSend() {
                            $('.layout-container').block({
                                message:
                                    '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                                // timeout: 1000,
                                css: {
                                    backgroundColor: 'transparent',
                                    color: '#fff',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                }
                            });

                        },
                        complete:function (){
                            $('.layout-container').unblock();
                        },
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
                            window.location.reload();
                            $('.datatable').DataTable().ajax.reload();
                            $('.custom-error').remove();

                        },
                        error: function (data) {
                            // $(".layout-page").unblock();
                            $('.layout-container').unblock();
                            $('.custom-error').remove();
                            $('#add_form').empty();
                            $('#add_form').html('{{__('Save')}}');
                            var response = data.responseJSON;
                            if (data.status == 422) {
                                if (typeof (response.responseJSON) != "undefined") {
                                    // myHandel(response);
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
    <script>

        var data_url_out_label = '{{ route('orders.create-out-labels',$package->id)}}'

        $(document).ready(function () {
            function myHandel(obj, id) {
                if ('responseJSON' in obj)
                    obj.messages = obj.responseJSON;
                $('input,select,textarea').each(function () {
                    var parent = "";
                    if ($(this).parents('.fv-row').length > 0)
                        parent = $(this).parents('.fv-row');
                    if ($(this).parents('.input-group').length > 0)
                        parent = $(this).parents('.input-group');
                    var name = $(this).attr("name");
                    if (obj.messages && obj.messages[name] && ($(this).attr('type') !== 'hidden')) {
                        var error_message = '<div class="col-md-8 offset-md-3 custom-error"><p style="color: red">' + obj.messages[name][0] + '</p></div>'
                        parent.append(error_message);
                    }
                });
            }

            $("#add_form_out_label").submit(function () {
                let myform = $('#add_form_out_label');

                if (!myform.valid()) {
                    return false
                }
                ;
                if (myform.valid()) {
                    var postData = new FormData($('form#add_form_out_label')[0]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    $('#add_form_label').html('');
                    $('#add_form_label').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('creating')}}...</span>');
                    $.ajax({
                        url: data_url_out_label,
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        beforeSend() {
                            $('.layout-container').block({
                                message:
                                    '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                                // timeout: 1000,
                                css: {
                                    backgroundColor: 'transparent',
                                    color: '#fff',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                }
                            });

                        },
                        complete:function (){
                            $('.layout-container').block({
                                message:
                                    '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                                css: {
                                    backgroundColor: 'transparent',
                                    color: '#fff',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                },
                                timeout: 1000,
                                onUnblock: function () {
                                    $.blockUI({
                                        message: '<p class="mb-0">Almost Done...</p>',
                                        timeout: 1000,
                                        css: {
                                            backgroundColor: 'transparent',
                                            color: '#fff',
                                            border: '0'
                                        },
                                        overlayCSS: {
                                            opacity: 0.5
                                        },
                                        onUnblock: function () {
                                            $.blockUI({
                                                message: '<div class="p-3 bg-success">Success</div>',
                                                timeout: 500,
                                                css: {
                                                    backgroundColor: 'transparent',
                                                    color: '#fff',
                                                    border: '0'
                                                },
                                                overlayCSS: {
                                                    opacity: 0.5
                                                }
                                            });
                                        }
                                    });
                                }
                            });

                        },
                        success: function (response) {
                            $('#add_form_label').html('{{__('Save')}}');
                            setTimeout(function () {
                                toastr['success'](
                                    response.success,
                                    {
                                        closeButton: true,
                                        tapToDismiss: false
                                    }
                                );
                            }, 200);
                            $('#modalOutLabel').modal('hide');
                            $('.datatable').DataTable().ajax.reload();
                            $('.custom-error').remove();

                        },
                        error: function (data) {
                            $('.custom-error').remove();
                            $('#add_form_label').empty();
                            $('#add_form_label').html('{{__('Save')}}');
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
    <script>

        $(document).on("change", "#status_order", function() {
            var data_url_status='{{route('orders.status')}}'
            // e.preventDefault()
            swal.fire({
                title: "{{__('Change?')}}",
                text: "{{__('Please confirm approval')}}",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "{{__('Yes, Change!')}}",
                cancelButtonText: "{{__('No, back off!')}}",
                confirmButtonColor: "#DD6B55",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    var postData_order = new FormData($( 'form#form_status_order' )[ 0 ]);

                    $.ajax({
                        url: data_url_status,
                        type: "POST",
                        data: postData_order,
                        processData: false,
                        contentType: false,
                        beforeSend() {
                            $('.layout-container').block({
                                message:
                                    '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                                // timeout: 1000,
                                css: {
                                    backgroundColor: 'transparent',
                                    color: '#fff',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                }
                            });

                        },
                        complete:function (){
                            $('.layout-container').block({
                                message:
                                    '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                                css: {
                                    backgroundColor: 'transparent',
                                    color: '#fff',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                },
                                timeout: 1000,
                                onUnblock: function () {
                                    $.blockUI({
                                        message: '<p class="mb-0">Almost Done...</p>',
                                        timeout: 1000,
                                        css: {
                                            backgroundColor: 'transparent',
                                            color: '#fff',
                                            border: '0'
                                        },
                                        overlayCSS: {
                                            opacity: 0.5
                                        },
                                        onUnblock: function () {
                                            $.blockUI({
                                                message: '<div class="p-3 bg-success">Success</div>',
                                                timeout: 500,
                                                css: {
                                                    backgroundColor: 'transparent',
                                                    color: '#fff',
                                                    border: '0'
                                                },
                                                overlayCSS: {
                                                    opacity: 0.5
                                                }
                                            });
                                        }
                                    });
                                }
                            });

                        },

                        success: function (response) {
                            // $('.datatable').DataTable().ajax.reload();
                            {{--$('#change').html('{{__('Save')}}');--}}
                            setTimeout(function () {
                                toastr['success'](
                                    response.success,
                                    {
                                        closeButton: true,
                                        tapToDismiss: false
                                    }
                                );
                            }, 200);

                            $('.custom-error').remove();
                           var status=$('#status_order').val();
                            window.location.href="{{route('orders.labels',['',''] )}}"+'/'+status+'/'+{{$package->id}};

                        },
                        error: function (data) {
                            $('.custom-error').remove();
                            $(this).empty();
                            $(this).html('{{__('Save')}}');
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
                        }
                    });
                }else {
                    document.querySelectorAll("#status_order").forEach(v => {
                        v.value = "{{$status}}";
                    })
                }


            }, function (dismiss) {


                return false;
            })

        });
    </script>
<script>
    function shippingCompany($company){
        $('#shipping_company').val($company)
    }
</script>
    <script>
        $(document).on("change", "#status", function() {
            var postData = new FormData(this.form);
            var data_url_create_section='{{route('orders.status_label')}}'
            swal.fire({
                title: "{{__('Change?')}}",
                text: "{{__('Please confirm approval')}}",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "{{__('Yes, Change!')}}",
                cancelButtonText: "{{__('No, back off!')}}",
                confirmButtonColor: "#DD6B55",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });


            $.ajax({
                url: data_url_create_section,
                type: "POST",
                data: postData,
                processData: false,
                contentType: false,
                beforeSend() {
                    $('.layout-container').block({
                        message:
                            '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                        // timeout: 1000,
                        css: {
                            backgroundColor: 'transparent',
                            color: '#fff',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.5
                        }
                    });

                },
                complete:function (){
                    $('.layout-container').block({
                        message:
                            '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                        css: {
                            backgroundColor: 'transparent',
                            color: '#fff',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.5
                        },
                        timeout: 1000,
                        onUnblock: function () {
                            $.blockUI({
                                message: '<p class="mb-0">Almost Done...</p>',
                                timeout: 1000,
                                css: {
                                    backgroundColor: 'transparent',
                                    color: '#fff',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                },
                                onUnblock: function () {
                                    $.blockUI({
                                        message: '<div class="p-3 bg-success">Success</div>',
                                        timeout: 500,
                                        css: {
                                            backgroundColor: 'transparent',
                                            color: '#fff',
                                            border: '0'
                                        },
                                        overlayCSS: {
                                            opacity: 0.5
                                        }
                                    });
                                }
                            });
                        }
                    });

                },
                success: function (response) {
                    $('.datatable').DataTable().ajax.reload();
                    {{--$('#change').html('{{__('Save')}}');--}}
                    setTimeout(function () {
                        toastr['success'](
                            response.success,
                            {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 200);

                    $('.custom-error').remove();

                },
                error: function (data) {
                    $('.custom-error').remove();
                    $(this).empty();
                    $(this).html('{{__('Save')}}');
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
                }
            });
                }else {
                    $('.datatable').DataTable().ajax.reload();
                }


            }, function (dismiss) {


                return false;
            })

        });
    </script>
    <script>
        // start address page
        let shippingSelect = document.getElementById("shipping-select");

        function show_block_shipping_form() {

            $('[id^=block_shipping_card_]').hide();
            $(".block-shipping-form").show();
            $("#add_shipping_form").hide();
            $("#div_edit_shipping_address").hide();
            shippingSelect.value = "enter-new-address";
            $('#div_edit_shipping_address').find('input, textarea, button, select').attr('disabled', 'disabled');
            $('.block-shipping-form').find('input, textarea, button, select').removeAttr("disabled");
        }

        function hide_block_shipping_form(id) {
            $(".block-shipping-form").hide();
            $("#add_shipping_form").show();
            $('[id^=block_shipping_card_]').hide();
            $(".block-shipping-card-" + id).show();
            $('#div_edit_shipping_address').hide();
        }

        function toggleShippingForm() {
            let optionValue = shippingSelect.options[shippingSelect.selectedIndex].value;
            if (optionValue === "enter-new-address") {
                show_block_shipping_form();
                $('#div_edit_shipping_address').find('input, textarea, button, select').attr('disabled', 'disabled');
                $('.block-shipping-form').find('input, textarea, button, select').removeAttr("disabled");
            } else {
                $('.block-shipping-form').find('input, textarea, button, select').attr("disabled", 'disabled');
                $('#div_edit_shipping_address').find('input, textarea, button, select').attr("disabled", 'disabled');
                hide_block_shipping_form(optionValue);
            }
        }


        // end address page
    </script>
    {{--    select Address Edit --}}
    <script type="text/javascript">
        function edit_address_shipping(id) {
            $('#block_shipping_card_' + id).hide();
            $('#add_shipping_form').hide();
            $('#div_edit_shipping_address').show();

            $('.block-shipping-form').find('input, textarea, button, select').attr('disabled', 'disabled');
            $('#div_edit_shipping_address').find('input, textarea, button, select').removeAttr("disabled");
            $.ajax({
                url: '{{ route('orders.edit-warehouse-address', '') }}' + '/' + id,
                type: 'GET',

                success: function(data) {
                    $('#div_edit_shipping_address #nikename_edit_shipping').val(data.address.nikename);
                    $('#div_edit_shipping_address #full_name_edit_shipping').val(data.address.full_name);
                    $('#div_edit_shipping_address #phone_edit_shipping').val(data.address.phone);
                    $('#div_edit_shipping_address #email_edit_shipping').val(data.address.email);
                    $('#div_edit_shipping_address #country_edit_shipping').val(data.address.country).trigger(
                        "change");
                    $('#div_edit_shipping_address #address_1_edit_shipping').val(data.address.address_1);
                    $('#div_edit_shipping_address #address_2_edit_shipping').val(data.address.address_2);
                    $('#div_edit_shipping_address #state_province_region_edit_shipping').val(data.address
                        .state_province_region).trigger("change");
                    $('#div_edit_shipping_address #city_edit_shipping').val(data.address.city);
                    $('#div_edit_shipping_address #postal_code_edit_shipping').val(data.address.postal_code);
                    // $('#div_edit_shipping_address #organization_edit_shipping').val(data.address.organization);
                }
            })
        }
    </script>
    {{--    select 2 --}}
    <script>
         var states = [

                @foreach ($states as $state)
            {
                id: '{{ $state->code }}',
                text: '{{ $state->name }}'
            },
            @endforeach
        ];


        $("#state_province_region_edit_shipping").select2({
            placeholder: "{{ __('Select a State') }}",
            // templateResult: formatCountry,
            theme: 'bootstrap-5',
            data: states
        });
        $("#state_province_region_shipping").select2({
            placeholder: "{{ __('Select a State') }}",
            // templateResult: formatCountry,
            theme: 'bootstrap-5',
            data: states
        });
    </script>
    {{--    rates --}}
    <script>
        window.onload = function() {
            // First AJAX request
            $.ajax({
                url: '{{route('orders.get_rate_fedex',$package)}}',
                type: 'GET',
                success: function(response) {
                    // Handle the response from the first request here
                    $('#fedex_rates').append(response)
                 },
                error: function(error) {
                    // Handle errors from the first request here
                    console.error('First request error:', error);
                }
            });

            // Second AJAX request
            $.ajax({
                url: '{{route('orders.get_rate_ups',$package)}}',
                type: 'GET',
                success: function(response) {
                    // Handle the response from the second request here
                    $('#ups_rates').append(response)
                },
                error: function(error) {
                    // Handle errors from the second request here
                    console.error('Second request error:', error);
                }
            });

            // Third AJAX request
            $.ajax({
                url: '{{route('orders.get_rate_dhl',$package)}}',
                type: 'GET',
                success: function(response) {
                    // Handle the response from the third request here
                    $('#dhl_rates').append(response)
                },
                error: function(error) {
                    // Handle errors from the third request here
                    console.error('Third request error:', error);
                }
            });
            $.ajax({
                url: '{{route('orders.get_tracking',$package)}}',
                type: 'GET',
                success: function(response) {
                    // Handle the response from the third request here
                    $('#tracking').append(response)
                },
                error: function(error) {
                    // Handle errors from the third request here
                    console.error('Third request error:', error);
                }
            });
            $.ajax({
                url: '{{route('orders.get_tracking_side',$package)}}',
                type: 'GET',
                success: function(response) {
                    // Handle the response from the third request here
                    $('#tracking_side').append(response)
                },
                error: function(error) {
                    // Handle errors from the third request here
                    console.error('Third request error:', error);
                }
            });
        }
    </script>

@endsection
