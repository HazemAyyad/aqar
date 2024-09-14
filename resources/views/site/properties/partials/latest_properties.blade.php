<div class="widget-box bg-surface box-latest-property">
    <div class="h7 fw-7 title">{{__('Latest Properties')}}</div>
    <ul>
        @foreach($latestProperties as $property)
            <li class="latest-property-item">
                @php
                    $imagePath = asset($property->images[0]->img);
                    $correctedImagePath = str_replace('/public/public/', '/public/', $imagePath);
                @endphp
                <a href="{{ route('site.property.show', $property->slug) }}" class="images-style">
                    <img src="{{$correctedImagePath}}" alt="{{ $property->title }}">
                </a>
                <div class="content">
                    <div class="h7 text-capitalize fw-7">
                        <a href="{{ route('site.property.show', $property->slug) }}" class="link">{{ Str::limit($property->title, 20) }}</a>
                    </div>
                    <ul class="meta-list">
                        <li class="item">
                            <span>Bed:</span>
                            <span class="fw-7">{{ $property->more_info->bedrooms }}</span>
                        </li>
                        <li class="item">
                            <span>Bath:</span>
                            <span class="fw-7">{{ $property->more_info->bathrooms }}</span>
                        </li>
                        <li class="item">
                            <span class="fw-7">{{ $property->more_info->size }} m²</span>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <div class="h7 fw-7">${{ $property->price->price }}</div>
                        <span class="text-variant-1">/m²</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
