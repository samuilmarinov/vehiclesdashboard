@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Vehicles</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('vehicles.create') }}"> Create New Vehicle </a>
                <a class="btn btn-warning" href="{{ route('vehicles.index') }}"> Reset Filters </a>
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

    <table class="table table-bordered" id="table" data-toggle="table" data-search="false" data-filter-control="true" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">
        <thead>
            <tr>
                <th data-field="ID" data-checkbox="false">Vehicle ID</th>
                <th>Image</th>
                <th data-field="brand" data-filter-control="select" data-sortable="false">
                <label for="model_id">Brand</label>
                <div class="fht-cell">
                <div class="filter-control">
                <select name="brand_id" id="filterbrand" class="form-control  form-controlbootstrap-table-filter-control-brand">
                <option>Brand</option>
                @foreach($brands as $brand)
                @if ($brand->status == 1)
                    <option value="{{ $brand->name }}">
                        {{ $brand->name }}
                    </option>
                @endif    
                @endforeach
                </select>
                </div>
                </div>
                </th>

                <th data-field="model" data-filter-control="select" data-sortable="false">
                <label for="model_id">Model</label>
                <div class="fht-cell">
                <div class="filter-control">
                <select name="model_id" id="filtermodel" class="form-control bootstrap-table-filter-control-model">
                <option>--Model--</option>
                </select>
                </div>
                </div>   
                </th>
                
                <th data-field="bodywork" data-filter-control="select" data-sortable="true">Bodywork</th>
                <th data-field="engine" data-filter-control="select" data-sortable="true">Engine</th>
                <th data-field="color" data-filter-control="select" data-sortable="true">Color</th>
                <th data-field="created_at" data-sortable="true">Date Created</th>
                <th data-field="updated_at" data-sortable="true">Date Modified</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        @foreach ($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->id }}</td>
            <td><img src="uploads/images/{{ $vehicle->imageurl }}" height="75" width="75" alt="" /></td>
            <td>{{ $vehicle->brand_id }}</td>
            <td>{{ $vehicle->model_id }}</td>
            <td>{{ $vehicle->bodywork_id }}</td>
            <td>{{ $vehicle->engine_id }}</td>
            <td>{{ $vehicle->color_id }}</td>
            <td>{{$vehicle->created_at}}</td>
            <td>{{$vehicle->updated_at}}</td>
            <td>
            <input type="checkbox" data-id="{{ $vehicle->id }}" name="status" class="js-switch" {{ $vehicle->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <form action="{{ route('vehicles.destroy',$vehicle->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('vehicles.edit',$vehicle->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
{!! $vehicles->links() !!}
<script>
$("body").on('change','.js-switch', function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let vehicleId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('vehicles.update.status') }}',
            data: {'status': status, 'vehicle_id': vehicleId},
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

<script>
var $table = $('#table');
    $(function () {
        $('#toolbar').find('select').change(function () {
            $table.bootstrapTable('refreshOptions', {
                exportDataType: $(this).val()
            });
        });
    })
</script>
<script type="text/javascript">
$("body").on('change','select[name="brand_id"]', function () {
               var brandID = jQuery(this).val();
               if(brandID)
               {
                  jQuery.ajax({
                     url : '/vehicles/getmodels/' +brandID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="model_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="model_id"]').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="model_id"]').empty();
               }
});
</script>
@endsection
