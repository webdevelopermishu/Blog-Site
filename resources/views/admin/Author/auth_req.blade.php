@extends('layouts.admin')
@section('page_content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Author Requests</h3>
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
                        <td><a href="{{ route('auth.req.accept', $list->id) }}" class="btn btn-info">pending</a></td>
                        <td>
                            <a href="{{ route('auth.req.delete', $list->id) }}" class="btn btn-danger">Delete</a>
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
@if (session('accepted'))
    <script>
        Swal.fire(
        'Accepted',
        '{{ session('accepted') }}',
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
