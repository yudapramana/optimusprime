@extends('student.layouts.layout')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">

                {{-- Judul Sistem --}}
                <div class="text-center mb-4">
                    <h5 class="font-weight-bold mb-1">
                        Sistem Informasi Pelayanan Registrasi Mahasiswa Terintegrasi
                    </h5>
                    <small class="text-muted">Silakan isi form di bawah untuk melakukan pendaftaran</small>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header font-weight-bold py-2">Formulir Registrasi Mahasiswa</div>

                    <div class="card-body py-3">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Nama --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Email Login --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Login" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- NIM --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" placeholder="NIM" value="{{ old('nim') }}" required>
                            </div>
                            @error('nim')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Gender --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                </div>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">-- Jenis Kelamin --</option>
                                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            @error('gender')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Tempat Lahir --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" name="birth_place" class="form-control @error('birth_place') is-invalid @enderror" placeholder="Tempat Lahir" value="{{ old('birth_place') }}" required>
                            </div>
                            @error('birth_place')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Tanggal Lahir --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required>
                            </div>
                            @error('birth_date')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- No HP --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="No HP" value="{{ old('phone_number') }}" required>
                            </div>
                            @error('phone_number')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Alamat --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                </div>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat" rows="2" required>{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Tahun Masuk --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="number" name="enrollment_year" class="form-control @error('enrollment_year') is-invalid @enderror" placeholder="Tahun Masuk" value="{{ old('enrollment_year', date('Y')) }}" required>
                            </div>
                            @error('enrollment_year')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Semester Masuk --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                </div>
                                <select name="entry_semester" class="form-control @error('entry_semester') is-invalid @enderror">
                                    <option value="">-- Semester Masuk --</option>
                                    <option value="ganjil" {{ old('entry_semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                                    <option value="genap" {{ old('entry_semester') == 'genap' ? 'selected' : '' }}>Genap</option>
                                </select>
                            </div>
                            @error('entry_semester')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Fakultas --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                </div>
                                <select name="faculty_id" class="form-control @error('faculty_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Fakultas --</option>
                                    @foreach ($faculties as $faculty)
                                        <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('faculty_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Password --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="eye-password"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror

                            {{-- Password Confirmation --}}
                            <div class="input-group input-group-sm mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="eye-password_confirmation"></i>
                                    </span>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group text-right mt-3">
                                <button type="submit" class="btn btn-sm btn-primary">Daftar</button>
                            </div>
                        </form>

                        <div class="text-center mt-2">
                            <a href="{{ route('login') }}">Sudah punya akun? Login di sini.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Toggle Password Script --}}
    @push('js')
        <script>
            function togglePassword(id) {
                const input = document.getElementById(id);
                const icon = document.getElementById('eye-' + id);
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>
    @endpush
@endsection
