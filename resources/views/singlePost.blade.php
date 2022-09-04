@extends('layouts.app')

@section('content')

    @include('layouts.mediaSlider')
    @include('layouts.softSlider')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12">
                @include('layouts.lastSofts')
                @include('layouts.singlePost')
            </div>
            <div class="col-md-4 d-none d-md-block">
                @include('layouts.sidbar')
            </div>
        </div>
    </div>
@endsection
