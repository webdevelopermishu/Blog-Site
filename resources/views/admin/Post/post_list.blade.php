@extends('admin.Author.main')
@section('page_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Post list</h3>
            </div>
            <div class="card-body">
                <div class="mb-2" align="right">
                    <a href="{{ route('add.post') }}" class="btn btn-success btn-lg">Add Post</a>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">SL</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Thumbnail</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($posts as $sl=>$post)
                    <tr>
                        <td width="100" class="text-center">{{ $sl+1 }}</td>
                        <td width="400">{{ $post->title }}</td>
                        <td width="300" class="text-center">{{ $post->relate_to_cate()->first()->category_name }}</td>
                        <td class="text-center"><img width="1000" src="{{ asset('uploads/post/thumbnail')}}/{{ $post->thumbnail }}" alt=""></td>
                        <td width="200" class="text-center">
                            <a href="{{ route('status.change', $post->id) }}" class="btn btn-{{ $post->status==0?'secondary':'success'}}">{{ $post->status==0?'Pending':'Publish' }}</a>
                        </td>
                        <td width="200" class="text-center">
                            <a style="cursor:pointer" data-link="{{ route('post.delete', $post->id) }}" class="btn btn-danger dele"><i data-feather="trash-2"></i></a>
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
<script>
    $('.dele').click(function(){
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
            var links = $(this).attr('data-link')
            window.location.href=links
        }
        })
    })
</script>
@if (session('changed'))
    <script>
        swal.fire(
            'Done',
            '{{ session('changed') }}',
            'success'
        )
    </script>
@endif
@if (session('delete'))
    <script>
        swal.fire(
            'Deleted',
            '{{ session('delete') }}',
            'success'
        )
    </script>
@endif
@endsection
