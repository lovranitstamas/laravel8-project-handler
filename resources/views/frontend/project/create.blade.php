@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1>Projekt feltöltése</h1>
                </div>
                @include('frontend.layout.message')
                @include('frontend.project.form')
            </div>
        </div>
    </div>
@stop
