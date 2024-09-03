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

                                    <tr class="fw-bold">
                                        <td colspan="2">TOTAL</td>
                                        <td class="text-end">${{$package->cost_protection+$package->shipping_cost-$package->promo_code_value}}</td>
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
                                            <span class="text-muted d-block">weight (L x W x H)</span>
                                            @if($package->type_v==0)
                                                @if($item->parent==0)
                                                    <span class="fw-bold d-block">{{$package->weight}} lbs ({{$package->length}} in x {{$package->width}} in x {{$package->height}} in)</span>
                                                @else
                                                    <span class="fw-bold d-block">{{$package->multi_package[(($item->parent) - 1)]['weight']}} lbs ({{$package->multi_package[(($item->parent) - 1)]['length']}} in x {{$package->multi_package[(($item->parent) - 1)]['width']}} in x {{$package->multi_package[(($item->parent) - 1)]['height']}} in)</span>

                                                @endif
                                            @else
                                                <span class="fw-bold d-block">
                                                {{$item->package->weight}} {{$item->package->unit_weight=='1'?'lbs':'KG'}} ({{ $item->package->length}}  x {{$item->package->width}}  x {{$item->package->height}} ){{$item->package->unit_dimension=='1'?'in':'cm'}} {{$item->package->qty}}
                                            </span>
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
                    </div>
                    <div class="col-lg-4">
                        <!-- Customer Notes -->

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
    {{--    update User--}}
    <script>

        var data_url_user='{{ route('users.update',$user->id)}}'

        $(document).ready(function() {
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

            $("#editUserForm").submit(function() {
                let myform  =  $('#editUserForm');

                if(!myform.valid() ) {
                    return false
                };
                if (myform.valid()) {
                    var postData = new FormData($( 'form#editUserForm' )[ 0 ]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    $('#user_update').html('');
                    $('#user_update').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('Saving')}}...</span>');
                    $.ajax({
                        url: data_url_user,
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('#user_update').html('{{__('Save')}}');
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
                            $('#user_update').empty();
                            $('#user_update').html('{{__('Save')}}');
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
    {{--    update Password--}}
    <script>

        var data_url='{{ route('users.update_password',$user->id)}}'

        $(document).ready(function() {
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

            $("#formChangePassword").submit(function() {
                let myform  =  $('#formChangePassword');

                if(!myform.valid() ) {
                    return false
                };
                if (myform.valid()) {
                    var postData = new FormData($( 'form#formChangePassword' )[ 0 ]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    $('#update_password').html('');
                    $('#update_password').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('Saving')}}...</span>');
                    $.ajax({
                        url: data_url,
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('#update_password').html('{{__('Save')}}');
                            setTimeout(function () {
                                toastr['success'](
                                    response.success,
                                    {
                                        closeButton: true,
                                        tapToDismiss: false
                                    }
                                );
                                win
                            }, 200);
                            myform[0].reset()
                            $('.custom-error').remove();

                        },
                        error: function (data) {
                            $('.custom-error').remove();
                            $('#update_password').empty();
                            $('#update_password').html('{{__('Save')}}');
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
