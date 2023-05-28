@extends('frontend.layouts.app')

@section('content')
    <livewire:frontend.home-component :sliders="$sliders" :fproducts="$fproducts" :tproducts="$tproducts" :nproducts="$nproducts" :subcategories="$subcategories" :brands="$brands" />
@endsection
