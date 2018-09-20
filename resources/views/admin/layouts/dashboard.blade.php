@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.layouts.sidebar')
        </div>
        <div class="col-9">
            @yield('main-page')
        </div>
    </div>
@endsection