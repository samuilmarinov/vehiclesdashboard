@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Bodyworks</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bodyworks.create') }}"> Create New Bodywork</a>
                {{-- <a class="btn btn-warning" href="{{ route('bodyworks.index') }}"> Reset Filters </a> --}}
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
                <th data-field="ID" data-checkbox="false">Bodywork ID</th>
                <th data-field="name" data-filter-control="select" data-sortable="true">Name</th>
                <th data-field="created_at" data-sortable="true">Date Created</th>
                <th data-field="updated_at" data-sortable="true">Date Modified</th>
                <th data-field="status" data-sortable="true">Status</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        @foreach ($bodyworks as $bodywork)
        <tr>
            <td>{{ $bodywork->id }}</td>
            <td>{{ $bodywork->name }}</td>
            <td>{{$bodywork->created_at}}</td>
            <td>{{$bodywork->updated_at}}</td>
            <td>
            <input type="checkbox" data-id="{{ $bodywork->id }}" name="status" class="js-switch" {{ $bodywork->status == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <form action="{{ route('bodyworks.destroy',$bodywork->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('bodyworks.edit',$bodywork->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
{!! $bodyworks->links() !!}
<script>
$("body").on('change','.js-switch', function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let bdwkId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('bodyworks.update.status') }}',
            data: {'status': status, 'bodywork_id': bdwkId},
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
