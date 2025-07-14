<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThreeInstallmentCriteria;
use Illuminate\Http\Request;

class ThreeInstallmentCriteriaController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(ThreeInstallmentCriteria::all())->toJson();
        }

        return view('admin.three_installment_criterias.index', [
            'titlePages' => 'Skema Cicilan',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:start_date,mid_date,end_date',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        // Ambil persentase total dari data yang sudah ada, kecuali tipe yang sama (jika duplikat)
        $existingTotal = \App\Models\ThreeInstallmentCriteria::where('type', '!=', $request->type)->sum('percentage');

        // Jika data dengan type yang sama sudah ada, tolak (duplikat)
        if (\App\Models\ThreeInstallmentCriteria::where('type', $request->type)->exists()) {
            return response()->json([
                'success' => false,
                'errors' => ['type' => ['Tipe termin ini sudah ada.']]
            ], 422);
        }

        // Cek apakah total akan melebihi 100 jika ditambahkan
        $totalAfterInsert = $existingTotal + $request->percentage;
        if ($totalAfterInsert > 100) {
            return response()->json([
                'success' => false,
                'errors' => ['percentage' => ['Total persentase melebihi 100%.']]
            ], 422);
        }

        // Jika belum lengkap 3 termin dan total sudah 100, tolak
        $currentCount = \App\Models\ThreeInstallmentCriteria::count();
        if ($currentCount === 2 && $totalAfterInsert < 100) {
            return response()->json([
                'success' => false,
                'errors' => ['percentage' => ['Total persentase harus tepat 100% setelah 3 termin.']]
            ], 422);
        }

        \App\Models\ThreeInstallmentCriteria::create($request->all());

        return response()->json(['success' => true]);
    }


    public function edit(ThreeInstallmentCriteria $threeInstallmentCriteria)
    {
        return view('admin.three_installment_criterias._modal_edit', compact('threeInstallmentCriteria'));
    }

    public function update(Request $request, ThreeInstallmentCriteria $threeInstallmentCriteria)
    {
        $request->validate([
            'type' => 'required|in:start_date,mid_date,end_date',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        // 1. Cek apakah type yang diinput sudah digunakan di record lain
        $isDuplicateType = \App\Models\ThreeInstallmentCriteria::where('type', $request->type)
            ->where('id', '!=', $threeInstallmentCriteria->id)
            ->exists();

        if ($isDuplicateType) {
            return response()->json([
                'success' => false,
                'errors' => ['type' => ['Tipe termin ini sudah digunakan.']]
            ], 422);
        }

        // 2. Hitung total percentage dari semua record KECUALI record yang sedang diupdate
        $totalOtherPercentage = \App\Models\ThreeInstallmentCriteria::where('id', '!=', $threeInstallmentCriteria->id)
            ->sum('percentage');

        $totalAfterUpdate = $totalOtherPercentage + $request->percentage;

        if ($totalAfterUpdate > 100) {
            return response()->json([
                'success' => false,
                'errors' => ['percentage' => ['Total persentase melebihi 100%.']]
            ], 422);
        }

        // 3. Jika setelah update data menjadi 3 termin, total harus pas 100
        $totalTerminSetelahUpdate = \App\Models\ThreeInstallmentCriteria::where('id', '!=', $threeInstallmentCriteria->id)
            ->count() + 1;

        if ($totalTerminSetelahUpdate === 3 && $totalAfterUpdate < 100) {
            return response()->json([
                'success' => false,
                'errors' => ['percentage' => ['Total persentase harus tepat 100% setelah 3 termin.']]
            ], 422);
        }

        // Jika semua validasi lolos, update
        $threeInstallmentCriteria->update($request->only('type', 'percentage'));

        return response()->json(['success' => true]);
    }

    public function destroy(ThreeInstallmentCriteria $threeInstallmentCriteria)
    {
        $threeInstallmentCriteria->delete();

        return response()->json(['success' => true]);
    }
}
