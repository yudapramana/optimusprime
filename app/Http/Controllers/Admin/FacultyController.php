<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $faculties = Faculty::orderBy('name')->get();
            return response()->json(['data' => $faculties]);
        }

        return view('admin.faculties.index', [
            'titlePages' => 'Fakultas'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10|unique:faculties,code',
            'tuition_fee' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        Faculty::create($request->all());

        return response()->json(['message' => 'Fakultas berhasil ditambahkan.']);
    }

    public function edit(Faculty $faculty)
    {
        return view('admin.faculties._modal_edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10|unique:faculties,code,' . $faculty->id,
            'tuition_fee' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $faculty->update($request->all());

        return response()->json(['message' => 'Fakultas berhasil diperbarui.']);
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return response()->json(['message' => 'Fakultas berhasil dihapus.']);
    }
}
