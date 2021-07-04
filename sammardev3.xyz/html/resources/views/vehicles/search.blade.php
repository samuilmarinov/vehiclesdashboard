@extends('layout')
@section('content')
<div class="container">
<?php $i = 0; ?>
@if(isset($details))
    <p> The Search results for your query <b> {{ $query }} </b> are :</p>
    <h2>Vehicle details</h2>
    <table class="table table-bordered" id="table" data-toggle="table" data-search="false" data-filter-control="true" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar">
         <thead>
            <tr>
                <th data-field="ID" data-checkbox="false">Search Index</th>
                <th>Image</th>
                <th data-field="brand" data-filter-control="select" data-sortable="false">
                <label for="model_id">Brand</label>
                <div class="fht-cell">
                <div class="filter-control">
                <select name="brand_id" id="filterbrand" class="form-control  form-controlbootstrap-table-filter-control-brand">
                <option>Brand</option>
                @foreach($brands as $brand)
                @if ($brand->status == 1)
                    <option data-brand="{{ $brand->id }}" value="{{ $brand->name }}">
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
  
            @foreach($details as $vehicle)
            <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/uploads/images/{{ $vehicle->imageurl }}" height="75" width="75" alt="" /></td>
            <td>
            @foreach($brands as $brand) 
            @if ($brand->id == $vehicle->brand_id )  
                 {{ $brand->name }}
            @endif 
            @endforeach
            </td>
            <td>
            @foreach($models as $model) 
            @if ($model->id == $vehicle->model_id )  
                 {{ $model->name }}
            @endif 
            @endforeach
            </td>
            <td>
            @foreach($bodyworks as $bodywork) 
            @if ($bodywork->id == $vehicle->bodywork_id )  
                 {{ $bodywork->name }}
            @endif 
            @endforeach
            </td>
            <td>
            @foreach($engines as $engine) 
            @if ($engine->id == $vehicle->engine_id )  
                 {{ $engine->name }}
            @endif 
            @endforeach
            <td>
            @foreach($colors as $color) 
            @if ($color->id == $vehicle->color_id )  
                 {{ $color->name }}
            @endif 
            @endforeach
            </td>
            <td>{{ $vehicle->created_at}}</td>
            <td>{{ $vehicle->updated_at}}</td>
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
    @else
    <div>
        <h2>No vehicles found</h2>
    </div>
    @endif
</div>
<script type="text/javascript">
$("body").on('change','select[name="brand_id"]', function () {
             //  var brandID = jQuery(this).val();
                var brandID = jQuery(this).find(':selected').attr('data-brand');
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