@if(isset($tracking))
    @if(isset($tracking['events']))
        <div class="card mb-4">
            <h5 class="card-header">Tracking</h5>
            <div class="card-body pb-0">
                <ul class="timeline mb-0">
                    @foreach($tracking['events'] as $item)
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
@endif
