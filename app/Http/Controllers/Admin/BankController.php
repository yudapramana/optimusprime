<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BankController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $data = Bank::select('id', 'bank_name', 'account_name', 'account_number')
                        ->latest()
                        ->get();

            return response()->json(['data' => $data]);
        }

        return view('admin.banks.index', [
            'titlePages' => 'Data Bank Universitas',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => [
                'required', 'string', 'max:50',
                Rule::unique('banks', 'account_number')
            ],
        ], [
            'bank_name.required' => 'Nama bank wajib diisi.',
            'account_name.required' => 'Nama pemilik rekening wajib diisi.',
            'account_number.required' => 'Nomor rekening wajib diisi.',
            'account_number.unique' => 'Nomor rekening ini sudah terdaftar.',
        ]);

        Bank::create($request->only(['bank_name', 'account_name', 'account_number']));

        return response()->json(['message' => 'Data bank berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('admin.banks._modal_edit', compact('bank'));
    }

    public function update(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);

        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => [
                'required', 'string', 'max:50',
                Rule::unique('banks', 'account_number')->ignore($bank->id)
            ],
        ], [
            'bank_name.required' => 'Nama bank wajib diisi.',
            'account_name.required' => 'Nama pemilik rekening wajib diisi.',
            'account_number.required' => 'Nomor rekening wajib diisi.',
            'account_number.unique' => 'Nomor rekening ini sudah terdaftar.',
        ]);

        $bank->update($request->only(['bank_name', 'account_name', 'account_number']));

        return response()->json(['message' => 'Data bank berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return response()->json(['message' => 'Data bank berhasil dihapus.']);
    }
}
