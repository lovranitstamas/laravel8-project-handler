<form action="{{$status->id ?
                route('status.update', $status->id) :
                route('status.store')}}"
      method="POST">
    <div class="box-body">
        @if($status->id)
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="id" class="font-weight-bold">Azonosító</label>
                <input type="text" name="id" id="id" value="{{$status->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        <div class="form-group">
            <label for="name" class="font-weight-bold">Név:</label>
            <input type="text" name="name" id="name" value="{{old('name') ?: $status->name}}"
                   class="{{$errors->first('name') ? 'has-error': ''}} form-control">
            @if($errors->first('name'))
                <p style="color:red">
                    {{$errors->first('name')}}
                </p>
            @endif
        </div>

        @if($status->id)
            <div class="form-group">
                <label for="created_at" class="font-weight-bold">Létrehozás dátuma:</label>
                <input type="text" id="created_at" name="created_at" disabled value="{{$status->created_at}}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label for="updated_at" class="font-weight-bold">Módosítás dátuma:</label>
                <input type="text" name="updated_at" id="updated_at" disabled value="{{$status->updated_at}}"
                       class="form-control">
            </div>
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <div class="form-group">
            <input type="submit" value="{{!$status->id ? 'Létrehozás' : 'Módosítás'}}" class="btn btn-primary">
        </div>
        <div class="form-group">
            <a class="btn btn-secondary" href="{{route('status.index')}}">Mégse</a>
        </div>
    </div>
</form>
