@extends('frontend.master')
@section('page_content')
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Login</h4>
                    <p></p>
                    <form  action="{{ route('login.confirm') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email*" name="email" value="">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            @if (session('passerror'))
                                <strong class="text-danger">{{ session('passerror') }}</strong>
                            @endif
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="{{ route('pass.reset.req') }}" class="btn-link ">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Log in</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('github.redirect') }}" class="btn btn-secondary">Login with GitHub</a>
                            <a href="{{ route('google.redirect') }}" class="btn btn-primary">Login with Google</a>
                        </div>
                        <p class="form-group text-center">Don't have an account? <a href="{{ route('author.reg') }}" class="btn-link">Create One</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer_script')
@if (session('notexist'))
<script>
    Swal.fire('{{ session('notexist') }}')
</script>
@endif
@if (session('changed'))
    <script>
        Swal.fire(
        'Success!',
        '{{ session('changed') }}',
        'success'
        )
    </script>
@endif
@if (session('verified'))
    <script>
        Swal.fire(
        'Success!',
        '{{ session('verified') }}',
        'success'
        )
    </script>
@endif
@if (session('time_out'))
    <script>
        Swal.fire(
        'Error!',
        '{{ session('time_out') }}',
        'error'
        )
    </script>
@endif
@if (session('unverified'))
    <script>
        Swal.fire(
        'Error!',
        '{{ session('unverified') }}',
        'error'
        )
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire(
        'Error!',
        '{{ session('error') }}',
        'error'
        )
    </script>
@endif
@endsection
