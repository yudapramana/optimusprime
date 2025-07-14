@extends('student.layouts.layout')

@section('content')
    <div class="content pt-3">
        <!-- Content Header -->
        <div class="content-header py-2">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h4 class="m-0 font-weight-bold">Dashboard Mahasiswa</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content pb-4">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mata Kuliah</span>
                                <span class="info-box-number">12</span>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tagihan</span>
                                <span class="info-box-number">Rp 2.450.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Jadwal</span>
                                <span class="info-box-number">14</span>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bell"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Notifikasi</span>
                                <span class="info-box-number">3</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8 mb-3">
                        <!-- Recent Activities -->
                        <div class="card card-outline card-info">
                            <div class="card-header py-2">
                                <h6 class="card-title mb-0 font-weight-bold">Aktivitas Terkini</h6>
                            </div>
                            <div class="card-body p-2">
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item">✔️ Pembayaran UKT April 2023 telah diterima</li>
                                    <li class="list-group-item">📌 Pengajuan KRS Semester Genap telah disetujui</li>
                                    <li class="list-group-item">📅 Jadwal Ujian Tengah Semester telah diupdate</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right col -->
                    <div class="col-md-4 mb-3">
                        <!-- Profile Box -->
                        <div class="card card-outline card-primary">
                            <div class="card-header py-2">
                                <h6 class="card-title mb-0 font-weight-bold">Profil Mahasiswa</h6>
                            </div>
                            <div class="card-body text-center p-3">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/04038501-320a-4167-882d-d6a8642b5b1a.png" width="80" height="80" class="img-circle mb-2 border" alt="Foto Profil">
                                <h5 class="mb-1">Sarah Wijaya</h5>
                                <small class="d-block text-muted mb-1">NIM: 210401001</small>
                                <small class="d-block">Teknik Informatika - Semester 4</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
