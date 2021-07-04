@extends('layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js" referrerpolicy="origin"></script>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Vehicle</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary back" href="{{ route('vehicles.index') }}"> Back</a>
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
    <form action="{{ route('vehicles.update',$vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

         <div class="row">
            
        <div class="col-xs-2 col-sm-2 col-md-2 statusedit">
            <strong>Brand:</strong>
             <select name="brand_id" class="form-control">
                <option value="{{ $vehicle->brand_id }}">
                @foreach($brands as $brand)
                @if ($brand->id == $vehicle->brand_id)
                {{ $brand->name }}
                @endif
                @endforeach
                </option>
                @foreach($brands as $brand)
                @if ($brand->id != $vehicle->brand_id && $brand->status == 1)
                    <option value="{{ $brand->id }}">
                        {{ $brand->name }}
                    </option>
                @endif
                @endforeach
            </select>
            </div>

        <div class="col-xs-2 col-sm-2 col-md-2 statusedit">
            <strong>Model:</strong>
            <div class="form-group">
                    <select name="model_id" class="form-control">
                    <option value="{{ $vehicle->model_id }}">
                    @foreach($vehiclemodels as $vehiclemodel)
                    @if ($vehiclemodel->id == $vehicle->model_id)
                    {{ $vehiclemodel->name }}
                    @endif
                    @endforeach  
                    </option>
                    </select>
            </div>
            </div>

        <div class="col-xs-2 col-sm-2 col-md-2 statusedit">
            <strong>Bodywork:</strong>
             <select name="bodywork_id" class="form-control">
              
                <option value="{{ $vehicle->bodywork_id }}">
                @foreach($bodyworks as $bodywork)
                @if ($bodywork->id == $vehicle->bodywork_id)
                {{ $bodywork->name }}
                @endif
                @endforeach
                </option>

                @foreach($bodyworks as $bodywork)
                @if ($bodywork->id != $vehicle->bodywork_id && $bodywork->status == 1)
                    <option value="{{ $bodywork->id }}">
                        {{ $bodywork->name }}
                    </option>
                @endif
                @endforeach
            </select>
            </div>

        <div class="col-xs-2 col-sm-2 col-md-2 statusedit">
            <strong>Engine:</strong>
             <select name="engine_id" class="form-control">
                <option value="{{ $vehicle->engine_id }}">
                @foreach($engines as $engine)
                @if ($engine->id == $vehicle->engine_id)
                {{ $engine->name }}
                @endif
                @endforeach
                </option>
                @foreach($engines as $engine)
                @if ($engine->id != $vehicle->engine_id && $engine->status == 1)
                    <option value="{{ $engine->id }}">
                        {{ $engine->name }}
                    </option>
                @endif
                @endforeach
            </select>
            </div>

        <div class="col-xs-2 col-sm-2 col-md-2 statusedit">
            <strong>Color:</strong>
             <select name="color_id" class="form-control">
     
                <option value="{{ $vehicle->engine_id }}">
                @foreach($colors as $color)
                @if ($color->id == $vehicle->color_id)
                {{ $color->name }}
                @endif
                @endforeach
                </option>
                @foreach($colors as $color)
                @if ($color->id != $vehicle->color_id && $color->status == 1)
                    <option value="{{ $color->id }}">
                        {{ $color->name }}
                    </option>
                @endif
                @endforeach
            </select>
            </div>
            

        <div class="col-xs-2 col-sm-2 col-md-2 statusedit">
                <div class="form-group">
                    <strong>Version:</strong>
                    <input type="text" name="version" value="{{ $vehicle->version }}" class="form-control" placeholder="Version">
                </div>
            </div>
    
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Info:</strong>
                    <textarea name="info" rows="10" cols="40" class="form-control tinymce-editor">
                        {{$vehicle->info}}
                    </textarea>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                 <input id="imageupload" name="image" type="file" class="form-control" placeholder="Image">
                 <input id="image" type="text" name="imageurl" value="{{$vehicle->imageurl}}" class="form-control zindex" placeholder="Image">
                @error('image')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
               @enderror
            </div>
            <div class="form-group">
              <img src="/uploads/images/{{ $vehicle->imageurl }}" height="75" width="75" alt="" />
            </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 statusedit">
            <label for="metallic">Status:</label>
                    <select name="status" id="status">
                        @if($vehicle->status == 1)
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

<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="brand_id"]').on('change',function(){
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
                           $('select[name="model_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="model_id"]').empty();
               }
            });
    });
</script>
<script>    
document.getElementById('imageupload').onchange = uploadOnChange;
function uploadOnChange() {
  var filename = this.value;
  var lastIndex = filename.lastIndexOf("\\");
  if (lastIndex >= 0) {
    filename = filename.substring(lastIndex + 1);
  }
  document.getElementById('image').value = filename;
}
</script>
{{-- <script>
$(window).load(function() {

               var brandID = jQuery('select[name="brand_id"]').val();
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
</script> --}}
<script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 100,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '/css/tiny/style_ty.min.css'
        });
</script>
@endsection

