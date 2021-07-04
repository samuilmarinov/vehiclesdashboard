@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Brands</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('brands.create') }}"> Create New Brand</a>
                {{-- <a class="btn btn-warning" href="{{ route('brands.index') }}"> Reset Filters </a> --}}
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
                <th data-field="ID" data-checkbox="false">Brand ID</th>
                <th data-field="name" data-filter-control="select" data-sortable="true">Name</th>
                <th data-field="created_at" data-sortable="true">Date Created</th>
                <th data-field="updated_at" data-sortable="true">Date Modified</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        @foreach ($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</td>
            <td>{{$brand->created_at}}</td>
            <td>{{$brand->updated_at}}</td>
            <td>
            <input type="checkbox" data-id="{{ $brand->id }}" name="status" class="js-switch" {{ $brand->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <form action="{{ route('brands.destroy',$brand->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('brands.edit',$brand->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
{!! $brands->links() !!}
<script>
$("body").on('change','.js-switch', function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let brandId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('brands.update.status') }}',
            data: {'status': status, 'brand_id': brandId},
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
@endsection
