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
            text-align: right;
        }

        .signature p {
            margin-bottom: 60px;
        }

        .title {
            font-weight: bold;
            text-transform: uppercase;
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

        <div class="signature">
            <p>Petugas Administrasi</p>
            <strong>(_________________)</strong>
        </div>
    </div>
</body>

</html>
