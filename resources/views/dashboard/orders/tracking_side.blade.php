@if(isset($tracking['events']))
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="h6">{{__('Estimated Delivery Date')}}</h3>
            <p class="delivery-day">{{date('l', strtotime($tracking['estimated_delivery_date'])) }}</p>
            <h4 class="delivery-month">{{date('F', strtotime($tracking['estimated_delivery_date'])) }}</h4>
            <h4 class="delivery-day-no">{{date('j', strtotime($tracking['estimated_delivery_date'])) }}</h4>                            </div>
    </div>
    <div class="card mb-4">
        <!-- Shipping information -->
        <div class="card-body">
            <h3 class="h6">Shipping Information</h3>
            <strong>{{$package->shipping_method}}</strong>
            <p>
                @if($tracking['status_code']=='AC')
                    {{__('Accepted')}}
                @elseif($tracking['status_code']=='IT')
                    {{__('In Transit')}}
                @elseif($tracking['status_code']=='DE')
                    {{__('Delivered')}}
                @elseif($tracking['status_code']=='EX')
                    {{__('Exception')}}
                @elseif($tracking['status_code']=='UN')
                    {{__('Unknown')}}
                @elseif($tracking['status_code']=='AT')
                    {{__('Delivery Attempt')}}
                @elseif($tracking['status_code']=='NY')
                    {{__('Not Yet In System')}}
                @else
                    {{__('Unknown')}}
                @endif
            </p>

            <p class="track_number">{{__('Tracking:')}} <a href="{{$tracking['tracking_url']}}" class="link">{{$package->tracking_number}}</a></p>


        </div>
    </div>
@endif
