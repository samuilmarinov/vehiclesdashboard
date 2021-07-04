@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Model</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary back" href="{{ route('vehiclemodels.index') }}"> Back</a>
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

<form action="{{ route('vehiclemodels.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 statusedit">
             <select name="brand_id" class="form-control">
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                 @if ($brand->status == 1)
                    <option value="{{ $brand->id }}">
                        {{ $brand->name }}
                    </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 statusedit">
        <label for="status">Select status:</label>
        <select name="status" id="status">
            <option value="0">Disabled</option>
            <option value="1">Active</option>
        </select>
        </div>       
        <div class="col-xs-12 col-sm-12 col-md-12 text-left submit">
                <button type="submit" class="btn btn-primary submit">Submit</button>
        </div>
    </div>

</form>
@endsection