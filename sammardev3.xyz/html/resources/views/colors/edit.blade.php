@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Color</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary back" href="{{ route('colors.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('colors.update',$color->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input id="name" type="text" name="name" value="{{ $color->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 statusedit">
            <label for="metallic">Status:</label>
                    <select name="status" id="status">
                        @if($color->status == 1)
                        <option value="1">Active</option>
                        <option value="0">Disabled</option>
                        @else
                        <option value="0">Disabled</option>
                        <option value="1">Active</option>
                        @endif
                    </select>
            </div>
       
            <div class="col-xs-12 col-sm-12 col-md-12 text-left submit">
              <button type="submit" class="btn btn-primary submit">Submit</button>
            </div>
        </div>


    </form>
@endsection