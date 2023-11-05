@extends('layouts.admin')
@section('page_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Media List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">SL</th>
                        <th class="text-center">Icon</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($socials as $sl=>$social)
                    <tr>
                        <td class="text-center">{{ $sl+1 }}</td>
                        <td class="text-center">
                            <i class="{{ $social->media_icon }}" style="font-family:fontawesome; font-size:30px; font-style:normal; "></i>
                        </td>
                        <td><a target="_blank" href="{{ $social->media_link }}" >{{ $social->media_name }}</a></td>
                        <td class="text-center">
                            <a href="{{ route('social.status.change', $social->id) }}" class="btn btn-{{ $social->status==0?'secondary':'success' }}">{{ $social->status==0?'Deactive':'Active' }}</a>
                        </td>
                        <td class="text-center">
                            <a style="cursor:pointer" data-link="{{ route('social.delete', $social->id) }}" class="text-danger del">
                                <i data-feather=trash-2></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Add Social Media</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('social.store') }}" method="POST">
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
                        <label for="" class="form-label">Media Name</label>
                        <input type="text" name="media_name" class="form-control">
                        @error('media_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Media Link</label>
                        <input type="text" name="media_link" class="form-control">
                        @error('media_link')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-info btn-lg">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
    <script>
        $('.icon').click(function(){
            var class_icon = $(this).attr('data-class');
            $('#icon').attr('value', class_icon);
        });
    </script>
    <script>
        $('.del').click(function(){
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
                window.location.href=link;
            }
            })
        })
    </script>
@if (session('success'))
    <script>
        swal.fire(
            'Success',
            '--',
            'success',
        )
    </script>
@endif
@if (session('delete'))
    <script>
        swal.fire(
            '{{ session('delete') }}',
            '--',
            'success',
        )
    </script>
@endif
@if (session('active'))
    <script>
        swal.fire(
            '{{ session('active') }}',
            '--',
            'success',
        )
    </script>
@endif
@if (session('deactive'))
    <script>
        swal.fire(
            '{{ session('deactive') }}',
            '--',
            'warning',
        )
    </script>
@endif
@endsection
