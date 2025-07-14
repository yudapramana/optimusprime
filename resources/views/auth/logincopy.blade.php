@extends('student.layouts.layout')

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login - Sistem</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-block btn-primary">Sign In</button>
                        </div>
                    </div>

                    {{-- <p class="mb-1">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                I forgot my password
                            </a>
                        @endif
                    </p> --}}

                    <div class="mt-3">
                        <label class="d-block mb-2">Login Demo:</label>
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-info btn-sm mb-2" onclick="fillDemo('student1')">Student_1</button>
                            <button type="button" class="btn btn-outline-info btn-sm mb-2" onclick="fillDemo('student2')">Student_2</button>
                            <button type="button" class="btn btn-outline-warning btn-sm mb-2" onclick="fillDemo('admin')">Admin</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<script>
    function fillDemo(role) {
        const emails = {
            student1: 'fauzi@student.ac.id',
            student2: 'siti@student.ac.id',
            admin: 'admin@ekasakti.ac.id'
        };

        const passwords = {
            student1: 'password',
            student2: 'password',
            admin: 'password'
        };

        document.getElementById('email').value = emails[role];
        document.getElementById('password').value = passwords[role];
    }
</script>
