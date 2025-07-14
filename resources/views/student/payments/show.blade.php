@extends('student.layouts.layout')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h5>Detail Pembayaran - Termin {{ $payment->installment_number }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Persentase:</strong> {{ $payment->percentage }}%</p>
                <p><strong>Jumlah Dibayar:</strong> Rp {{ number_format($payment->amount_paid ?? 0, 0, ',', '.') }}</p>
                <p><strong>Jatuh Tempo:</strong> {{ \Carbon\Carbon::parse($payment->due_date)->translatedFormat('d M Y') }}</p>
                <p><strong>Status:</strong> <span class="badge badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></p>
                @if ($payment->notes)
                    <p><strong>Catatan:</strong> {{ $payment->notes }}</p>
                @endif
                @if ($payment->eviden_url)
                    <p><strong>Bukti Pembayaran:</strong> <br>
                        <img src="{{ $payment->eviden_url }}" alt="Bukti" width="300" class="img-thumbnail mt-2">
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
