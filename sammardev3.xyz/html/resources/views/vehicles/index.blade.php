@extends('body')
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<div class="form-group" style="height:50px; display:inline-flex; margin-right:1rem;">
    <form style="color:white;" action="{{ route('vehicles.index') }}" method="GET" class="form-inline my-2 my-lg-0">
        <a class="btn btn-success reset my-2 my-sm-0" href="{{ route('vehicles.create') }}"> Create New Vehicle </a>
    </form>
     <form style="color:white;" action="{{ route('vehicles.index') }}" method="GET" class="form-inline my-2 my-lg-0">
      <div class="searchsection">
              <div class="input-daterange input-group" id="datepicker">
                  <input type="text" id="from_date" class="input-sm form-control" name="from_date"
                      value="{{ Request::get('from_date') }}" />
                  <span class="input-group-addon">to</span>
                  <input type="text" id="to_date" class="input-sm form-control" name="to_date"
                      value="{{ Request::get('to_date') }}" />
              </div>
              <button type="submit" id="dateSearch" class="btn btn-sm btn-primary my-2 my-sm-0 buttoncontrols">Search</button>
        </div>
        <div class="actionsection">
          {{-- <a class="btn btn-success reset my-2 my-sm-0" href="{{ route('vehicles.create') }}"> Create New Vehicle </a> --}}
        </div>
    </form>
</div> 
<div id="toolbar" style="display:inline-flex;">

            <div class="form-group" style="margin-right:1rem;">
                {{-- <label><strong>Status :</strong></label> --}}
                <select id='status' class="form-control" style="width: 200px">
                    <option value="">--Status--</option>
                    <option value="1">Active</option>
                    <option value="0">Disabled</option>
                </select>
            </div>  
             <div class="form-group home_form_group">
                {{-- <label><strong>Brand :</strong></label> --}}
               <select id="brand_id" name="brand_id" class="form-control">
               <option value="">--Brand--</option>
                @foreach($brands as $brand)
                @if ($brand->status == 1)
                    <option data-brand="{{ $brand->id }}" value="{{ $brand->id }}">
                        {{ $brand->name }}
                    </option>
                @endif    
                @endforeach
            </select>
            <i style="line-height: 2.4; margin-left: 1rem; margin-right: -0.2rem;" class="fa fa-plus"></i>
            {{-- <button style="height: 35px; margin-top: 0rem !important;" id="brand_id_btn" class="btn btn-sm">Filter</button> --}}
            </div>  
             <div class="form-group home_form_group">
                {{-- <label><strong>Model :</strong></label> --}}
               <select id="model_id" name="model_id" class="form-control">
               <option value="">--Model--</option>
            </select>
            <i style="line-height: 2.4; margin-left: 1rem; margin-right: -0.2rem;" class="fa fa-plus"></i>
            {{-- <button style="margin-left: 1rem !important; height: 35px; margin-top: 0rem !important;" id="model_id_btn" class="btn btn-sm">Filter</button> --}}
            </div> 

                <div class="form-group home_form_group">
                {{-- <label><strong>Bodywork :</strong></label> --}}
               <select id="bodywork_id" name="bodywork_id" class="form-control">
               <option value="">--Body--</option>
                @foreach($bodyworks as $bodywork)
                @if ($bodywork->status == 1)
                    <option data-bodywork="{{ $bodywork->id }}" value="{{ $bodywork->id }}">
                        {{ $bodywork->name }}
                    </option>
                @endif    
                @endforeach
            </select>
            {{-- <button style="height: 35px; margin-top: 0rem !important;" id="bodywork_id_btn" class="btn btn-sm">Filter</button> --}}
            </div>  

            <div class="form-group home_form_group">
                {{-- <label><strong>Engine :</strong></label> --}}
               <select id="engine_id" name="engine_id" class="form-control">
               <option value="">--Engine--</option>
                @foreach($engines as $engine)
                @if ($engine->status == 1)
                    <option data-engine="{{ $engine->id }}" value="{{ $engine->id }}">
                        {{ $engine->name }}
                    </option>
                @endif    
                @endforeach
            </select>
            {{-- <button style="height: 35px; margin-top: 0rem !important;" id="engine_id_btn" class="btn btn-sm">Filter</button> --}}
            </div>    

             <div class="form-group home_form_group">
                {{-- <label><strong>Color :</strong></label> --}}
               <select id="color_id" name="color_id" class="form-control">
               <option value="">--Color--</option>
                @foreach($colors as $color)
                @if ($color->status == 1)
                    <option data-color="{{ $color->id }}" value="{{ $color->id }}">
                        {{ $color->name }}
                    </option>
                @endif    
                @endforeach
            </select>
            {{-- <button style="height: 35px; margin-top: 0rem !important;" id="color_id_btn" class="btn btn-sm">Filter</button> --}}
            </div> 

            <div class="form-group" style="height:50px; display:inline-flex; margin-right:1rem;">
                {{-- <input id="search" name="search" type="search" class="form-control" placeholder="search vehicles" value="{{ Request::get('search') }}" aria-controls="datavehicles"> --}}
                <button id="search_find" class="btn btn-sm buttoncontrols">Filter</button>
                <a class="btn btn-warning reset my-2 my-sm-0 buttoncontrols filterres" href="{{ route('vehicles.index') }}"> Reset Filters </a>

            </div>
</div>
        
<table id="datavehicles" class="display">
  <thead>
    <tr>
      <th></th>
      <td></td>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
</table>
<footer id="footer" class="footer">
©2021
</footer>        
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
(function( $ ){
$(document).ready(function() {
  var table = $('#datavehicles').DataTable({
    responsive: true,
    select: false,
    ordering: false,
    processing: true,
    serverSide: true,
    ajax: {
            url: '{{ route('vehicles.getvehicles') }}',
            method: 'GET',
            type: 'GET',
            data: function (d) {
                     d.from_date = $("#from_date").val(),
                     d.to_date = $("#to_date").val(),
                     d.status = $('#status').val(),
                     d.search = $('input[type="search"]').val(),
                     d.brand_id = $('#brand_id').val(),
                     d.model_id = $('#model_id').val(),
                     d.color_id = $('#color_id').val(),
                     d.engine_id = $('#engine_id').val(),
                     d.bodywork_id = $('#bodywork_id').val(),
                     d.search_id = $('#search').val()
            }
    },
    columns: [
      { data: "id", title: "ID", orderable: true,  },
      { data: "imageurl", title: "Image", orderable: false, searchable: false },
      { data: "vehiclebrand", title: "Brand", orderable: true, },
      { data: "vehiclemodel", title: "Model", orderable: true, },
      { data: "vehiclebodywork", title: "Bodywork", orderable: true, },
      { data: "vehicleengine", title: "Engine", orderable: true, },
      { data: "vehiclecolor", title: "Color", orderable: true, },
      { data: "created_at", title: "Created at", orderable: false, searchable: false },
      { data: "updated_at", title: "Updated at", orderable: false, searchable: false },
      { data: 'status', title: 'Status', orderable: false, searchable: false, width: '10px', sClass: "selectCol" },
      { data: 'action', title: 'Action', orderable: false, searchable: false, width: '10px', sClass: "selectCol" },
     
    ],
    fnDrawCallback: function() { jQuery('.my_switch').bootstrapToggle(); }
    
    });

            $('#filter-vehicle-4').empty();

            $('.input-daterange').datepicker({
                 dateFormat: 'dd-mm-yy',
                 autoclose: true,
                 todayHighlight: true
            });

            $('#dateSearch').on('click', function() {
                //console.log('search');
                table.draw();
            });

             $('#status').change(function(){
                table.draw();
                 $('#brand_id').attr('disabled', 'disabled');
                 $('#model_id').attr('disabled', 'disabled');
                 $('#color_id').attr('disabled', 'disabled');
                 $('#engine_id').attr('disabled', 'disabled');
                 $('#bodywork_id').attr('disabled', 'disabled');
                 $('#search').attr('disabled', 'disabled');
            });

            $('#brand_id').change(function(){
                 table.draw();
                 $('#status').attr('disabled', 'disabled');
                 $('#color_id').attr('disabled', 'disabled');
                 $('#engine_id').attr('disabled', 'disabled');
                // $('#bodywork_id').attr('disabled', 'disabled');
                 $('#search').attr('disabled', 'disabled');
            });

            $('#bodywork_id').change(function(){
                 $('#status').attr('disabled', 'disabled');
                 $('#color_id').attr('disabled', 'disabled');
                 $('#engine_id').attr('disabled', 'disabled');
               //  $('#brand_id').attr('disabled', 'disabled');
                // $('#model_id').attr('disabled', 'disabled');
                 $('#search').attr('disabled', 'disabled');
            });

            $('#color_id').change(function(){
                 $('#status').attr('disabled', 'disabled');
                 $('#bodywork_id').attr('disabled', 'disabled');
                 $('#engine_id').attr('disabled', 'disabled');
                 $('#brand_id').attr('disabled', 'disabled');
                 $('#model_id').attr('disabled', 'disabled');
                 $('#search').attr('disabled', 'disabled');
            });

            $('#engine_id').change(function(){
                 $('#status').attr('disabled', 'disabled');
                 $('#bodywork_id').attr('disabled', 'disabled');
                 $('#color_id').attr('disabled', 'disabled');
                 $('#brand_id').attr('disabled', 'disabled');
                 $('#model_id').attr('disabled', 'disabled');
                 $('#search').attr('disabled', 'disabled');
            });

            $('#search_find').click(function(){
                table.draw();
            });     
});

})( jQuery );
</script>
<script type="text/javascript">
(function( $ ){
$("body").on('change','#brand_id', function () {
             
              // var brandID = jQuery(this).val;
      
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
                        jQuery('#model_id').empty();
                        jQuery.each(data, function(key,value){
                           $('#model_id').append('<option data-model="'+ key +'" value="'+ key +'">'+ value +'</option>');
                        });
                       $('#model_id').css("visibility", "visible");
                     }
                  });
               }
               else
               {
                  $('#model_id').empty();
               }
});

document.addEventListener('DOMContentLoaded', function() {

}, false);

})( jQuery );
</script>
{{-- <script>
(function( $ ){
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
var paramValue = getQueryVariable('q');
console.log(paramValue);
})( jQuery );
</script> --}}
@endsection

