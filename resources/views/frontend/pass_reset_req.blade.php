@extends('frontend.master')
@section('page_content')
<!--Reset-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Request for Reset</h4>
                    <p></p>
                    <form  action="{{ route('reset.req.send') }}" class="sign-form widget-form " method="post">
                        @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="email*" name="email" value="">
                            </div>
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Request for reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer_script')
@if (session('not_exist'))
    <script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('not_exist') }}',
        })
    </script>
@endif
@if (session('mail_sent'))
    <script>
        Swal.fire(
        'Sent!',
        '{{ session('mail_sent') }}',
        'info'
        )
    </script>
@endif
@if (session('time_out'))
    <script>
        Swal.fire(
        'Invalid Link!',
        '{{ session('time_out') }}',
        'error'
        )
    </script>
@endif
@endsection
