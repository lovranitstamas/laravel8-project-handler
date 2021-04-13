@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Státusz létrehozása</h3>
                </div>
                @include('frontend.layout.message')
                @include('frontend.status.form')
            </div>
        </div>
    </div>
@stop
