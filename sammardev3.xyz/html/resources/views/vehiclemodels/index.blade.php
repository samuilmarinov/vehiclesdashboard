@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Vehiclemodels</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('vehiclemodels.create') }}"> Create New Model</a>
                {{-- <a class="btn btn-warning" href="{{ route('vehiclemodels.index') }}"> Reset Filters </a> --}}
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="toolbar">
		
    </div>
    <style>.bootstrap-table-filter-control-brand_id{ display:block; }</style>
 <table class="table table-bordered" id="table" style="margin-top:1rem; border:0 !important;">
{{-- <table class="table table-bordered" id="table" data-toggle="table" data-search="false" data-filter-control="true" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar"> --}}
         <thead>
            <tr>
                <th data-field="ID" data-checkbox="false">Model ID</th>
                <th data-field="name"  data-sortable="true">Name</th>
                <th data-field="brand_id" data-filter-control="select" data-sortable="true">Brand</th>
                <th data-field="created_at" data-sortable="true">Date Created</th>
                <th data-field="updated_at" data-sortable="true">Date Modified</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        @foreach ($vehiclemodels as $vehiclemodel)
        <tr>
            <td>{{ $vehiclemodel->id }}</td>
            <td>{{ $vehiclemodel->name }}</td>
            <td>
            @foreach($brands as $brand) 
            @if ($brand->id == $vehiclemodel->brand_id )  
                 {{ $brand->name }}
            @endif 
            @endforeach
            </td>
            <td>{{$vehiclemodel->created_at}}</td>
            <td>{{$vehiclemodel->updated_at}}</td>
            <td>
            <input type="checkbox" data-id="{{ $vehiclemodel->id }}" name="status" class="js-switch" {{ $vehiclemodel->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <form action="{{ route('vehiclemodels.destroy',$vehiclemodel->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('vehiclemodels.edit',$vehiclemodel->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
{!! $vehiclemodels->links() !!}
<script>
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
<script>
$("body").on('change','.js-switch', function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let vehicmId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('vehiclemodels.update.status') }}',
            data: {'status': status, 'vehiclemodel_id': vehicmId},
            success: function (data) {
                console.log(data.message);
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
            }
        });
});
</script>
@endsection
