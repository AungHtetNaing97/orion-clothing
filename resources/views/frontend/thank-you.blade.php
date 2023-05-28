@extends('frontend.layouts.app')

@section('titles', 'Thank You for Shopping with Us')

@section('content')
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="p-4 bg-white" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                        <img class="m-2" src="{{ asset('storage/admin/backend/settings/' . $appSetting->image) }}"
                        alt="{{ $appSetting->name ?? 'website name' }}">
                        <h4 class="m-2">&#x2764;&#xfe0f; Thank You for Shopping with {{ $appSetting->name ?? 'website name' }} &#x2764;&#xfe0f;</h4>
                        <a href="{{ url('shop') }}" class="btn btn-primary m-2">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
