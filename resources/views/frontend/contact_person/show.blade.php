@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Kapcsolattartó megtekintése</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="name">Kapcsolattartó neve:</label>
                        <input type="text" id="name" name="name" value="{{$contactPerson->name}}"
                               class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail cím:</label>
                        <input type="text" id="email" name="email" value="{{$contactPerson->email}}"
                               class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="created_at">Létrehozás dátuma:</label>
                        <input type="text" id="created_at" name="created_at" value="{{$contactPerson->created_at}}"
                               class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="updated_at">Módosítás dátuma:</label>
                        <input type="text" id="updated_at" name="updated_at" value="{{$contactPerson->updated_at}}"
                               class="form-control" disabled>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{route('contact_person.index')}}">Vissza a listához</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
