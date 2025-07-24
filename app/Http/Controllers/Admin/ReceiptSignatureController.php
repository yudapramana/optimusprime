<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReceiptSignature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReceiptSignatureController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ReceiptSignature::latest()->get();
            return response()->json(['data' => $data]);
        }

        return view('admin.receipt_signatures.index', [
            'titlePages' => 'Tanda Tangan Kwitansi',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'nullable|string|max:100',
            'signature_url' => 'required|url',
            'is_active' => 'nullable|boolean',
        ]);

        // Nonaktifkan semua tanda tangan aktif jika is_active dicentang
        if ($request->has('is_active')) {
            ReceiptSignature::where('is_active', true)->update(['is_active' => false]);
        }

        ReceiptSignature::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'signature_url' => $validated['signature_url'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return response()->json(['message' => 'Tanda tangan berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $signature = ReceiptSignature::findOrFail($id);
        return view('admin.receipt_signatures._modal_edit', compact('signature'));
    }

    public function update(Request $request, $id)
    {
        $signature = ReceiptSignature::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'nullable|string|max:100',
            'signature_url' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        $isCurrentlyActive = $signature->is_active;
        $wantsToDeactivate = !$request->boolean('is_active');

        // ❗️Cek apakah user mencoba menonaktifkan satu-satunya TTD aktif
        if ($isCurrentlyActive && $wantsToDeactivate) {
            $otherActiveCount = ReceiptSignature::where('is_active', true)->where('id', '!=', $id)->count();

            if ($otherActiveCount === 0) {
                return response()->json([
                    'errors' => [
                        'is_active' => ['Setidaknya satu tanda tangan harus tetap aktif.']
                    ]
                ], 422);
            }
        }

        $data = [
            'name' => $request->name,
            'position' => $request->position,
            'is_active' => $request->boolean('is_active'),
        ];

        // Jika user upload signature baru via Cloudinary
        if ($request->filled('signature_url')) {
            $data['signature_url'] = $request->input('signature_url');
        }

        // Jika akan diaktifkan, nonaktifkan yang lain
        if ($request->boolean('is_active')) {
            ReceiptSignature::where('is_active', true)->where('id', '!=', $id)->update(['is_active' => false]);
        }

        $signature->update($data);

        return response()->json(['message' => 'Tanda tangan berhasil diperbarui']);
    }


    public function destroy($id)
    {
        $signature = ReceiptSignature::findOrFail($id);
        
        // Hapus file dari storage jika ada
        if ($signature->signature_url && str_contains($signature->signature_url, 'storage/signatures')) {
            $filePath = Str::after($signature->signature_url, asset('storage/') . '/');
            Storage::disk('public')->delete($filePath);
        }

        $signature->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
