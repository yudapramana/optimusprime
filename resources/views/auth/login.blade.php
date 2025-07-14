@extends('student.layouts.layout')

@section('content')
    <!-- Content -->
    <div class="container" style="min-height: 80vh;">
        <div class="row justify-content-center align-items-center" style="min-height: 100%;">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body login-card-body p-4">
                        <h4 class="text-center mb-4">Login - Sistem</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="remember" id="remember">
                                        <label for="remember">Ingat Saya</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                </div>
                            </div>

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
