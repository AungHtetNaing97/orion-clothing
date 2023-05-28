@extends('frontend.layouts.app')

@section('content')
    <livewire:frontend.product-component :subcategory="$subcategory" />
@endsection
