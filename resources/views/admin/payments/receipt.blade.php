<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .kwitansi-box {
            border: 1px solid #000;
            padding: 20px;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .signature {
            margin-top: 40px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
            /* posisikan di kanan halaman */
        }

        .signature-inner {
            text-align: center;
            /* isi signature rata tengah terhadap dirinya */
        }

        .signature-inner p {
            margin-bottom: 0;
        }

        .signature-inner img {
            width: 150px;
            height: auto;
            /* margin-top: -20px; */
            /* iris ke atas */
            /* margin-bottom: -10px; */
            /* iris ke bawah */
            opacity: 0.8;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Kwitansi Pembayaran</h2>
        <p><em>No. Referensi: {{ $payment->reference_id }}</em></p>
    </div>

    <div class="kwitansi-box">
        <table class="info-table" width="100%">
            <tr>
                <td width="30%">Nama Mahasiswa</td>
                <td>: {{ $payment->installment->user->student->name }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>: {{ $payment->installment->user->student->nim }}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>: {{ $payment->installment->user->student->faculty->name }}</td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>: {{ $payment->academic_semester }}</td>
            </tr>
            <tr>
                <td>Termin</td>
                <td>: Termin {{ $payment->installment_number }} ({{ $payment->percentage }}%)</td>
            </tr>
            <tr>
                <td>Jumlah Dibayarkan</td>
                <td>: <strong>Rp {{ number_format($payment->amount_paid, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td>Tanggal Upload</td>
                <td>: {{ \Carbon\Carbon::parse($payment->upload_date)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Bank Tujuan</td>
                <td>: {{ $payment->bank->bank_name ?? '-' }} ({{ $payment->bank->account_number ?? '-' }})</td>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td>: {{ strtoupper($payment->status) }}</td>
            </tr>
        </table>

        {{-- <div class="signature">
            <div class="signature-inner">
                <p>{{ $position }}</p>
                <img src="{{ $ttd_url }}" alt="TTD">
                <div class="signature-name">{{ $nama_terang }}</div>
            </div>
        </div> --}}
    </div>
</body>

</html>
