@extends('student.layouts.layout')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h5>Upload Bukti Pembayaran - Termin {{ $payment->installment_number }}</h5>
            </div>
            <div class="card-body">

                {{-- Informasi Pembayaran --}}
                <div class="border rounded p-3 mb-4 bg-light small">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col mb-2"><strong>Tahun Ajaran:</strong><br> {{ $payment->academic_semester }}</div>
                        <div class="col mb-2"><strong>Termin Ke:</strong><br> {{ $payment->installment_number }}</div>
                        <div class="col mb-2"><strong>Persentase:</strong><br> {{ $payment->percentage }}%</div>
                        <div class="col mb-2"><strong>Nominal Pembayaran:</strong><br> Rp {{ number_format($payment->amount_paid ?? 0, 0, ',', '.') }}</div>
                        <div class="col mb-2"><strong>Jatuh Tempo:</strong><br> {{ \Carbon\Carbon::parse($payment->due_date)->translatedFormat('d M Y') }}</div>
                        <div class="col mb-2">
                            <strong>Status:</strong><br>
                            @php
                                $badgeClass = match ($payment->status) {
                                    'not_uploaded' => 'secondary',
                                    'pending' => 'warning',
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    default => 'dark',
                                };
                            @endphp
                            <span class="badge badge-{{ $badgeClass }}">{{ ucfirst(str_replace('_', ' ', $payment->status)) }}</span>
                        </div>
                        @if ($payment->notes)
                            <div class="col mb-2">
                                <strong>Catatan:</strong><br>
                                <em>{{ $payment->notes }}</em>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Upload Form --}}
                <form action="{{ route('student.payments.update', $payment->id) }}" method="POST">
                    @csrf

                    {{-- Transfer ke bank --}}
                    <div class="form-group mb-3">
                        <label for="bank_id">Transfer ke Bank</label>
                        <select name="bank_id" id="bank_id" class="form-control" required>
                            <option value="">-- Pilih Bank Tujuan --</option>
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}" {{ old('bank_id', $payment->bank_id) == $bank->id ? 'selected' : '' }}>
                                    {{ $bank->bank_name }} a.n {{ $bank->account_name }} ({{ $bank->account_number }})
                                </option>
                            @endforeach
                        </select>
                        @error('bank_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Upload Cloudinary --}}
                    <div class="form-group mb-3">
                        <label>Upload Bukti Pembayaran (via Cloudinary)</label><br>
                        <button type="button" id="upload_widget" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-cloud-upload-alt"></i> Pilih File Gambar
                        </button>

                        {{-- Preview file --}}
                        <div id="preview_area" class="mt-3"></div>

                        {{-- Hidden field to store Cloudinary URL --}}
                        <input type="hidden" name="eviden_url" id="eviden_url" required>
                        @error('eviden_url')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tanggal Transfer --}}
                    <div class="form-group mb-3">
                        <label for="transfer_date">Tanggal Transfer</label>
                        <input type="date" name="transfer_date" id="transfer_date" class="form-control" value="{{ old('transfer_date', $payment->transfer_date ? $payment->transfer_date->format('Y-m-d') : '') }}" required>
                        @error('transfer_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Simpan Bukti Bayar
                    </button>
                </form>

            </div>
        </div>
    </div>


    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script type="text/javascript">
        const myWidget = cloudinary.createUploadWidget({
            cloudName: 'dmynbnqtt', // Ganti dengan cloud name kamu
            uploadPreset: 'angkotapp', // Ganti dengan preset kamu
            sources: ['local', 'camera'],
            multiple: false,
            cropping: false,
            folder: 'bukti_pembayaran',
            maxFileSize: 2000000, // 2MB
            clientAllowedFormats: ["jpg", "png", "jpeg"]
        }, (error, result) => {
            if (!error && result && result.event === "success") {
                const imageUrl = result.info.secure_url;
                document.getElementById("eviden_url").value = imageUrl;
                document.getElementById("preview_area").innerHTML = `
                    <img src="${imageUrl}" class="img-thumbnail" width="200" alt="Preview Bukti">
                `;
            }
        });

        document.getElementById("upload_widget").addEventListener("click", function() {
            myWidget.open();
        }, false);
    </script>
@endsection
