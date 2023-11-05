@extends('layouts.admin')
@section('page_content')
<div class="row">
    @can('view_users')
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">User List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                <tr>
                    <th class="text-center">SL</th>
                    <th class="text-center">Photo</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Action</th>
                </tr>
                @foreach ($users as $sl=>$user)
                <tr>
                    <td class="text-center">{{ $sl+1 }}</td>
                    <td class="text-center">
                        @if ($user->photo == null)
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                        @else
                            <img width="100" src="{{ asset('uploads/users/') }}/{{ $user->photo }}" alt="">
                        @endif
                    </td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">
                        @can('delete_users')
                        <button data-link="{{ route('delete.user',$user->id) }}" class="btn-danger del_btn"><i data-feather=trash-2></i></button>
                        @endcan
                    </td>
                </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_script')
<script>
    $('.del_btn').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
           var link = $(this).attr('data-link');
           window.location.href= link;
        }
        })
    })
</script>
@if (session('deleted'))
    <script>
        Swal.fire(
        'Deleted!',
        '{{session('deleted')}}',
        'success'
    )
    </script>
@endif
@endsection
