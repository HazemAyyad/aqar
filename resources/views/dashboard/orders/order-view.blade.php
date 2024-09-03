@extends('dashboard.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />

    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}" />
    {{--    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />--}}
    <link rel="stylesheet" href="{{asset('assets/css/form-validation.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css')}}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">{{__('Home')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('orders.index',$package->status)}}">{{__('Orders')}}</a>
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
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#info" onclick="nav_link('info')"  class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                                    {{__('Order Info')}}</a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a href="#ticket" onclick="nav_link('ticket')"  class="nav-link" id="ticket-tab" data-bs-toggle="tab" data-bs-target="#ticket" type="button" role="tab" aria-controls="ticket" aria-selected="false">
                                    {{__('Support Ticket')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                <div class=" mt-3">
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
                                                            <a target="_blank" href="{{route('orders.invoices',[$package->status,$package->id])}}" class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></a>
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
                                                                <span class="text-muted d-block">lbs (L x W x H)</span>
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
                                                                            <span >{{$item['weight']}} {{$item['unit_weight']=='1'?'lbs':'KG'}} ({{$item['length']}}  x {{$item['width']}}  x {{$item['height']}} ) {{$item['unit_dimension']=='1'?'in':'cm'}} {{$item['qty']}}</span>

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
                                            @if(isset($package->tracking['events']))
                                                <div class="card mb-4">
                                                    <h5 class="card-header">Tracking</h5>
                                                    <div class="card-body pb-0">
                                                        <ul class="timeline mb-0">
                                                            @foreach($package->tracking['events'] as $item)
                                                                <li class="timeline-item timeline-item-transparent {{$loop->last?'border-0':''}}">
                                                                    <span class="timeline-point timeline-point-primary"></span>
                                                                    <div class="timeline-event">
                                                                        <div class="timeline-header mb-1">
                                                                            <h6 class="mb-0">
                                                                                @if($item['status_code']=='AC')
                                                                                    {{__('Accepted')}}
                                                                                @elseif($item['status_code']=='IT')
                                                                                    {{__('In Transit')}}
                                                                                @elseif($item['status_code']=='DE')
                                                                                    {{__('Delivered')}}
                                                                                @elseif($item['status_code']=='EX')
                                                                                    {{__('Exception')}}
                                                                                @elseif($item['status_code']=='UN')
                                                                                    {{__('Unknown')}}
                                                                                @elseif($item['status_code']=='AT')
                                                                                    {{__('Delivery Attempt')}}
                                                                                @elseif($item['status_code']=='NY')
                                                                                    {{__('Not Yet In System')}}
                                                                                @elseif($item['status_code']=='SP')
                                                                                    {{__('Delivered To The Collection Location')}}
                                                                                @else
                                                                                    {{__('Unknown')}}
                                                                                @endif
                                                                            </h6>
                                                                            <small class="text-muted">{{\Carbon\Carbon::parse($item['occurred_at'])->format('Y-m-d H:i:s')}}</small>
                                                                        </div>
                                                                        <p class="mb-2">{{$item['description']}}</p>
                                                                        <p class="mb-2">{{$item['city_locality']}}</p>

                                                                    </div>
                                                                </li>
                                                            @endforeach


                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
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
                                                            <li class="mb-2">({{$package->address_going->full_country?$package->address_going->full_country->Phone:$package->address_going->phone}}) {{$package->address_going->phone}}</li>
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
                                                            <li class="mb-2">({{$package->address_from->full_country?$package->address_from->full_country->Phone:$package->address_from->phone}}) {{$package->address_from->phone}}</li>
                                                            <li class="mb-2">{{$package->address_from->email}}</li>
                                                        </ul>
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                                @if($support)

                                    <div class="container-xxl flex-grow-1 container-p-y">
                                        <div class="app-chat card overflow-hidden mb-5">
                                            <div class="row g-0">
                                                <!-- Chat History -->
                                                <div class="col app-chat-history  bg-body">
                                                    <div class="chat-history-wrapper">
                                                        <div class="chat-history-body bg-body" style="height: 100%;">
                                                            <ul class="list-unstyled chat-history">

                                                                <div class="text-center"> <span>{{$support->created_at->format('M-d-y')}}</span></div>


                                                                <li class="chat-message">
                                                                    <div class="d-flex overflow-hidden">
                                                                        <div class="user-avatar flex-shrink-0 me-3">
                                                                            <div class="avatar avatar-sm">
                                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                                     @php
                                                                         $userName = $support->user->name;
                                                                         $words = explode(' ', $userName);
                                                                     @endphp
                                                                    @foreach($words as $word)
                                                                        {{ strtoupper(substr(strtok($word, ' '), 0, 1)) }}
                                                                    @endforeach
                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-message-wrapper flex-grow-1">
                                                                            <div class="chat-message-text">
                                                                                <p class="mb-0">{{ $support->subject }}</p>
                                                                                <hr class="">
                                                                                <p class="mb-0">{!! nl2br(e($support->details)) !!}</p>

                                                                            </div>
                                                                            <div class="text-muted mt-1">
                                                                                <small>{{ $support->created_at->format('H:i A') }}</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>




                                                            </ul>
                                                        </div>
                                                        <!-- Chat message form -->
                                                    </div>
                                                </div>
                                                <!-- /Chat History -->
                                            </div>
                                        </div>
                                        <div class="app-chat card overflow-hidden">
                                            <div class="row g-0">
                                                <!-- Chat History -->
                                                <div class="col app-chat-history bg-body">
                                                    <div class="chat-history-wrapper">
                                                        <div class="chat-history-header border-bottom">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="d-flex overflow-hidden align-items-center">
                                                                    <i
                                                                        class="ti ti-menu-2 ti-sm cursor-pointer d-lg-none d-block me-2"
                                                                        data-bs-toggle="sidebar"
                                                                        data-overlay
                                                                        data-target="#app-chat-contacts"
                                                                    ></i>
                                                                    <div class="flex-shrink-0 avatar">
                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                @php
                                                    $userName = $support->user->name;
                                                    $words = explode(' ', $userName);
                                                @endphp
                                                @foreach($words as $word)
                                                    {{ strtoupper(substr(strtok($word, ' '), 0, 1)) }}
                                                @endforeach
                                            </span>
                                                                        <i
                                                                            class="ti ti-x ti-sm cursor-pointer close-sidebar"
                                                                            data-bs-toggle="sidebar"
                                                                            data-overlay
                                                                            data-target="#app-chat-sidebar-left"
                                                                        ></i>
                                                                    </div>
                                                                    <div class="chat-contact-info flex-grow-1 ms-2">
                                                                        <h6 class="m-0">{{$support->user->name}}</h6>
                                                                        <small class="user-status text-muted">member since :{{ $support->user->created_at->format('Y-m-d') }}</small>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    {{--                                        <i class="ti ti-phone-call cursor-pointer d-sm-block d-none me-3"></i>--}}
                                                                    {{--                                        <i class="ti ti-video cursor-pointer d-sm-block d-none me-3"></i>--}}
                                                                    {{--                                        <i class="ti ti-search cursor-pointer d-sm-block d-none me-3"></i>--}}
                                                                    <div class="dropdown">
                                                                        <i
                                                                            class="ti ti-dots-vertical cursor-pointer"
                                                                            id="chat-header-actions"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false"
                                                                        >
                                                                        </i>
                                                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                                                                            <a class="dropdown-item" href="{{route('users.edit',$support->user_id)}}">View User</a>
                                                                            <a class="dropdown-item" href="{{route('supports.status',[$support->id,0])}}">Convert To Pending</a>
                                                                            <a class="dropdown-item" href="{{route('supports.status',[$support->id,1])}}">Convert To Open</a>
                                                                            <a class="dropdown-item" href="{{route('supports.status',[$support->id,2])}}">Convert To Closed</a>
                                                                            <a class="dropdown-item" href="{{route('supports.status',[$support->id,3])}}">Convert To Solved</a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="chat-history-body bg-body">
                                                            <ul class="list-unstyled chat-history">
                                                                @foreach($messages as $date => $message_item )
                                                                    <div class="text-center"> <span>{{$date}}</span></div>
                                                                    @foreach($message_item as $message)
                                                                        @if($message->type=='admin')
                                                                            <li class="chat-message chat-message-right">
                                                                                <div class="d-flex overflow-hidden">
                                                                                    <div class="chat-message-wrapper flex-grow-1">
                                                                                        <div class="chat-message-text">
                                                                                            <p class="mb-0">{!! nl2br(e($message->details)) !!}</p>
                                                                                            @if($message->image!=null)
                                                                                                <p class="mb-0">
                                                                                                    <a href="{{env('SITE_URL').'public'.$message->image}}" class="text-white" target="_blank"><i class="fas fa-download"></i></a>
                                                                                                </p>
                                                                                            @endif

                                                                                        </div>
                                                                                        <div class="text-end text-muted mt-1">
                                                                                            <i class="ti ti-checks ti-xs me-1 text-success"></i>
                                                                                            <small>{{ $message->created_at->format('H:i A') }}</small>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="user-avatar flex-shrink-0 ms-3">
                                                                                        <div class="avatar avatar-sm">
                                                                                            {{--                                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />--}}
                                                                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                                @php
                                                                    $teamName = $message->team->name;
                                                                    $words = explode(' ', $teamName);
                                                                @endphp
                                                                                                @foreach($words as $word)
                                                                                                    {{ strtoupper(substr(strtok($word, ' '), 0, 1)) }}
                                                                                                @endforeach
                                                                </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endif
                                                                        @if($message->type=='user')
                                                                            <li class="chat-message">
                                                                                <div class="d-flex overflow-hidden">
                                                                                    <div class="user-avatar flex-shrink-0 me-3">
                                                                                        <div class="avatar avatar-sm">
                                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                                     @php
                                                                         $userName = $support->user->name;
                                                                         $words = explode(' ', $userName);
                                                                     @endphp
                                                                    @foreach($words as $word)
                                                                        {{ strtoupper(substr(strtok($word, ' '), 0, 1)) }}
                                                                    @endforeach
                                                                </span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="chat-message-wrapper flex-grow-1">
                                                                                        <div class="chat-message-text">
                                                                                            <p class="mb-0">{!! nl2br(e($message->details)) !!}</p>
                                                                                            @if($message->image!=null)
                                                                                                <p class="mb-0">
                                                                                                    <a href="{{env('SITE_URL').'public'.$message->image}}" class="text-black" target="_blank"><i class="fas fa-download"></i></a>
                                                                                                </p>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="text-muted mt-1">
                                                                                            <small>{{ $message->created_at->format('H:i A') }}</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach



                                                            </ul>
                                                        </div>
                                                        <!-- Chat message form -->
                                                        <div class="chat-history-footer shadow-sm">
                                                            <form class="form-send-message row"  id="mainAdd" method="post" action="javascript:void(0)">
                                                                <div class="fv-row mb-7 fv-plugins-icon-container col-md-10">
                                                                    <!--begin::Label-->
                                                                    <label class="required fw-bold fs-6 mb-2" for="details">{{__('Description')}}</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <textarea  id="details_text" class="form-control" rows="7" name="details"></textarea>
                                                                    <!--end::Input-->
                                                                </div>
                                                                {{--                                    <input class="form-control message-input border-0 me-3 shadow-none" placeholder="Type your message here">--}}
                                                                <div class="message-actions d-flex align-items-center col-md-2">
                                                                    {{--                                        <i class="speech-to-text ti ti-microphone ti-sm cursor-pointer"></i>--}}
                                                                    <label for="attach-doc" class="form-label mb-0">
                                                                        <i class="ti ti-photo ti-sm cursor-pointer mx-3"></i>
                                                                        <input type="file"  name="image" id="attach-doc" hidden />
                                                                    </label>
                                                                    <button class="btn btn-primary d-flex send-msg-btn" type="submit"  id="add_form">
                                                                        <i class="ti ti-send me-md-1 me-0"></i>
                                                                        <span class="align-middle d-md-inline-block d-none">Send</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Chat History -->
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="javascript:void(0)" method="post" name="add_ticket">
                                                <input type="hidden" name="package_id" id="package_id_ticket" value="{{$package->id}}" >
                                                <input type="hidden" name="type" id="type_ticket" value="7" >
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row add-address mx-md-auto md-5">

                                                        <div class="col-md-12 col-12">
                                                            <div class="mb-3">
                                                                <label for="subject">{{__('Subject')}}</label>
                                                                <input type="text" id="subject" name="subject" autocomplete="off" class="form-control" placeholder="{{__('Subject')}}" aria-label="Company Name (Optional)" aria-describedby="Company Name (Optional)">
                                                                <div id="counter" class="form-text">0/100 characters</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="mb-3">
                                                                <label for="details">{{__('Comment')}}</label>
                                                                <textarea name="details" class="form-control" id="details"  rows="10"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('Close')}}</button>
                                                    <button type="submit" class="btn btn-success" id="send">{{__('Submit')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif



                            </div>

                        </div>
                    </div>

                </div>
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
    <script src="{{asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-rowgroup/datatables.rowgroup.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.js')}}"></script>

    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>--}}
    {{--    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>--}}
    {{--    <script src="{{asset('/assets/js/app-user-view-security.js')}}"></script>--}}
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/app-chat.js')}}"></script>
    <script>

        var data_url_table='{{ route('users.get_user_orders',$user->id)}}'

        var dt;
        $(function() {

            dt= $('.datatable').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: data_url_table,
                columns: [
                    { data: 'order_no', name: 'order_no' },
                    { data: 'shipping_method', name: 'shipping_method' },
                    { data: 'dimensions', name: 'dimensions' },
                    { data: 'type_pay', name: 'type_pay' },
                    { data: 'cost', name: 'cost' },
                    { data: 'status', name: 'status' },
                    { data: 'shipping_date', name: 'shipping_date' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ],
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],

                language: {
                    "lengthMenu": "{{__('Show')}} _MENU_ {{__('entries')}}",
                    "processing":     "{{__('Processing...')}}",
                    "search":         "{{__('Search:')}}",
                    "info":           "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
                    "zeroRecords":    "{{__('No matching records found')}}",
                    "emptyTable":     "{{__('No data available in table')}}",
                    "infoEmpty":      "{{__('Showing')}} 0 {{__('to')}} 0 {{__('of')}} 0 {{__('entries')}}",
                    "infoFiltered":   "({{__('filtered from')}} _MAX_ {{__('total entries')}} )",
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
            });

        });


    </script>
    @if($support)
        <script>

            var data_url='{{ route('supports.send_reply',$support->id)}}'

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
                        // postData.append('details', CKEDITOR.instances['details'].getData());
                        // console.log(postData)
                        $('#add_form').html('');
                        $('#add_form').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                            '<span class="ml-25 align-middle">{{__('Saving')}}...</span>');
                        $.ajax({
                            url: data_url,
                            type: "POST",
                            data: postData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $('#add_form').empty();
                                $('#add_form').html('{{__('Save')}}');
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
                                location.reload()
                                $('.custom-error').remove();

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
    @endif

    <script>
        $(document).ready(function(){


            var url = window.location.href;
            var activeTab = url.substring(url.indexOf("#") + 1);
            // alert(url)
            // alert(activeTab)
            if(url === activeTab){
                $(".tab-pane").removeClass("active in");
                $("#info").addClass("active in");
                $('a[href="#info"]').tab('show')
                parent.location.hash = "info";

            }else{
                $(".tab-pane").removeClass("active in");
                $("#" + activeTab).addClass("active in");
                $('a[href="#'+ activeTab +'"]').tab('show');
                // parent.location.hash = activeTab;
            }
        });

        function nav_link(value){
            parent.location.hash = value;
        }
    </script>










@endsection
