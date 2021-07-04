@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Colors</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('colors.create') }}"> Create New Color</a>
                {{-- <a class="btn btn-warning" href="{{ route('colors.index') }}"> Reset Filters </a> --}}
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
 <table class="table table-bordered" id="table" style="margin-top:1rem; border:0 !important;">
    {{-- <table class="table table-bordered" id="table" data-toggle="table" data-search="false" data-filter-control="true" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar"> --}}
        <thead>
            <tr>
                <th data-field="ID" data-checkbox="false">Color ID</th>
                <th data-field="name" data-filter-control="select" data-sortable="true">Name</th>
                <th data-field="metallic" data-sortable="true">Metallic</th>
                <th data-field="created_at" data-sortable="true">Date Created</th>
                <th data-field="updated_at" data-sortable="true">Date Modified</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        @foreach ($colors as $color)
        <tr>
            <td>{{ $color->id }}</td>
            <td>{{ $color->name }}</td>
            <td>
            <input type="checkbox" data-id="{{ $color->id }}" name="metallic" class="js-switch color-finish" {{ $color->metallic == 1 ? 'checked' : '' }}>
            </td>
            <td>{{$color->created_at}}</td>
            <td>{{$color->updated_at}}</td>
            <td>
            <input type="checkbox" data-id="{{ $color->id }}" name="status" class="js-switch status-update" {{ $color->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <form action="{{ route('colors.destroy',$color->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('colors.edit',$color->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

{!! $colors->links() !!}

<script>
$("body").on('change','.status-update', function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let colorId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('colors.update.status') }}',
            data: {'status': status, 'color_id': colorId},
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
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
<script>
$("body").on('change','.color-finish', function () {
        let metallic = $(this).prop('checked') === true ? 1 : 0;
        let finishId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('colors.update.finish') }}',
            data: {'metallic': metallic, 'color_id': finishId},
            success: function (data) {
                console.log(data.message);
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                    // window.location.replace("/colors"); 
                    location.reload();
            }
        });
});
</script>
@endsection
