<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function show(Payment $payment)
    {
        // $this->authorize('view', $payment); // Optional: jika pakai policy

        return view('student.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $payment->load('installment');
        $banks = Bank::all();
        // $this->authorize('update', $payment); // Optional: jika pakai policy

        return view('student.payments.edit', [
            'payment' => $payment,
            'banks' => $banks,
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'eviden_url' => 'required|url',
            'transfer_date' => 'required|date'
        ]);

        $payment->update([
            'bank_id' => $request->bank_id,
            'eviden_url' => $request->eviden_url,
            'transfer_date' => $request->transfer_date,
            'upload_date' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('student.home')->with('success', 'Bukti pembayaran berhasil diupload dan menunggu verifikasi.');
    }

    public function generateReceipt($id)
    {
        $payment = \App\Models\Payment::with(['installment.user.student', 'bank'])->findOrFail($id);

        return view('admin.payments.receipt', compact('payment'));
    }

}
