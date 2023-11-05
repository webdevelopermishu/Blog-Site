@extends('layouts.admin')
@section('page_content')
<div class="row">
    @can('role_access')
    <div class="col-lg-8 bg-secondary">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Roles</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><strong>Role</strong></th>
                        <th><strong>Permissions</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>
                    @foreach ($roles as $role)
                    <tr>
                        <td><strong>{{ $role->name }}</strong></td>
                        <td>
                            @foreach ($role->getPermissionNames() as $permission)
                                <span class="badge badge-primary">{{ $permission }}</span>
                            @endforeach
                        </td>
                        <td><a href="{{ route('role.delete', $role->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="my-4">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center">Users</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:5%"><strong>SL</strong></th>
                            <th style="width:30%"><strong>Users Name</strong></th>
                            <th><strong>Role Type</strong></th>
                            <th style="width:10%"><strong>Action</strong></th>
                        </tr>
                        @foreach ($users as $sl=>$user)
                        <tr>
                            <td><strong>{{ $sl+1 }}</strong></td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge badge-primary">{{ $role }}</span>
                                @empty
                                    <span class="badge badge-secondary">Not Assigned</span>
                                @endforelse
                            </td>
                            <td><a href="{{ route('remove.role.user', $user->id) }}" class="btn btn-danger">Remove</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 bg-secondary">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Create Permissions</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Permission</label>
                        <input type="text" name="permission_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button class="text-center btn btn-info">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="my-2">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center">Create Roles</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Role</label>
                            <input type="text" name="role" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Permissions</label>
                            <div>
                                @foreach ($permissions as $permission)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="permission[]" class="form-check-input" value="{{ $permission->name }}">
                                            {{ $permission->name }}
                                        <i class="input-frame"></i></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="text-center btn btn-info">Assign Permissions</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="my-2">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center">Assign Users</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('assign.role') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">User Name</label>
                            <select name="user_id" class="form-control">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Role</label>
                            <select name="role" class="form-control">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="text-center btn btn-info">Assign Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_script')
@if (session('saved'))
    <script>
        Swal.fire(
        'Saved',
        '{{ session('saved') }}',
        'success'
        )
    </script>
@endif
@if (session('role'))
    <script>
        Swal.fire(
        'Assigned',
        '{{ session('role') }}',
        'success'
        )
    </script>
@endif
@if (session('assigned'))
    <script>
        Swal.fire(
        'Assigned',
        '{{ session('assigned') }}',
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
