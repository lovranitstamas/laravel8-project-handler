@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projekt státuszok</h3>

                    <div class="card-tools">
                        <a href="{{route('status.create')}}" class="btn btn-primary">Státusz létrehozása</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Azonosító</th>
                            <th>Név</th>
                            <th>Létrehozás dátuma</th>
                            <th>Módosítás dátuma</th>
                            <th>Megtekintés/Módosítás</th>
                            <th>Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <td>{{$status->id}}</td>
                                <td>{{$status->name}}</td>
                                <td>{{$status->created_at}}</td>
                                <td>{{$status->updated_at}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route('status.show', $status->id)}}"
                                           class="btn btn-info btn-sm">Megtekintés</a>
                                        {{--['id' => $category->id]--}}
                                        @if($status->projects()->count()==0)
                                            <a href="{{route('status.edit', $status->id)}}"
                                               class="btn btn-secondary btn-sm">Módosítás</a>
                                        @else
                                            | Projekthez rendelves
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($status->projects()->count()==0)
                                        <form action="{{route('status.destroy', $status->id)}}" method="POST">
                                            <input type="hidden" name="_method" value="delete">
                                            @csrf
                                            <input type="submit" name="button" value="Törlés" class="btn btn-danger">
                                        </form>
                                    @else
                                        Projekthez rendelve
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if (count($statuses)==0)
                            <td colspan="6"><h4 class="text-center font-weight-bold">A lista üres</h4></td>
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
