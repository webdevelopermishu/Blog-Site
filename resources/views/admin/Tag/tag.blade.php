@extends('layouts.admin')
@section('page_content')
<div class="row">
    @can('tag_access')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-info"><h3 class="text-center">Tags</h3></div>
            <div class="card-body">
                <form action="{{ route('checked.trash') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <th style="width:10%">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" id="checkAll" class="form-check-input checkAll">
                                    Checked All
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                            <th colspan="1"></th>
                            <th style="width:20%">
                                <div class="text-center delll-btn d-none">
                                    <button type="submit" class="btn btn-danger btnn-icon">Delete Checked</button>
                                </div>
                                @error('tag_id')
                                    <strong class="text-danger"><h6 class="text-center">Select first!</h6></strong>
                                @enderror
                            </th>
                        </th>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Tag Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach ($tags as $sl=>$tag )
                        <tr>
                            <td style="width:5%" class="text-center">
                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}" class="form-check-input checkAll">
                                <a  class="btn btn-info"><strong>{{ $sl+1 }}</a></button>
                            </td>
                            <td class="text-center">{{ $tag->tag_name }}</td>
                            <td class="text-center">
                                <button data-link="{{ route('tag.delete', $tag->id) }}" type="button"class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Add New Tags</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tag.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tag name</label>
                        <input type="text" name="tag_name" class="form-control">
                        @error('tag_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('footer_script')
@if (session('added'))
    <script>
        Swal.fire(
        'Aded!',
        '{{ session('added') }}',
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
            var link =$(this).attr('data-link');
            window.location.href=link;
        }
    })
    })
</script>
@if (session('trashed'))
    <script>
        Swal.fire(
        'Trashed!',
        '{{ session('trashed') }}',
        'success'
        )
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
<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('.checkAll').click(function(){
        $('.delll-btn').removeClass('d-none');
    });
</script>

@endsection
