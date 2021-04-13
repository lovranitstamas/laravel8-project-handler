<form action="{{$contactPerson->id ?
                route('contact_person.update', $contactPerson->id) :
                route('contact_person.store')}}"
      method="POST">
    <div class="box-body">
        <p>* jelölt mezők kitöltése kötelező</p>
        @if($contactPerson->id)
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="id">Azonosító</label>
                <input type="text" id="id" name="id" value="{{$contactPerson->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        <div class="form-group">
            <label for="name">*Kapcsolattartó neve:</label>
            <input type="text" id="name" name="name" value="{{old('name') ?: $contactPerson->name}}"
                   class="{{$errors->first('name') ? 'has-error': ''}} form-control">
            @if($errors->first('name'))
                <p style="color:red">
                    {{$errors->first('name')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="email">*E-mail cím:</label>
            <input type="text" id="email" name="email" value="{{old('email') ?: $contactPerson->email}}"
                   class="{{$errors->first('email') ? 'has-error': ''}} form-control">
            @if($errors->first('email'))
                <p style="color:red">
                    {{$errors->first('email')}}
                </p>
            @endif
        </div>

        @if($contactPerson->id)
            <div class="form-group">
                <label for="created_at">Létrehozás dátuma:</label>
                <input type="text" id="created_at" name="created_at" disabled value="{{$contactPerson->created_at}}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="updated_at">Feltöltés dátuma:</label>
                <input type="text" id="updated_at" name="updated_at" disabled value="{{$contactPerson->updated_at}}"
                       class="form-control">
            </div>
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <div class="form-group">
            <input type="submit" value="{{!$contactPerson->id ? 'Feltöltés' : 'Módosítás'}}" class="btn btn-primary">
        </div>
        <div class="form-group">
            <a class="btn btn-secondary" href="{{route('contact_person.index')}}">Mégse</a>
        </div>
    </div>
</form>
