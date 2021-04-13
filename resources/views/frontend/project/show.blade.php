@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Projekt megtekintése</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="name">Projekt neve:</label>
                        <input type="text" id="name" name="name" value="{{$project->name}}"
                               class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="description">Projekt leírása:</label>
                        <input type="text" id="description" name="description" value="{{$project->description}}"
                               class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        Státusz:
                        <select name="status_id" class="form-control" disabled>
                            <option value="" selected>Kérem válasszon!</option>
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}"
                                    {{$status->id==$project->status->id ? 'selected': ''}}>
                                    {{$status->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="created_at">Létrehozás dátuma:</label>
                        <input type="text" id="created_at" name="created_at" value="{{$project->created_at}}"
                               class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="updated_at">Módosítás dátuma:</label>
                        <input type="text" id="updated_at" name="updated_at" value="{{$project->updated_at}}"
                               class="form-control" disabled>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{route('project.index')}}">Vissza a listához</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
