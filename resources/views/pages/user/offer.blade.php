@extends('layouts.mobile')
@section('template_title')
    Dashboard
@endsection

@section('template_linked_css')
    <link rel="stylesheet" href="{!! asset('css/card.css') !!}"/>
    <style>
        .card {
            padding: 10px !important;
            height: 300px;
        }

    </style>
@endsection

@section('content')
    <input type="hidden" id="retailer" value="{!! $retailer !!}"/>
    <input type="hidden" id="department" value="{!! $department !!}"/>
    <input type="hidden" id="type" value="{!! $type !!}"/>
    <input type="hidden" id="price" value="{!! $price !!}"/>
    <input type="hidden" id="discount" value="{!! $discount !!}"/>
    <div class="container" style="margin-top: 10px;">
        <h5> {!! $total_results !!} Total Results</h5>
        <div class="row" id="list-offers">
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{!! asset('js/promise.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/fetch.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/offers.js') !!}"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.srcset = lazyImage.dataset.srcset;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            } else {
                // Possibly fall back to a more compatible method here
            }
        });
    </script>
@endsection