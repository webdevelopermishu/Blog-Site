@extends('layouts.admin')
@section('page_content')
<div class="row">
    @can('category_access')
    <div class="col-lg-8">
        <form action="{{ route('checked.delete') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center">Categories</h3>
                </div>
                <div class="card-body">
                        <table class="table table-bordered">
                            <th style="width:10%">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="checkAll" class="form-check-input checkAll">
                                        Checked All
                                        <i class="input-frame"></i>
                                    </label>
                                </div>
                                <th colspan="2"></th>
                                <th style="width:20%">
                                    <div class="text-center delll-btn d-none">
                                        <button type="submit" class="btn btn-danger btnn-icon">Delete Checked</button>
                                    </div>
                                    @error('category_id')
                                        <strong class="text-danger"><h6 class="text-center">Select first!</h6></strong>
                                    @enderror
                                </th>
                            </th>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @forelse ($categories as $sl=>$category )
                            <tr>
                                <td style="width:5%" class="text-center">
                                    <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="form-check-input checkAll">
                                    <a  class="btn btn-info"><strong>{{ $sl+1 }}</a></button>
                                </td>
                                <td class="text-center"> <img width="100" src="{{ asset('uploads/categories/')}}/{{ $category->category_image }}" alt=""></td>
                                <td class="text-center">{{ $category->category_name }}</td>
                                <td class="text-center">
                                    <button data-link="{{ route('delete.category', $category->id) }}" type="button"class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-danger"><h2><strong>Categories Empty</strong></h2></td>
                            </tr>
                            @endforelse
                        </table>
                </div>
            </div>
        </form>
    </div>
    @can('category_add')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Add New Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label"> Category Name</label>
                        <input type="text" name="category_name" class="form-control">
                        @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"> Category Image</label>
                        <input type="file" name="category_image" class="form-control">
                        @error('category_image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
    @endcan
</div>
@endsection
@section('footer_script')
@if (session('success'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
@endif
@if (session('checked_trashed'))
        <script>
            Swal.fire(
            'Trashed!',
            '{{ session('checked_trashed') }}',
            'success'
            )
        </script>
@endif
@if (session('trashed'))
        <script>
            Swal.fire(
            'Trashed!',
            '{{ session('trashed') }}',
            'success'
            )
        </script>
@endif
<script>
    $('.btn-icon').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "This will moved to trash; you'll be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var link = $(this).attr('data-link');
            window.location.href=link;
        }
        })
    })
</script>
<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('.checkAll').click(function(){
        $('.delll-btn').removeClass('d-none');
    });
</script>
@endsection
