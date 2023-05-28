@extends('frontend.layouts.app')

@section('content')
    <livewire:frontend.shop-component :allproducts="$allproducts" :categories="$categories" :subcategories="$subcategories" :nproducts="$nproducts" />
@endsection
