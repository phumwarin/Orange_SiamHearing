@extends('admin.layout.auth-layout')

@section('content')
    <div class="login-box">
        <div class="text-center mb-3">
            <img src="{{ url('') }}/assets/img/illustrations/Daikin-Logo.png" class="mw-100 logo-scale" alt="Daikin Logo" height="50">
        </div>
        <h4 class="login-title mb-3">Log In</h4>

        <form id="login-form">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control login__input" id="email" name="email"
                    placeholder="you@example.com" autofocus>
                <div id="error-email" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control login__input"
                        placeholder="••••••••">
                    <span class="input-group-text cursor-pointer" onclick="togglePassword()">
                        <i id="eye-icon" class="ti ti-eye-off"></i>
                    </span>
                </div>
                <div id="error-password" class="text-danger mt-1"></div>
            </div>

            <div class="mb-3 d-flex justify-content-between">
                <a href="javascript:void(0);" class="small forgot-color">Forgot password?</a>
                <a href="{{ route('register.index') }}" class="register-color small">Register</a>
            </div>

            <button id="btn-login" type="button" class="btn btn-daikin w-100">Login</button>
        </form>
    </div>
@endsection

@section('script')
<script>
    function togglePassword() {
        const field = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('ti-eye-off', 'ti-eye');
        } else {
            field.type = 'password';
            icon.classList.replace('ti-eye', 'ti-eye-off');
        }
    }

    (function () {
        async function login() {
            $('.login__input').removeClass('border-danger');
            $('.text-danger').html('');
            const email = $('#email').val();
            const password = $('#password').val();
            $('#btn-login').html('<i class="ti ti-loader spinner-border spinner-border-sm"></i>');
            try {
                await axios.post('{{ route('login.check') }}', { email, password });
                window.location.href = '/admin/job';
            } catch (err) {
                $('#btn-login').html('Login');
                if (err.response?.data?.errors) {
                    for (const [key, msg] of Object.entries(err.response.data.errors)) {
                        $(`#${key}`).addClass('border-danger');
                        $(`#error-${key}`).html(msg);
                    }
                } else if (err.response?.data?.message) {
                    $('#password').addClass('border-danger');
                    $('#error-password').html(err.response.data.message);
                }
            }
        }

        $('#btn-login').on('click', login);
        $('#login-form').on('keyup', function (e) {
            if (e.keyCode === 13) login();
        });
    })();
</script>
@endsection
