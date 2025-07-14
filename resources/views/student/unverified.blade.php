@extends('student.layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card shadow border-warning">
                    <div class="card-body py-4">
                        <i class="fas fa-user-clock fa-3x text-warning mb-3"></i>
                        <h4 class="mb-3 font-weight-bold text-warning">Akun Belum Diverifikasi</h4>
                        <p class="mb-0 text-muted">
                            Akun Anda saat ini masih dalam proses verifikasi oleh admin.
                        </p>
                        <p class="text-muted">
                            Mohon menunggu beberapa saat hingga proses verifikasi selesai.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
