@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projektek</h3>

                    <div class="card-tools">
                        @if($numberOfStatutes>0)
                            <a href="{{route('project.create')}}" class="btn btn-primary">
                                Projekt létrehozása
                            </a>
                        @else
                            <p>Projekt létrehozása nem lehetséges. Kérem töltse fel az adatázist státusszokkal.</p>
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    @include('frontend.layout.message')
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Név</th>
                            <th>Leírás</th>
                            <th>Állapot</th>
                            <th>Létrehozás dátuma</th>
                            <th>Módosítás dátuma</th>
                            <th>Megtekintés/Módosítás</th>
                            <th>Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr id="project-{{$project->id}}">
                                <td>{{$project->id}}</td>
                                <td>{{$project->name}}</td>
                                <td>{{$project->description}}</td>
                                <td>{{$project->status->name}}</td>
                                <td>{{$project->created_at}}</td>
                                <td>{{$project->updated_at}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route('project.show', $project->id)}}"
                                           class="btn btn-info btn-sm">Megtekintés</a>
                                        <a href="{{route('project.edit', $project->id)}}"
                                           class="btn btn-secondary btn-sm">Módosítás</a>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger del-project-button"
                                            data-token="{{csrf_token()}}"
                                            data-id="{{$project->id}}"
                                            data-url="{{route('project.destroyWithJson', $project->id)}}">
                                        Törlés
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($projects)==0)
                            <td colspan="7">
                                <p class="text-center font-weight-bold">Projektet nem tartalmaz a rendszer</p>
                            </td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
