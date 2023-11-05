@extends('frontend.master')
@section('page_content')
<!--Reset-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Reset Your Password</h4>
                    <p></p>
                    <form  action="{{ route('pass.reset.confirm', $token) }}" class="sign-form widget-form " method="post">
                        @csrf
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="New Password*" name="password" >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password*" name="confirm_password">
                            </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
