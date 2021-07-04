@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Engines</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('engines.create') }}"> Create New Engine</a>
                {{-- <a class="btn btn-warning" href="{{ route('engines.index') }}"> Reset Filters </a> --}}
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
  
 <table class="table table-bordered" id="table" style="margin-top:1rem; border:0 !important;">
    {{-- <table class="table table-bordered" id="table" data-toggle="table" data-search="false" data-filter-control="true" data-show-export="false" data-click-to-select="false" data-toolbar="#toolbar"> --}}
        <thead>
            <tr>
                <th data-field="ID" data-checkbox="false">Engine ID</th>
                <th data-field="name" data-filter-control="select" data-sortable="true">Name</th>
                <th data-field="created_at" data-sortable="true">Date Created</th>
                <th data-field="updated_at" data-sortable="true">Date Modified</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        @foreach ($engines as $engine)
        <tr>
            <td>{{ $engine->id }}</td>
            <td>{{ $engine->name }}</td>
            <td>{{$engine->created_at}}</td>
            <td>{{$engine->updated_at}}</td>
            <td>
            <input type="checkbox" data-id="{{ $engine->id }}" name="status" class="js-switch" {{ $engine->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <form action="{{ route('engines.destroy',$engine->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('engines.edit',$engine->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
{!! $engines->links() !!}
<script>
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
<script>
$("body").on('change','.js-switch', function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let engId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('engines.update.status') }}',
            data: {'status': status, 'engine_id': engId},
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
