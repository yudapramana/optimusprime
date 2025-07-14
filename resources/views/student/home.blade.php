@extends('student.layouts.layout')

@section('content')
    <div class="content pt-3">
        <div class="content-header py-2">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h4 class="m-0 font-weight-bold">Dashboard Mahasiswa</h4>
                    </div>
                </div>
            </div>
        </div>

        <section class="content pb-4">
            <div class="container-fluid">
                <!-- Info Boxes -->
                <div class="row row-cols-1  row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tagihan Aktif (T-{{ $tagihan->installment_number ?? '-' }})</span>

                                @if (!is_null($tagihan))
                                    <span class="info-box-number">
                                        Rp {{ number_format($tagihan->amount_paid ?? 0, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="info-box-number text-muted">Tidak ada tagihan</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-file-invoice-dollar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Tagihan</span>
                                <span class="info-box-number">Rp {{ number_format($total_tagihan, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-coins"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Pembayaran</span>
                                <span class="info-box-number">Rp {{ number_format($total_pembayaran, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-bell"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Status Pembayaran</span>
                                <span class="info-box-number">{{ $status_pembayaran }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Left Column -->

                    <div class="col-md-8 mb-3">
                        <div class="card card-outline card-info">
                            <div class="card-header py-2">
                                <h6 class="card-title mb-0 font-weight-bold">
                                    Rincian Pembayaran
                                </h6>
                            </div>
                            <div class="card-body p-2">
                                @if ($current_installment)
                                    {{-- BOX INSTALLMENT --}}
                                    <div class="border rounded p-3 mb-3 small bg-light">

                                        <div class="mb-3 text-center">
                                            <div class="row row-cols-1 row-cols-md-3 text-center">
                                                <div class="col mb-1">
                                                    <strong>Tahun Ajaran:</strong><br>
                                                    {{ $current_installment->academicSemester->tahun_ajaran ?? '-' }}
                                                </div>
                                                <div class="col mb-1">
                                                    <strong>Skema Pembayaran:</strong><br>
                                                    {{ ucwords(str_replace('_', ' ', $current_installment->scheme->scheme_name ?? '-')) }}
                                                </div>
                                                <div class="col mb-1">
                                                    <strong>Biaya Kuliah:</strong><br>
                                                    Rp {{ number_format($current_installment->tuition_fee, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2">
                                            <strong class="d-block mb-1 text-primary">Informasi Angsuran</strong>
                                            <div><strong>Tahun Ajaran:</strong> {{ $current_installment->academic_semester->tahun_ajaran ?? '-' }}</div>
                                            <div><strong>Semester:</strong> {{ ucfirst($current_installment->academic_semester->semester ?? '-') }}</div>
                                            <div><strong>Skema Pembayaran:</strong> {{ ucwords(str_replace('_', ' ', $current_installment->scheme->scheme_name ?? '-')) }}</div>
                                            <div><strong>Biaya Kuliah:</strong> Rp {{ number_format($current_installment->tuition_fee, 0, ',', '.') }}</div>
                                        </div> --}}

                                        {{-- BOX PAYMENTS --}}
                                        @if (count($current_installment->payments) > 0)
                                            <ul class="list-group list-group-flush">
                                                @foreach ($current_installment->payments as $payment)
                                                    <li class="list-group-item px-2 py-2">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="pe-3">
                                                                <strong>Termin {{ $payment->installment_number }}</strong><br>
                                                                <span style="font-size: small">Persentase: {{ $payment->percentage }}%</span><br>
                                                                <span style="font-size: small">Nominal: Rp {{ number_format($payment->amount_paid ?? 0, 0, ',', '.') }}</span><br>
                                                                <span style="font-size: small">Jatuh Tempo: {{ \Carbon\Carbon::parse($payment->due_date)->translatedFormat('d M Y') }}</span><br>

                                                                @if ($payment->upload_date)
                                                                    <span style="font-size: small">Upload: {{ \Carbon\Carbon::parse($payment->upload_date)->translatedFormat('d M Y') }}</span><br>
                                                                @endif

                                                                @if ($payment->notes)
                                                                    <span style="font-size: small">Catatan: <em>{{ $payment->notes }}</em></span><br>
                                                                @endif
                                                            </div>

                                                            {{-- Status & Tombol --}}
                                                            <div class="text-end d-flex flex-column justify-content-between align-items-end" style="min-width: 120px;">
                                                                @php
                                                                    $badgeClass = match ($payment->status) {
                                                                        'not_uploaded' => 'secondary',
                                                                        'pending' => 'warning',
                                                                        'approved' => 'success',
                                                                        'rejected' => 'danger',
                                                                        default => 'dark',
                                                                    };
                                                                @endphp

                                                                <div>
                                                                    <span class="badge badge-{{ $badgeClass }}">
                                                                        {{-- {{ ucfirst(str_replace('_', ' ', $payment->status)) }} --}}
                                                                        {{ $payment->status_label }}
                                                                    </span>
                                                                </div>



                                                                {{-- <div class="d-flex flex-column gap-1"> --}}
                                                                <div class="mt-3 w-100 pull-end text-right">
                                                                    {{-- Tombol Lihat Bukti atau Upload Ulang --}}
                                                                    @if ($payment->eviden_url && $payment->status !== 'rejected')
                                                                        <a href="{{ $payment->eviden_url }}" target="_blank" class=" px-2 py-1 badge bg-gray-dark text-white text-decoration-none d-inline-block" style="cursor: pointer;">
                                                                            Bukti Bayar
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ route('student.payments.edit', $payment->id) }}" class=" px-2 py-1 badge badge-primary text-white text-decoration-none d-inline-block" style="cursor: pointer;">
                                                                            Upload Bukti
                                                                        </a>
                                                                    @endif

                                                                    {{-- Tombol Cetak Kwitansi jika status approved --}}
                                                                    @if ($payment->status === 'approved')
                                                                        <a href="{{ route('student.payments.receipt', $payment->id) }}" target="_blank" class=" px-2 py-1 badge badge-success text-white text-decoration-none d-inline-block" style="cursor: pointer;">
                                                                            Cetak Kwitansi
                                                                        </a>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="text-center py-3">
                                                <p class="text-muted mb-2">Belum ada data pembayaran untuk semester ini.</p>
                                                <a href="{{ route('student.installments.create') }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-plus mr-1"></i> Tambah Pembayaran
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <p class="text-muted mb-2">Belum ada data installment untuk semester ini.</p>
                                        <a href="{{ route('student.installments.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus mr-1"></i> Tambah Pembayaran
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>



                    {{-- <div class="col-md-8 mb-3">
                        <div class="card card-outline card-info">
                            <div class="card-header py-2">
                                <h6 class="card-title mb-0 font-weight-bold">
                                    Pembayaran {{ $academic_semester->tahun_ajaran }}
                                </h6>
                            </div>
                            <div class="card-body p-2">
                                @if ($current_installment && count($current_installment->payments) > 0)
                                    <ul class="list-group list-group-flush small">
                                        @forelse ($current_installment->payments as $payment)
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <strong>Termin {{ $payment->installment_number }}</strong><br>
                                                        <span>Persentase: {{ $payment->percentage }}%</span><br>
                                                        <span>Nominal: Rp {{ number_format($payment->amount_paid ?? 0, 0, ',', '.') }}</span><br>
                                                        <span>Jatuh Tempo: {{ \Carbon\Carbon::parse($payment->due_date)->translatedFormat('d M Y') }}</span><br>

                                                        @if ($payment->upload_date)
                                                            <span>Upload: {{ \Carbon\Carbon::parse($payment->upload_date)->translatedFormat('d M Y') }}</span><br>
                                                        @endif

                                                        @if ($payment->notes)
                                                            <span>Catatan: <em>{{ $payment->notes }}</em></span><br>
                                                        @endif

                                                        @if ($payment->eviden_url)
                                                            <a href="{{ $payment->eviden_url }}" target="_blank" class="text-primary">📎 Lihat Bukti</a><br>
                                                        @endif

                                                        <div class="mt-2">
                                                            <a href="{{ route('student.payments.show', $payment->id) }}" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat Detail
                                                            </a>
                                                            <a href="{{ route('student.payments.edit', $payment->id) }}" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-upload"></i> Upload Bukti
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $badgeClass = match ($payment->status) {
                                                            'not_uploaded' => 'secondary', 
                                                            'pending' => 'warning', 
                                                            'approved' => 'success', 
                                                            'rejected' => 'danger', 
                                                            default => 'dark',
                                                        };
                                                    @endphp

                                                    <span class="badge badge-{{ $badgeClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                                    </span>
                                                </div>
                                            </li>

                                        @empty
                                            <li class="list-group-item text-muted">Belum ada data pembayaran.</li>
                                        @endforelse
                                    </ul>
                                @else
                                    <div class="text-center py-3">
                                        <p class="text-muted mb-2">Belum ada data pembayaran untuk semester ini.</p>
                                        <a href="{{ route('student.installments.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus mr-1"></i> Tambah Pembayaran
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> --}}

                    <!-- Right Column -->
                    <div class="col-md-4 mb-3">
                        <div class="card card-outline card-primary">
                            <div class="card-header py-2">
                                <h6 class="card-title mb-0 font-weight-bold">Profil Mahasiswa</h6>
                            </div>
                            <div class="card-body text-center p-3">
                                <img src="{{ $student->photo_url }}" width="80" height="80" class="img-circle mb-2 border" alt="Foto Profil">
                                <h5 class="mb-1">{{ $student->name }}</h5>
                                <small class="d-block text-muted mb-1">NIM: {{ $student->nim }}</small>
                                <small class="d-block">{{ $student->faculty->name }} - Semester {{ $student->current_semester }}</small>
                            </div>
                        </div>

                        <!-- Informasi Pembayaran Bank -->
                        <div class="card card-outline card-success mt-3">
                            <div class="card-header py-2">
                                <h6 class="card-title mb-0 font-weight-bold">Pembayaran Melalui Bank</h6>
                            </div>
                            <div class="card-body p-2">
                                @if ($banks->count())
                                    <ol class="pl-3 mb-0" style="font-size: 0.875rem;">
                                        @foreach ($banks as $bank)
                                            <li class="d-flex justify-content-between border-bottom py-1">
                                                <span><strong>{{ $bank->bank_name }}</strong></span>
                                                <span class="text-monospace">{{ $bank->account_number }}</span>
                                            </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <p class="text-muted mb-0">Belum ada data rekening bank.</p>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="card card-outline card-success mt-3">
                            <div class="card-header py-2">
                                <h6 class="card-title mb-0 font-weight-bold">Pembayaran Melalui Bank</h6>
                            </div>
                            <div class="card-body p-2">
                                @forelse ($banks as $bank)
                                    <div class="border rounded p-2 mb-2 small">
                                        <div class="font-weight-bold">{{ $bank->bank_name }}</div>
                                        <div>A.n: {{ $bank->account_name }}</div>
                                        <div>No. Rek: <span class="text-monospace">{{ $bank->account_number }}</span></div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">Belum ada data rekening bank.</p>
                                @endforelse
                            </div>
                        </div> --}}
                    </div>


                </div>
            </div>
        </section>
    </div>
@endsection
