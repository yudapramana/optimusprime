@extends('admin.layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title font-weight-bold mb-0">Verifikasi Akun Mahasiswa</h5>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th style="width: 40px">#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Fakultas</th>
                                <th>Status Akun</th>
                                <th style="width: 200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img src="{{ $student->photo_url }}" alt="Foto" class="img-circle" width="40" height="40">
                                    </td>
                                    <td class="align-middle">{{ $student->name }}</td>
                                    <td class="align-middle">{{ $student->nim }}</td>
                                    <td class="align-middle">{{ $student->faculty->name }}</td>
                                    <td class="align-middle text-center">
                                        @php
                                            $badgeClass = match ($student->account_status) {
                                                'pending' => 'warning',
                                                'verified' => 'success',
                                                'rejected' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge badge-{{ $badgeClass }}">
                                            {{ ucfirst($student->account_status) }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('admin.students.verification.update', $student->id) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control form-control-sm mr-2" required>
                                                <option value="">-- Pilih --</option>
                                                <option value="verified" {{ $student->account_status === 'verified' ? 'selected' : '' }}>Verifikasi</option>
                                                <option value="rejected" {{ $student->account_status === 'rejected' ? 'selected' : '' }}>Tolak</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Simpan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada akun mahasiswa yang menunggu verifikasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
