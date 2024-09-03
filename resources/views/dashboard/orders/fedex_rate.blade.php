@if(isset($fedex_rates))

        <div class="col-md-12">
            <h2>Fedex Rates</h2>
        </div>
        @if(isset($fedex_rates['rate_response']))
            @foreach($fedex_rates['rate_response']['rates'] as $rate)
                <div class="col-md-4  {{$loop->first?'mb-md-0 mb-2':''}}">
                    <div class="form-check form-group custom-option custom-option-basic mb-2">
                        <label class="form-check-label custom-option-content"
                               for="serviceName_{{$loop->index+1}}">
                            <input name="serviceName" class="form-check-input" type="radio"
                                   value="{{$rate['service_code']}}" onclick="shippingCompany('FEDEX')" id="serviceName_{{$loop->index+1}}" required>
                            <span class="custom-option-header">
                                                        <span class="h6 mb-0">{{$rate['service_type']}}</span>
                                                      </span>
                            <span class="custom-option-body">
                                                        <small>${{$rate['shipping_amount']['amount']+$rate['other_amount']['amount']}}</small>
                                                  </span>
                        </label>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($fedex_rates['errors'] as $item)
                {{$item['message']}}<br>
            @endforeach
        @endif


@endif
