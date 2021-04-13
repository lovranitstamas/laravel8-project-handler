<form action="{{$project->id ?
                route('project.update', $project->id) :
                route('project.store')}}"
      method="POST">
    <div class="box-body">
        <p>* jelölt mezők kitöltése kötelező</p>
        @if($project->id)
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="id" class="font-weight-bold">Azonosító</label>
                <input type="text" id="id" name="id" value="{{$project->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        <div class="form-group">
            <label for="name" class="font-weight-bold">*Projekt neve:</label>
            <input type="text" id="name" name="name" value="{{old('name') ?: $project->name}}"
                   class="{{$errors->first('name') ? 'has-error': ''}} form-control">
            @if($errors->first('name'))
                <p style="color:red">
                    {{$errors->first('name')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="description" class="font-weight-bold">*Projekt leírása:</label>
            <textarea rows="5" cols="10" id="description" name="description"
                      class="{{$errors->first('description') ? 'has-error': ''}} form-control"
            >{{old('description') ?: $project->description}}</textarea>
            @if($errors->first('description'))
                <p style="color:red">
                    {{$errors->first('description')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="status" class="font-weight-bold">*Státusz kiválasztása:</label>
            <select name="status_id" id="status" class="form-control">
                <option value="0"
                    {{!$project->status() && !old('status_id')
                      ? 'selected':''}}>Kérem válasszon!
                </option>
                @foreach($statuses as $status)
                    @if($project->status()->count()==0)
                        <option value="{{$status->id}}"
                            {{$status->id == old('status_id') ? 'selected': ''}}>
                            {{$status->name}}
                        </option>
                    @else
                        <option value="{{$status->id}}"
                            {{$status->id == $project->status->id ? 'selected': ''}}>
                            {{$status->name}}
                        </option>
                    @endif
                @endforeach
            </select>
            @if($errors->first('status_id'))
                <p style="color:red">
                    {{$errors->first('status_id')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="contact_persons" class="font-weight-bold">*Kapcsolattartó (több opció is választható):</label>
            <select name="contact_persons[]" id="contact_persons" class="form-control" multiple>
                @foreach($contactPersons as $contactPerson)
                    <option value="{{$contactPerson->id}}"
                        {{old('contact_persons')===null && $project->id && $project->hasUser($contactPerson->id) ?
                        'selected':''}}
                        {{old('contact_persons')!==null && (collect(old('contact_persons'))->contains($contactPerson->id)) ?
                        'selected':''}}
                    >{{$contactPerson->name}}
                    </option>
                @endforeach
            </select>
            @if($errors->first('contact_persons'))
                <p style="color:red">
                    {{$errors->first('contact_persons')}}
                </p>
            @endif
        </div>

        @if($project->id)
            <div class="form-group">
                <label for="created_at" class="font-weight-bold">Létrehozás dátuma:</label>
                <input type="text" id="created_at" name="created_at" disabled value="{{$project->created_at}}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="updated_at" class="font-weight-bold">Feltöltés dátuma:</label>
                <input type="text" id="updated_at" name="updated_at" disabled value="{{$project->updated_at}}"
                       class="form-control">
            </div>
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <div class="form-group">
            <input type="submit" value="{{!$project->id ? 'Feltöltés' : 'Módosítás'}}" class="btn btn-primary">
        </div>
        <div class="form-group">
            <a class="btn btn-secondary" href="{{route('project.index')}}">Mégse</a>
        </div>
    </div>
</form>
