<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RumahSakit;

class PasienController extends Controller
{
    public function index()
    {
        $rumahSakits = RumahSakit::all();
        return view('pasien.data', compact('rumahSakits'));
    }

    public function data(Request $request)
    {
        $query = Pasien::with('rumah_sakit');

        if ($request->filled('search')) {
            $query->where('nama_pasien', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('rumah_sakit_id')) {
            $query->where('rumah_sakit_id', $request->rumah_sakit_id);
        }

        $pasien = $query->orderBy('id', 'desc')->get();

        return response()->json($pasien);
    }

    public function form($id = null)
    {
        $pasien = $id ? Pasien::findOrFail($id) : null;
        $rumahSakits = RumahSakit::all();
        return view('pasien.form', compact('pasien', 'rumahSakits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->all());

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil dihapus!'
        ]);
    }
}
