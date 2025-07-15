<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $payments = Payment::with(['installment.user.student.faculty', 'installment.scheme', 'bank'])
                ->where('status', 'approved')
                ->get();

            $totalAmount = $payments->sum('amount_paid');
            $totalTransfer = $payments->count();

            return DataTables::of($payments)
                ->addIndexColumn()
                ->with([
                    'summary' => [
                        'total_transfer' => $totalTransfer,
                        'total_amount' => $totalAmount
                    ]
                ])
                ->toJson();
        }

        return view('admin.payments.index', [
            'titlePages' => 'Laporan Pembayaran'
        ]);
    }

}
