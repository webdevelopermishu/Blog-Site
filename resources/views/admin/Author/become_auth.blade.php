@extends('admin.Author.main')
@section('page_content')
<div class="row">
    <div class="col-lg-5 m-auto">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Become an Author</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('author.req.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::guard('author')->user()->email }}">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-info btn-lg">Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
@if (session('sent'))
    <script>
        Swal.fire(
        'Sent',
        '{{ session('sent') }}',
        'success'
        )
    </script>
@endif
@endsection
