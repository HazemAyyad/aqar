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
                <li>/ Frequently Asked Questions</li>
            </ul>
            <h2 class="text-center">FAQs</h2>
        </div>
    </section>
    <!-- End Page Title -->

    <section class="flat-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @php
                        $categories = [
                            0 => 'Overview',
                            1 => 'Costs and Payments',
                            2 => 'Safety and Security',
                            3 => 'Other'
                        ];
                    @endphp

                    @foreach($categories as $category_id => $category_name)
                        @php
                            // Filter FAQs for the current category using Collection's filter method
                            $filteredFaqs = $faqs->filter(function($faq) use ($category_id) {
                                return $faq->category_id == $category_id;
                            });
                        @endphp

                        @if($filteredFaqs->isNotEmpty())
                            <div class="tf-faq">
                                <h5>{{ $category_name }}</h5>
                                <ul class="box-faq" id="wrapper-faq-{{ $category_id }}">
                                    @foreach($filteredFaqs as $faq)
                                        <li class="faq-item">
                                            <a href="#accordion-faq-{{ $faq->id }}" class="faq-header collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-faq-{{ $faq->id }}">
                                                {{ $faq->title_en }}
                                            </a>
                                            <div id="accordion-faq-{{ $faq->id }}" class="collapse" data-bs-parent="#wrapper-faq-{{ $category_id }}">
                                                <p class="faq-body">
                                                    {{ $faq->answer_en }}
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <!-- Add your scripts here if needed -->
@endsection
