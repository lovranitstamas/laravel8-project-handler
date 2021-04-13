@extends('frontend.layout.default-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kapcsolattartók</h3>

                    <div class="card-tools">
                        <a href="{{route('contact_person.create')}}" class="btn btn-primary">
                            Kapcsolattartó létrehozása
                        </a>
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
                            <th>E-mail cím</th>
                            <th>Létrehozás dátuma</th>
                            <th>Módosítás dátuma</th>
                            <th>Megtekintés/Módosítás</th>
                            <th>Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contactPersons as $user)
                            <tr id="contact-person-{{$user->id}}">
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route('contact_person.show', $user->id)}}"
                                           class="btn btn-info btn-sm">Megtekintés</a>

                                        @if(true)
                                            <a href="{{route('contact_person.edit', $user->id)}}"
                                               class="btn btn-secondary btn-sm">Módosítás</a>
                                        @else
                                            | Projekt hozzárendelve
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if(true)
{{--                                        <form action="{{route('contact_person.destroy', $user->id)}}"
                                              method="POST">
                                            <input type="hidden" name="_method" value="delete">
                                            @csrf
                                            <input type="submit" name="button" value="Törlés" class="btn btn-danger">
                                        </form>--}}
                                        <button class="btn btn-danger del-contact-person-button"
                                                data-token="{{csrf_token()}}"
                                                data-id="{{$user->id}}"
                                                data-url="{{route('contact_person.destroyWithJson', $user->id)}}">
                                            Törlés
                                        </button>
                                    @else
                                        Projekt hozzárendelve
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if (count($contactPersons)==0)
                            <td colspan="7">
                                <p class="text-center font-weight-bold">Kapcsolattartó nem áll rendelkezésre</p>
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
