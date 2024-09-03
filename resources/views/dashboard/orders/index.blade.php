@extends('dashboard.layouts.app')
@section('style')

    <!-- BEGIN: Vendor CSS-->

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />

    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}" />
    <!-- Form Validation -->
    <style>
        .card{
            padding: 1.5rem !important;
        }
    </style>
    @if(App::isLocale('en'))
    @else

    @endif
    <link rel="stylesheet" href="{{asset('assets/css/form-validation.css')}}" />
@endsection
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">{{__('Home')}}</a>
                </li>
                <li class="breadcrumb-item active">{{__('Orders')}}</li>
                <!-- Basic table -->


                <!--/ Basic table -->
            </ol>
        </nav>
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <div class="table-responsive mb-3">
                    <table class="table datatable border-top">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>User</th>
                            @if($status!=0)
                                <th>tracking number</th>
                            @endif
                            <th>Shipping Method</th>
                            <th>Dimensions</th>
                            @if($status!=0)
                                <th>Type Pay</th>
                            @endif
                            @if($status==0)
                                <th>Last Step</th>
                            @endif
                            <th>Cost</th>
                            @if($status==0)
                                <th>Admin Discount</th>
                                <th>Additional Cost</th>
                            @endif
                            @if(! in_array($status,[0,1]))
                                <th>Status</th>
                            @endif
                            @if($status!=0)
                            <th>To</th>
                            @endif
                            <th>Ship Date</th>

                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <div class="modal fade " id="modalAdminDiscount" tabindex="-1"   aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Admin Discount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="mainAdd" method="post" action="javascript:void(0)" >
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="order_id" name="order_id">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Discount</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number"   class="form-control" id="admin_discount" name="admin_discount" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="add_form">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade " id="modalAdditionalCost" tabindex="-1"   aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Additional Cost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCost" method="post" action="javascript:void(0)" >
                    <input type="text" class="form-control" name="package_id" id="package_id" value=" "  hidden="">

                    <div class="modal-body">
                        <div class="row">
                            <div class='repeater'>
                                <div data-repeater-list="additional_cost" id="additional_cost_div">

                                        <div data-repeater-item class="row mb-3  ">

                                            <div class="col-md-8 my-2">
                                                <label for="">{{__('Name :')}}</label>
                                                <div class="input-group my-2">

                                                    <input type="text" required class="form-control" name="name" value=" "  placeholder="{{__('Name :')}}" aria-label="add"
                                                           aria-describedby="basic-addon1">

                                                </div>

                                            </div>
                                            <div class="col-md-2 my-2">
                                                <div class="div_dimension">
                                                    <div class="div_item_dimension">
                                                        <label for="us_zip_code">{{__('Cost:')}}</label>
                                                        <div class="input-group my-2">

                                                            <input type="text" required id="length" value=" " name="cost" class="form-control"
                                                                   placeholder="{{__('Cost')}}"  >
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-md-2 my-2">
                                                <label for="us_zip_code"   style="visibility: hidden;" >{{__('delete')}}</label>
                                                <div class="input-group my-2">
                                                    <button type="button" class="btn btn-label-danger  " data-repeater-delete=" " data-id=" ">
                                                        <i class="ti ti-x ti-xs me-1"></i>

                                                    </button>

                                                </div>

                                            </div>



                                        </div>


                                </div>
                                <div class="mb-0">
                                    <button type="button" class="btn btn-primary" data-repeater-create>
                                        <i class="ti ti-plus me-1"></i>
                                        <span class="align-middle">Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="add_form_cost">Save changes</button>
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
    <script src="{{asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-rowgroup/datatables.rowgroup.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script>
        $(document).ready(function () {
            var formRepeater = $('.repeater');
            formRepeater.on('submit', function (e) {
                e.preventDefault();
            });
            formRepeater.repeater({
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
                    'text-input': 'foo'
                },
                // (Optional)
                // "show" is called just after an item is added.  The item is hidden
                // at this point.  If a show callback is not given the item will
                // have $(this).show() called on it.
                show: function () {
                    $(this).slideDown();
                },
                // (Optional)
                // "hide" is called when a user clicks on a data-repeater-delete
                // element.  The item is still visible.  "hide" is passed a function
                // as its first argument which will properly remove the item.
                // "hide" allows for a confirmation step, to send a delete request
                // to the server, etc.  If a hide callback is not given the item
                // will be deleted.
                hide: function (deleteElement) {
                    // console.log($(this).find('input.btn.btn-danger').data('id'));
                    //     alert($(this).attr("data-id"));
                    if(confirm('Are you sure you want to delete this element?')) {

                        $(this).slideUp(deleteElement);
                    }
                },
                // (Optional)
                // You can use this if you need to manually re-index the list
                // for example if you are using a drag and drop library to reorder
                // list items.
                ready: function (setIndexes) {
                },
                // (Optional)
                // Removes the delete button from the first list item,
                // defaults to false.
                isFirstItemUndeletable: true
            })
        });
    </script>
    <script>
        function modalAdminDiscount(button) {
            var order_id = button.getAttribute('data-id');
            var admin_discount = button.getAttribute('data-discount');
            $('#order_id').val(order_id)
            $('#admin_discount').val(admin_discount)
            // Do something with the customAttribute value


            // Open the modal programmatically
            var targetModal = document.getElementById('modalAdminDiscount');
            var bootstrapModal = new bootstrap.Modal(targetModal);
            bootstrapModal.show();
        }

    </script>
    <script>
        function modalAdditionalCost(button) {
            var package_id = button.getAttribute('data-id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'GET',
                url: "{{route('orders.get_additional_cost','')}}"+'/'+package_id,


                success: function (response) {
                    var count_packages=response.packages.length
                    if(count_packages>=1){
                        var html='';
                        jQuery.each(response.packages, function(index, item) {
                             html +='' +
                                '<div data-repeater-item class="row mb-3  ">'+

                                '<div class="col-md-8 my-2">'+
                                '<label for=""> Name  </label>'+
                                '<div class="input-group my-2">'+

                                    '<input type="text" class="form-control" name="name" value="'+item['name']+'"  placeholder=" Name " aria-label="add" aria-describedby="basic-addon1">'+

                               ' </div>'+

                        '</div>'+
                            '<div class="col-md-2 my-2">'+
                                '<div class="div_dimension">'+
                                    '<div class="div_item_dimension">'+
                                        '<label for="us_zip_code"> Cost </label>'+
                                        '<div class="input-group my-2">'+

                                            '<input type="text" id="length" value="'+item['cost']+'" name="cost" class="form-control" placeholder=" Cost "  >'+
                                        '</div>'+
                                    '</div>'+


                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 my-2">'+
                                '<label for="us_zip_code"   style="visibility: hidden;" > delete </label>'+
                                '<div class="input-group my-2">'+
                                    '<button type="button" class="btn btn-label-danger  " data-repeater-delete=" " data-id=" ">'+
                                        '<i class="ti ti-x ti-xs me-1"></i>'+

                                    '</button>'+

                                '</div>'+

                            '</div>'+



                        '</div>';

                        });
                        $('#additional_cost_div').empty();
                        $('#additional_cost_div').append(html);

                    }else {
                        var html='';

                            html +='' +
                                '<div data-repeater-item class="row mb-3  ">'+

                                '<div class="col-md-8 my-2">'+
                                '<label for=""> Name  </label>'+
                                '<div class="input-group my-2">'+

                                '<input type="text" class="form-control" required name="additional_cost['+index+'][name]" value=""  placeholder=" Name " aria-label="add" aria-describedby="basic-addon1">'+

                                ' </div>'+

                                '</div>'+
                                '<div class="col-md-2 my-2">'+
                                '<div class="div_dimension">'+
                                '<div class="div_item_dimension">'+
                                '<label for="us_zip_code"> Cost </label>'+
                                '<div class="input-group my-2">'+

                                '<input type="number" id="length" value="" min="0" required name="additional_cost['+index+'][cost]" class="form-control" placeholder=" Cost "  >'+
                                '</div>'+
                                '</div>'+


                                '</div>'+
                                '</div>'+
                                '<div class="col-md-2 my-2">'+
                                '<label for="us_zip_code"   style="visibility: hidden;" > delete </label>'+
                                '<div class="input-group my-2">'+
                                '<button type="button" class="btn btn-label-danger  " data-repeater-delete=" " data-id=" ">'+
                                '<i class="ti ti-x ti-xs me-1"></i>'+

                                '</button>'+

                                '</div>'+

                                '</div>'+



                                '</div>';


                        $('#additional_cost_div').empty();
                        $('#additional_cost_div').append(html);
                    }



                    // swal.fire("Error!", response.msg, "error");
                    }

            });
            // Do something with the customAttribute value
            $('#package_id').val(package_id)

            // Open the modal programmatically
            var targetModal = document.getElementById('modalAdditionalCost');
            var bootstrapModal = new bootstrap.Modal(targetModal);
            bootstrapModal.show();
        }

    </script>
    <script>

        var data_url_table='{{ route('orders.get_orders',$status)}}'

        var dt;
        $(function() {

            dt= $('.datatable').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: data_url_table,
                columns: [
                        @if($status==0)
                    { data: 'id', name: 'id' },
                        @else
                    { data: 'order_no', name: 'order_no' },
                        @endif

                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'user', name: 'user' },
                        @if($status!=0)
                    { data: 'tracking_number', name: 'tracking_number' },
                        @endif
                    { data: 'shipping_method', name: 'shipping_method' },
                    { data: 'dimensions', name: 'dimensions' },
                        @if($status!=0)
                    { data: 'type_pay', name: 'type_pay' },
                        @endif
                        @if($status==0)
                    { data: 'last_step', name: 'last_step' },
                        @endif
                    { data: 'cost', name: 'cost' },
                        @if($status==0)
                    { data: 'admin_discount', name: 'admin_discount' },
                    { data: 'additional_cost', name: 'additional_cost' },
                        @endif
                        @if(! in_array($status,[0,1]))

                    { data: 'status', name: 'status' },
                        @endif
                        @if($status!=0)
                    { data: 'address_to', name: 'address_to' },
                    @endif
                    { data: 'shipping_date', name: 'shipping_date' },

                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ],
                @if($status!=1)
                order: [],//[0, 'desc']
                @else
                order: [],
                @endif
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
    <script type="text/javascript">
        function deleteItem(id) {

            var data_url_delete='{{ route('users.delete','')}}'+'/'+id

            swal.fire({
                title: "{{__('Delete?')}}",
                text: "{{__('Please confirm approval')}}",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "{{__('Yes, delete!')}}",
                cancelButtonText: "{{__('No, back off!')}}",
                confirmButtonColor: "#DD6B55",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'delete',
                        url: data_url_delete,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (response) {

                            if (response.status === true) {
                                swal.fire("Done!", response.msg, "success");
                                $('.datatables-basic').DataTable().ajax.reload();

                            } else {
                                swal.fire("Error!", response.msg, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }
    </script>
    <script>

        $(document).on("change", "#status", function() {
            var data_url_create_section='{{route('orders.status')}}'
            // e.preventDefault()
            var postData = new FormData(this.form);
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
                        complete: function () {
                            // unblock when remote call returns

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
                                        message: '<p class="mb-0">Almost Not Done...</p>',
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
                                                message: '<div class="p-3 bg-danger">Error</div>',
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
                        }
                    });
                }else {
                    document.querySelectorAll("#status").forEach(v => {
                        v.value = "{{$status}}";
                    })
                }


            }, function (dismiss) {


                return false;
            })

        });
    </script>
    <script>

        var data_url='{{ route('orders.admin_discount_store')}}'

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
                        url: data_url,
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('.datatable').DataTable().ajax.reload();
                            $('#modalAdminDiscount').modal('hide')
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
    <script>

        var additional_cost_store='{{ route('orders.additional_cost_store')}}'

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

            $(document).on("click", "#add_form_cost", function() {
                var additional_cost_store_form = $(this.form);
                if(! additional_cost_store_form.valid()) {
                    return false
                };
                if (additional_cost_store_form.valid()) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    });
                    var additional_cost_store_data = new FormData(this.form);


                    $('#add_form').html('');
                    $('#add_form').append('<span class="spinner-border spinner-border-sm align-middle ms-2"></span>' +
                        '<span class="ml-25 align-middle">{{__('Saving')}}...</span>');
                    $.ajax({
                        url: additional_cost_store,
                        type: "POST",
                        data: additional_cost_store_data,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('.datatable').DataTable().ajax.reload();
                            $('#modalAdditionalCost').modal('hide')
                            $('#add_form_cost').html('{{__('Save')}}');
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
                            $('#add_form_cost').empty();
                            $('#add_form_cost').html('{{__('Save')}}');
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
