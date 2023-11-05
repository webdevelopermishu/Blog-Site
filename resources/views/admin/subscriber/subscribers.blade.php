@extends('layouts.admin')
@section('page_content')
<div class="row">
    @can('subscribe_access')
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Subscribers</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">SL</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($subscribers as $sl=>$subscribe)
                    <tr>
                        <td class="text-center">{{ $sl+1 }}</td>
                        <td>{{ $subscribe->email }}</td>
                        <td class="text-center">
                            @if ($subscribe->status==0)
                                <a href="{{ route('send.mail', $subscribe->id) }}" class="text-secondary">
                                    <i data-feather="help-circle"></i>
                                </a>
                            @else
                                <a class="text-success">
                                    <i data-feather="check"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('subs.delete', $subscribe->id) }}" class="text-danger">
                                <i data-feather="trash-2"></i>
                            </a>
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
@if (session('delete'))
    <script>
        swal.fire(
            'Deleted',
            '--',
            'success'
        )
    </script>
@endif
@if (session('sent'))
    <script>
        swal.fire(
            'Sent',
            '--',
            'success'
        )
    </script>
@endif
@endsection
