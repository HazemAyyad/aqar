@extends('site.layouts.app')

@section('style')
    <!-- Add your styles here if needed -->
@endsection

@section('content')
    <!-- Page Title -->
    <section class="flat-title-page style-2">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>/ Pages</li>
                <li>/ Privacy Policy</li>
            </ul>
            <h2 class="text-center">Privacy Policy</h2>
        </div>
    </section>
    <!-- End Page Title -->
    <section class="flat-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <ul class="nav-tab-privacy" role="tablist">
                        @foreach($categories as $index => $category)
                            <li class="nav-tab-item" role="presentation">
                                <a href="#category-{{ $index }}" class="nav-link-item {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="tab">
                                    {{ $loop->iteration }}. {{ $category }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-7">
                    <h5 class="text-capitalize title">{{ __('Terms of use') }}</h5>
                    <div class="tab-content content-box-privacy">
                        @foreach($categories as $index => $category)
                            <div class="tab-pane fade {{ $index == 0 ? 'active show' : '' }}" id="category-{{ $index }}" role="tabpanel">
                                <h6>{{ $loop->iteration }}. {{ $category }}</h6>
                                @foreach($policies as $policy)
                                    @if($policy->category_id == $index)
                                        <p>{!! nl2br(e($policy->answer_en)) !!}</p>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection

@section('scripts')
    <!-- Add your scripts here if needed -->
@endsection
