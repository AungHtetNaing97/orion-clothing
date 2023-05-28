@extends('frontend.layouts.app')

@section('content')
    <livewire:frontend.details-component :product="$product" :variants="$variants" :rproducts="$rproducts" :subcategories="$subcategories" :nproducts="$nproducts" />
@endsection
