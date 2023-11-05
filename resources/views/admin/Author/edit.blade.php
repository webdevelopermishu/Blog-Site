@extends('admin.author.main')
@section('page_content')
<div class="row">
    <div class="col-lg-6 m-auto bg-primary">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="text-center">Edit Profile</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('author.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" value="{{ Auth::guard('author')->user()->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password*">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="my-2">
                        <img width="200" src="{{ asset('uploads/author/') }}/{{ Auth::guard('author')->user()->photo }}" id="blah" alt="">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 bg-primary">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="text-center">Add Social Media</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('author.social.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        @php
                            $fonts = array (
                            'fa-facebook-f',
                            'fa-facebook-official',
                            'fa-facebook-square',
                            'fa-instagram',
                            'fa-twitch',
                            'fa-twitter',
                            'fa-twitter-square',
                            'fa-youtube',
                            'fa-youtube-play',
                            'fa-youtube-square',
                            'fa-linkedin',
                            'fa-linkedin-square',
                            'fa-snapchat',
                            'fa-snapchat-ghost',
                            'fa-snapchat-square',
                            'fa-wechat',
                            'fa-weibo',
                            'fa-whatsapp',
                            'fa-reddit',
                            'fa-reddit-alien',
                            'fa-reddit-square',
                            );
                        @endphp
                            @foreach ($fonts as $font)
                                <i class="{{ $font }} icon" data-class="{{ $font }}" style="font-family: fontawesome; font-size:40px; font-style:normal; padding:2px; cursor:pointer" ></i>
                            @endforeach
                        {{--link fontAwesome <h6>https://gist.github.com/anuislam/bc14eb036d8db39cd402c04fa9518bc7</h6> --}}
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Icon</label>
                        <input type="text" id="icon" value="" name="media_icon" class="form-control" required>
                        {{-- @error('media_icon')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror --}}
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Media Link</label>
                        <input type="text" name="media_link" class="form-control">
                        @error('media_link')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-outline-primary btn-lg">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
@if (session('updated'))
    <script>
        Swal.fire(
        'Done',
        '{{ session('updated') }}',
        'success'
        )
    </script>
@endif
@if (session('stored'))
    <script>
        Swal.fire(
        '{{ session('stored') }}',
        '--',
        'success'
        )
    </script>
@endif
<script>
    $('.icon').click(function(){
        var class_icon = $(this).attr('data-class');
        $('#icon').attr('value', class_icon);
    });
</script>
@endsection
