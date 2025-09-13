<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RumahSakit;

class RumahSakitController extends Controller
{
    public function index()
    {
        return view('rumahSakit.data');
    }

    public function getData(Request $request)
    {
        $search = $request->input('search');
        $query = RumahSakit::query();

        if ($search) {
            $query->where('nama_rumah_sakit', 'like', "%$search%")
                ->orWhere('alamat', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('telepon', 'like', "%$search%");
        }

        $data = $query->orderBy('id', 'desc')->get();

        return response()->json($data);
    }

    public function form()
    {
        return view('rumahSakit.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:rumah_sakits,email',
            'telepon' => 'required',
        ], [
            'email.unique' => 'Email sudah terdaftar, tidak boleh duplikat.'
        ]);

        RumahSakit::create($request->all());

        return redirect('/rumah-sakit')->with('success', 'Data rumah sakit berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $rumahSakit = RumahSakit::findOrFail($id);
        return view('rumahsakit.form', compact('rumahSakit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
        ]);

        $rumahSakit = RumahSakit::findOrFail($id);
        $rumahSakit->update($request->all());

        return redirect('/rumah-sakit')->with('success', 'Data rumah sakit berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rumahSakit = RumahSakit::findOrFail($id);
        $rumahSakit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data rumah sakit berhasil dihapus!'
        ]);
    }
}
