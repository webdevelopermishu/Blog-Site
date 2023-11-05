@extends('layouts.admin')
@section('page_content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Authors List</h3>
            </div>
            <div class="card-body">
                <table class="table table-brdered">
                    <tr>
                        <th>SL</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($lists as $sl=>$list )
                    <tr>
                        <td>{{ $sl+1 }}</td>
                        <td>{{ $list->email }}</td>
                        <td><a href="{{ route('auth.deactive', $list->id) }}" class="btn btn-success">Accepted</a></td>
                        <td>
                            <a href="{{ route('auth.del', $list->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
@if (session('Deactivated'))
    <script>
        Swal.fire(
        'Deactivated',
        '{{ session('Deactivated') }}',
        'success'
        )
    </script>
@endif
@if (session('deleted'))
    <script>
        Swal.fire(
        'Deleted',
        '{{ session('deleted') }}',
        'success'
        )
    </script>
@endif
@endsection
