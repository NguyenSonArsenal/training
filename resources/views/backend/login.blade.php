<!DOCTYPE html>
<html>
<head>
    @include ('include.admin.inc_admin_link')

    @section('title', 'Login')

    <link rel="stylesheet"
          href="<?=asset('assets/admin/css/login.css')?>">

</head>

<body>
<div class="wrapper">
    <div class="login">
        <div class="form_login">
            <h3>Login</h3>

            @if ($errors->has('admin_login_error'))
                <div class="error_login">
                    <div class="form-group">
                        <label class="control-label show_error_login">
                            {{$errors->first('admin_login_error')}}
                        </label>
                    </div>
                </div>
            @endif

            <form class="form" action="{{ route('admin.login.post') }}" method="post">

                {{csrf_field()}}

                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" class="form-control input_email"
                           name="email" value="{{ old('email') }}"
                           placeholder="Enter your email">
                    @if ($errors->has('email'))
                        <span class="txt_error_validate">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control input_password"
                           name="password" value="{{ old('password') }}"
                           placeholder="Enter your password">
                    @if ($errors->has('password'))
                        <span class="txt_error_validate">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btnLogin" type="submit" value="Login">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>