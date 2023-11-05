@extends('layouts.admin')
@section('page_content')
<div class="row">
    <div class="col-lg-6 ">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Edit Profile</h3>
            </div>
            <div class="card-body m-auto">
               <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Profile Photo</label>
                        <input type="file" name="photo" class="form-control"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-2">
                        <img width="200" src="{{ asset('uploads/users/') }}/{{ Auth::user()->photo }}" alt="" id="blah">
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
               </form>
            </div>
        </div>
 </div>
 <div class="col-lg-5 ">
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="text-center">Edit Password</h3>
        </div>
            <div class="card-body m-auto">
               <div class="mb-3">
                @if (session('pass_changed'))
                    <strong class="alert alert-success text-center">{{ session('pass_changed') }}</strong>
                @endif
               </div>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if (session('wrong'))
                            <strong class="text-danger">{{ session('wrong') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">Update Password</button>
                    </div>
                </form>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('footer_script')
@if (session('success')){
    <script>
    Swal.fire(
        'Done',
        '{{ session('success') }}',
        'success'
    )
    </script>
}
@endif
@endsection
