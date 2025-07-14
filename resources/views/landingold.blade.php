<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi (SIPERMATA) (SIPERMATA)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .animate-pulse-slow {
            animation: pulse 4s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-blue-500 border-dashed rounded-full animate-spin"></div>
            <p class="mt-4 text-lg font-semibold text-blue-800">Memuat Sistem...</p>
        </div>
    </div>

    <!-- Header/Navigation -->
    <header class="sticky top-0 z-50 gradient-bg text-white shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="https://res.cloudinary.com/dezj1x6xp/image/upload/v1752311751/PandanViewMandeh/ChatGPT_Image_Jul_12_2025_04_15_28_PM_cuqo9a.png" width="50" height="50" alt="Logo Universitas dengan lambang akademik dalam warna putih" class="mr-3" />
                    <a href="#" class="text-xl font-bold text-white">SIPERMATA</a>
                </div>

                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-white hover:text-blue-200 transition">Beranda</a>
                    <a href="#fitur" class="text-white hover:text-blue-200 transition">Fitur</a>
                    <a href="#panduan" class="text-white hover:text-blue-200 transition">Panduan</a>
                    <a href="#kontak" class="text-white hover:text-blue-200 transition">Kontak</a>
                </nav>

                <div class="flex items-center space-x-4">

                    @if (!\Illuminate\Support\Facades\Auth::user())
                        <a href="/login" class="px-4 py-2 rounded-md text-blue-900 bg-white hover:bg-blue-100 font-medium transition">Login</a>
                    @else
                        <a class="px-4 py-2 rounded-md text-blue-900 bg-white hover:bg-blue-100 font-medium transition" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif

                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="text-white focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden gradient-bg pb-4 px-6">
            <div class="flex flex-col space-y-3">
                <a href="#beranda" class="text-white hover:text-blue-200 transition">Beranda</a>
                <a href="#fitur" class="text-white hover:text-blue-200 transition">Fitur</a>
                <a href="#panduan" class="text-white hover:text-blue-200 transition">Panduan</a>
                <a href="#kontak" class="text-white hover:text-blue-200 transition">Kontak</a>
                <a href="#" class="mt-2 px-4 py-2 rounded-md text-blue-900 bg-white hover:bg-blue-100 font-medium transition text-center">Login</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg text-white py-20 md:py-32">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                        Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi
                    </h1>
                    <p class="text-xl mb-8">
                        Solusi digital terpadu untuk proses registrasi mahasiswa yang cepat, mudah, dan efisien.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">

                        @auth
                            <a href="{{ route('home') }}" class="px-8 py-3 bg-white text-blue-900 font-semibold rounded-md hover:bg-blue-100 transition text-center">
                                Beranda Aplikasi <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @else
                            {{-- <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">Login Sekarang</a> --}}
                            <a href="#" class="px-8 py-3 bg-white text-blue-900 font-semibold rounded-md hover:bg-blue-100 transition text-center">
                                Daftar Sekarang <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @endauth

                        <a href="#fitur" class="px-8 py-3 border-2 border-white text-white font-semibold rounded-md hover:bg-white hover:text-blue-900 transition text-center">
                            Pelajari Fitur <i class="fas fa-info-circle ml-2"></i>
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://placehold.co/600x400" alt="Ilustrasi digital mahasiswa sedang melakukan registrasi online dengan laptop dan dashboard sistem modern" class="rounded-lg shadow-xl" />
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan Sistem</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Mengoptimalkan seluruh proses registrasi mahasiswa dalam satu platform terintegrasi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md feature-card transition duration-300">
                    <div class="text-blue-600 mb-6 text-4xl">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Registrasi Online</h3>
                    <p class="text-gray-600">
                        Proses pendaftaran mahasiswa baru secara online dengan verifikasi dokumen digital yang cepat dan akurat.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md feature-card transition duration-300">
                    <div class="text-blue-600 mb-6 text-4xl">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Pembayaran Terintegrasi</h3>
                    <p class="text-gray-600">
                        Sistem pembayaran registrasi yang terhubung dengan berbagai metode pembayaran digital.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md feature-card transition duration-300">
                    <div class="text-blue-600 mb-6 text-4xl">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Dashboard Analitik</h3>
                    <p class="text-gray-600">
                        Pemantauan real-time statistik registrasi mahasiswa untuk keputusan administrasi yang lebih baik.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-xl shadow-md feature-card transition duration-300">
                    <div class="text-blue-600 mb-6 text-4xl">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Upload Dokumen</h3>
                    <p class="text-gray-600">
                        Unggah dokumen persyaratan secara mudah dengan sistem validasi otomatis.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-xl shadow-md feature-card transition duration-300">
                    <div class="text-blue-600 mb-6 text-4xl">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Notifikasi Real-time</h3>
                    <p class="text-gray-600">
                        Informasi perkembangan proses registrasi langsung melalui email dan SMS.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-xl shadow-md feature-card transition duration-300">
                    <div class="text-blue-600 mb-6 text-4xl">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Responsif Multi-Device</h3>
                    <p class="text-gray-600">
                        Akses sistem melalui smartphone, tablet, atau komputer dengan tampilan yang optimal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="panduan" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Cara Menggunakan Sistem</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Proses registrasi yang mudah hanya dalam beberapa langkah sederhana
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <div class="relative">
                        <!-- Steps -->
                        <div class="flex items-start mb-8">
                            <div class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center mr-4 flex-shrink-0">1</div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Buat Akun</h4>
                                <p class="text-gray-600">
                                    Daftarkan email dan buat password untuk mengakses sistem registrasi.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start mb-8">
                            <div class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center mr-4 flex-shrink-0">2</div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Isi Data Pribadi</h4>
                                <p class="text-gray-600">
                                    Lengkapi formulir registrasi dengan data diri dan informasi pendidikan sebelumnya.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start mb-8">
                            <div class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center mr-4 flex-shrink-0">3</div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Upload Dokumen</h4>
                                <p class="text-gray-600">
                                    Unggah dokumen persyaratan seperti ijazah, foto, dan KTP dalam format PDF atau JPG.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start mb-8">
                            <div class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center mr-4 flex-shrink-0">4</div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Pembayaran</h4>
                                <p class="text-gray-600">
                                    Lakukan pembayaran biaya registrasi melalui metode yang tersedia.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-blue-600 text-white rounded-full h-10 w-10 flex items-center justify-center mr-4 flex-shrink-0">5</div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Konfirmasi</h4>
                                <p class="text-gray-600">
                                    Tunggu verifikasi dan terima notifikasi status registrasi Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 flex justify-center">
                    <img src="https://placehold.co/600x400" alt="Diagram alur proses registrasi online mahasiswa dengan ilustrasi langkah-langkah sistem" class="rounded-lg shadow-lg" />
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-20 bg-blue-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa Kata Mereka</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Testimoni dari pengguna sistem registrasi kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/139f37a0-31b8-4d25-a500-5028e8dfa7f5.png" alt="Foto mahasiswi berpakaian rapi dengan latar belakang kampus" class="rounded-full h-12 w-12 object-cover mr-3" />
                        <div>
                            <h4 class="font-semibold">Dewi Lestari</h4>
                            <p class="text-sm text-gray-500">Mahasiswi Teknik Informatika</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "Sangat mudah digunakan! Proses registrasi yang biasanya memakan waktu berjam-jam sekarang bisa selesai dalam 30 menit saja."
                    </p>
                    <div class="mt-3 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/71287edd-cf2b-4fe0-ad01-db2e81971711.png" alt="Foto mahasiswa berkacamata dengan latar belakang perpustakaan" class="rounded-full h-12 w-12 object-cover mr-3" />
                        <div>
                            <h4 class="font-semibold">Rizky Pratama</h4>
                            <p class="text-sm text-gray-500">Mahasiswa Manajemen</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "Notifikasi real-time sangat membantu. Saya selalu tahu status registrasi saya tanpa harus datang ke kampus."
                    </p>
                    <div class="mt-3 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/fa772952-f1f1-4ef6-84d0-d14afb203ae2.png" alt="Foto staff administrasi kampus dengan identitas nama di dada" class="rounded-full h-12 w-12 object-cover mr-3" />
                        <div>
                            <h4 class="font-semibold">Budi Santoso</h4>
                            <p class="text-sm text-gray-500">Staff Administrasi</p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        "Sistem ini sangat meringankan pekerjaan kami. Verifikasi dokumen dan pembayaran jadi lebih sistematis dan akurat."
                    </p>
                    <div class="mt-3 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 animate-pulse-slow">
                Siap Memulai Registrasi Anda?
            </h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan mahasiswa lainnya yang telah merasakan kemudahan registrasi online
            </p>
            <div class="flex justify-center">
                <a href="#" class="px-8 py-3 bg-white text-blue-900 font-semibold rounded-md hover:bg-blue-100 transition text-center">
                    Daftar Sekarang <i class="fas fa-user-graduate ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Tentang SIPERMATA</h3>
                    <p class="text-gray-400">
                        Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi (SIPERMATA) merupakan platform digital untuk mempermudah proses registrasi mahasiswa baru dan lama.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#fitur" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#panduan" class="text-gray-400 hover:text-white transition">Panduan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Login</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Kontak Kami</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Jl. Pendidikan No. 1, Kota Akademik
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2"></i>
                            (021) 1234-5678
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            sirma@universitas.edu
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>

                    <h3 class="text-xl font-semibold mt-6 mb-4">Download Aplikasi</h3>
                    <div class="flex space-x-2">
                        <a href="#" class="bg-gray-700 hover:bg-gray-600 p-2 rounded-md">
                            <i class="fab fa-google-play text-lg mr-1"></i> Play Store
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-gray-600 p-2 rounded-md">
                            <i class="fab fa-apple text-lg mr-1"></i> App Store
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-400">
                <p>© 2023 SIPERMATA - Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });

        // Add shadow to header on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });
    </script>
</body>

</html>
