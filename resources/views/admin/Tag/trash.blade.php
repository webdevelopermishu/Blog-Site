@extends('layouts.admin')
@section('page_content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <form action="{{ route('checked.tag.action') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-center">Trashed Tags</h3>
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
                            <th colspan="1"></th>
                            <th style="width:20%">
                                <div class="text-center delll-btn d-none">
                                    <button name="action_checked" value="1" type="submit" class="btn btn-info btnn-icon">Restore Checked</button>
                                </div>
                                <div class="text-center delll-btn d-none">
                                    <button name="action_checked" value="2" type="submit" class="btn btn-danger btnn-icon">Delete Checked</button>
                                </div>
                                @error('tag_id')
                                    <strong class="text-danger"><h6 class="text-center">Select first!</h6></strong>
                                @enderror
                            </th>
                        </th>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Tags</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse ($tags as $sl=>$tag )
                        <tr>
                            <td style="width:5%" class="text-center">
                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}" class="form-check-input checkAll">
                                <a  class="btn btn-info"><strong>{{ $sl+1 }}</a></button>
                            </td>
                            <td class="text-center">{{ $tag->tag_name }}</td>
                            <td class="text-center">
                                <button data-link="{{ route('permanent.delete.tag', $tag->id) }}" title="Delete" type="button"class="btn btn-danger btn-icon del-btn">
                                    <i data-feather="trash-2"></i>
                                </button>
                                <button data-link="{{ route('restore.tag', $tag->id) }}" title="Restore" type="button"class="btn btn-info btn-icon res-btn">
                                    <i data-feather="rotate-ccw"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger"><h2><strong>Trash Empty</strong></h2></td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </form>
        {{-- <div class=" text-center delll-btn d-none">
            <button data-link="{{ route('checked.per_delete', $tag) }}" class="btn btn-danger de-btn">Delete Checked</button>
        </div> --}}
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $('.del-btn').click(function(){
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
            var link = $(this).attr('data-link')
            window.location.href=link;
        }
        })
    })
</script>
<script>
    @if (session('deleted'))
    Swal.fire(
        'Deleted!',
        '{{ session('deleted') }}',
        'success'
    )
    @endif
</script>
<script>
    $('.res-btn').click(function(){
        Swal.fire({
        title: 'Are you want to revert this?',
        text: "This will back to previous",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Restore it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var link = $(this).attr('data-link')
            window.location.href=link;
        }
        })
    })
</script>
<script>
    @if (session('restored'))
    Swal.fire(
        'Restored!',
        '{{ session('restored') }}',
        'success'
    )
    @endif
</script>
<script>
    @if (session('checked_restored'))
    Swal.fire(
            'Restored!',
            '{{ session('checked_restored') }}',
            'success'
            )
    @endif
</script>
<script>
    @if (session('checked_delete'))
    Swal.fire(
            'Deleted!',
            '{{ session('checked_delete') }}',
            'success'
            )
    @endif
</script>
<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('.checkAll').click(function(){
        $('.delll-btn').removeClass('d-none');
    });
</script>
<script>
    $('.de-btn').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "This will delete forever!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var link = $(this).attr('data-link')
            window.location.href=link;
        }
        })
    })
</script>
@endsection
