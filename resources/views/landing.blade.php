<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPRIMA - Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <style>
        .hero-section {
            background: linear-gradient(135deg, #0069d9 0%, #004a9f 100%);
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2v-4h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2v-4h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0069d9;
        }

        .feature-card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card {
            background: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
            height: 100%;
        }

        .testimonial-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .cta-section {
            background-color: #f8f9fa;
            padding: 4rem 0;
        }

        .navbar-brand img {
            height: 40px;
        }

        .system-screenshot {
            border-radius: 0.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">

    <div id="preloader" class="d-flex justify-content-center align-items-center" style="position: fixed; z-index: 9999; background: white; width: 100%; height: 100vh;">
        <div class="text-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Memuat halaman...</p>
        </div>
    </div>

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="index.html" class="navbar-brand">
                    <span class="brand-text font-weight-bold text-primary">SIPRIMA</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#testimonials">Testimoni</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <a href="/login" class="btn btn-primary ml-2">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-bg-pattern"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 hero-content">
                        <h1 class="display-4 font-weight-bold mb-4">Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi</h1>
                        <p class="lead mb-4">Solusi terpadu untuk memudahkan proses registrasi mahasiswa baru dengan sistem yang efisien dan terintegrasi.</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="/register" class="btn btn-light btn-lg">Registrasi</a>&nbsp;
                            <a href="/login" class="btn btn-outline-light btn-lg">Login</a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/48b1d44b-9595-4d90-9cf4-23bb2573511b.png" alt="Dashboard sistem registrasi mahasiswa modern dengan grafik dan formulir digital" class="img-fluid system-screenshot">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="font-weight-bold">Fitur Unggulan SIPRIMA</h2>
                    <p class="lead text-muted">Solusi lengkap untuk manajemen registrasi mahasiswa</p>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card p-4">
                            <div class="text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <h4>Registrasi Online</h4>
                                <p class="text-muted">Proses registrasi mahasiswa baru dapat dilakukan secara online tanpa perlu antri.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card feature-card p-4">
                            <div class="text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <h4>Pembayaran Terintegrasi</h4>
                                <p class="text-muted">Sistem pembayaran yang terintegrasi dengan berbagai metode pembayaran.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card feature-card p-4">
                            <div class="text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h4>Analisis Data</h4>
                                <p class="text-muted">Laporan dan analisis data registrasi secara real-time untuk pengambilan keputusan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card p-4">
                            <div class="text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <h4>Notifikasi Otomatis</h4>
                                <p class="text-muted">Sistem notifikasi untuk mengingatkan tahapan registrasi yang harus diselesaikan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card feature-card p-4">
                            <div class="text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <h4>Database Terpusat</h4>
                                <p class="text-muted">Penyimpanan data terpusat yang aman dan mudah diakses oleh pihak terkait.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card feature-card p-4">
                            <div class="text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h4>Responsive Design</h4>
                                <p class="text-muted">Akses sistem melalui berbagai perangkat termasuk smartphone dan tablet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f541ce97-a16b-4986-8a8c-35d0daf63313.png" alt="Tim IT sedang bekerja mengembangkan sistem registrasi mahasiswa di kantor modern" class="img-fluid rounded">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="font-weight-bold mb-4">Tentang SIPRIMA</h2>
                        <p>SIPRIMA (Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi) adalah solusi teknologi yang dikembangkan untuk memodernisasi proses registrasi mahasiswa baru di perguruan tinggi.</p>
                        <p>Sistem ini dirancang untuk menyederhanakan alur kerja administrasi, mengurangi kesalahan data, dan memberikan pengalaman yang lebih baik bagi calon mahasiswa.</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="font-weight-bold">Apa Kata Mereka?</h2>
                    <p class="lead text-muted">Testimoni dari pengguna SIPRIMA</p>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ab8d07c0-e1ec-4487-a6d4-815ff6078f1d.png" alt="Foto dosen senior dengan kacamata tersenyum" class="testimonial-img mr-3">
                                <div>
                                    <h5 class="mb-0">Prof. Dr. Ahmad</h5>
                                    <small class="text-muted">Ketua Program Studi</small>
                                </div>
                            </div>
                            <p>"SIPRIMA sangat membantu mengurangi beban administrasi kami. Proses registrasi yang sebelumnya memakan waktu berminggu-minggu sekarang bisa diselesaikan dalam hitungan hari."</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ba39fe07-12b4-4f86-91a2-660f018cd4b6.png" alt="Foto mahasiswa muda tersenyum memegang laptop" class="testimonial-img mr-3">
                                <div>
                                    <h5 class="mb-0">Sarah Wijaya</h5>
                                    <small class="text-muted">Mahasiswa Baru</small>
                                </div>
                            </div>
                            <p>"Saya sangat senang bisa menyelesaikan seluruh proses registrasi dari rumah. Sistemnya sangat mudah digunakan dan petugas sangat responsif ketika saya menghubungi."</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b3bcc236-4aab-498f-9537-c4e2d90ebb46.png" alt="Foto administrator kampus dengan pakaian formal" class="testimonial-img mr-3">
                                <div>
                                    <h5 class="mb-0">Budi Santoso</h5>
                                    <small class="text-muted">Staff Administrasi</small>
                                </div>
                            </div>
                            <p>"Dengan SIPRIMA, kami bisa memproses data lebih cepat dan akurat. Fitur verifikasi otomatis sangat membantu mengurangi kesalahan input data."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section id="cta" class="cta-section">
            <div class="container text-center">
                <h2 class="font-weight-bold mb-4">Siap Menggunakan SIPRIMA?</h2>
                <p class="lead mb-5">Mulai gunakan sistem kami sekarang dan rasakan kemudahan dalam proses registrasi mahasiswa.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="login.html" class="btn btn-primary btn-lg px-4">Login Sekarang</a>
                    <a href="#contact" class="btn btn-outline-primary btn-lg px-4">Hubungi Kami</a>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5 bg-white">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="font-weight-bold">Hubungi Kami</h2>
                    <p class="lead text-muted">Kami siap membantu Anda</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informasi Kontak</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                                        Jl. Pendidikan No. 1, Kota Akademik
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-phone mr-2 text-primary"></i>
                                        (021) 1234-5678
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-envelope mr-2 text-primary"></i>
                                        info@siprima.ac.id
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-clock mr-2 text-primary"></i>
                                        Senin-Jumat: 08.00 - 16.00 WIB
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Kirim Pesan</h4>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Alamat Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Subjek">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="4" placeholder="Pesan Anda"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="main-footer bg-dark text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5>Tentang SIPRIMA</h5>
                        <p>Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi adalah solusi teknologi untuk perguruan tinggi.</p>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5>Link Cepat</h5>
                        <ul class="list-unstyled">
                            <li><a href="#features" class="text-white">Fitur</a></li>
                            <li><a href="#about" class="text-white">Tentang</a></li>
                            <li><a href="#testimonials" class="text-white">Testimoni</a></li>
                            <li><a href="#contact" class="text-white">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Ikuti Kami</h5>
                        <div class="social-links">
                            <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white mr-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white mr-3"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <hr class="my-4 bg-light">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="mb-0">© 2023 SIPRIMA. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <p class="mb-0">Dikembangkan oleh Tim IT Universitas Pendidikan</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Smooth scrolling for anchor links
            $('a[href*="#"]').on('click', function(e) {
                e.preventDefault();

                $('html, body').animate({
                        scrollTop: $($(this).attr('href')).offset().top - 70,
                    },
                    500,
                    'linear'
                );
            });

            // Navbar background change on scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.main-header').addClass('navbar-light bg-white shadow-sm');
                    $('.main-header').removeClass('navbar-white');
                } else {
                    $('.main-header').removeClass('navbar-light bg-white shadow-sm');
                    $('.main-header').addClass('navbar-white');
                }
            });
        });
    </script>

    <!-- Preloader Hide -->
    <script>
        $(window).on('load', function() {
            $('#preloader').fadeOut('slow', function() {
                $(this).remove();
            });
        });
    </script>
</body>

</html>
