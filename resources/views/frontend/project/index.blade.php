@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projektek</h3>

                    <div class="card-tools">
                        @if($numberOfStatutes>0 && $users>0)
                            <a href="{{route('project.create')}}" class="btn btn-primary">
                                Projekt létrehozása
                            </a>
                        @else
                            <p>Projekt létrehozása nem lehetséges. Projekt státusz és/vagy kapcsolattartó nem
                                található a rendszerben.</p>
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form action="{{route('project.index')}}" method="GET">
                        <input type="text" class="form-control w-25"
                               name="search[status][name]"
                               value="{{request()->input('search.status.name')}}"
                               placeholder="Státusz"><br>
                        <input role="button" type="submit" class="btn btn-primary btn-sm" value="Keresés">
                        <a role="button" class="btn btn-default" href="{{route('project.index')}}"
                           title="Keresési feltételek törlése"><i class="fa fa-sync"></i></a>
                    </form>
                    @include('frontend.layout.message')
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <!--<th>#</th>-->
                            <th>Név</th>
                            <!--<th>Leírás</th>-->
                            <th>Státusz</th>
                            <th>Kapcsolattartók száma</th>
                            <!--<th>Létrehozás dátuma</th>
                                <th>Módosítás dátuma</th>-->
                            <th>Szerkesztés</th>
                            <th>Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr id="project-{{$project->id}}">
                                <!--<td>{{$project->id}}</td>-->
                                <td>{{$project->name}}</td>
                                <!--<td>{{$project->description}}</td>-->
                                <td>{{$project->status->name}}</td>
                                <td>
                                    @if(count($project->users()->pluck('name')->toArray())>0)
                                        {{--@foreach($project->users()->pluck('name')->toArray() as
                                           $name)
                                            {{$name}}<br>
                                        @endforeach--}}
                                        {{count($project->users()->pluck('name')->toArray())}}
                                    @else
                                        Nincs kapcsolattartó
                                    @endif
                                </td>
                                <!--<td>{{$project->created_at}}</td>
                                <td>{{$project->updated_at}}</td>-->
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
                    {{$projects->links('pagination::bootstrap-4')}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
