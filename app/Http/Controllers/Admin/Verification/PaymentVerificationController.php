<?php

namespace App\Http\Controllers\Admin\Verification;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PaymentVerificationController extends Controller
{
    // app/Http/Controllers/Admin/PaymentVerificationController.php
    public function index()
    {
        if (request()->ajax()) {
            $payments = Payment::with(['installment.user.student.faculty', 'installment.scheme', 'bank'])
                ->where('status', 'pending')
                ->get();

            return datatables()->of($payments)->toJson();
        }

        return view('admin.payments.verification.index', [
            'titlePages' => 'Verifikasi Pembayaran',
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);
        $payment->update([
            'status' => $request->status,
        ]);
        return response()->json(['message' => 'Status pembayaran diperbarui.']);
    }

    public function verify(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => ['required', Rule::in(['approved', 'rejected'])]
        ]);

        $payment->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Status pembayaran berhasil diperbarui.',
            'status' => $payment->status
        ]);
    }


}
