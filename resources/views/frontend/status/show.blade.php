@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Státusz megtekintése</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="name" class="font-weight-bold">Név:</label>
                        <input type="text" id="name" name="name" value="{{$status->name}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="created_at" class="font-weight-bold">Létrehozás dátuma:</label>
                        <input type="text" name="created_at" id="created_at" value="{{$status->created_at}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="updated_at" class="font-weight-bold">Módosítás dátuma:</label>
                        <input type="text" name="updated_at" id="updated_at" value="{{$status->updated_at}}" disabled
                               class="form-control">
                    </div>

                    <div class="box-footer">
                        <div class="form-group">
                            <a class="btn btn-primary" href="{{route('status.index')}}">Vissza a listához</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
