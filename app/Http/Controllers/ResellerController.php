<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    public function index()
    {
        $resellers = \App\Models\Reseller::orderByRaw("
                CASE 
                    WHEN status = 'Aktif' THEN 1
                    ELSE 2
                END
            ")
            ->orderBy('nama_reseller', 'asc')
            ->get();

        return view('reseller.index', compact('resellers'));
    }

    public function create()
    {
        return view('reseller.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_reseller' => 'required',
            'jenis_toko' => 'required',
            'wilayah' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|numeric'
        ]);

        Reseller::create([
            'nama_reseller' => $request->nama_reseller,
            'jenis_toko' => $request->jenis_toko,
            'wilayah' => $request->wilayah,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'status' => 'Aktif'
        ]);

        return redirect('/reseller')->with('success', 'Reseller berhasil ditambahkan');
    }

    public function toggleStatus($id)
    {
        $reseller = Reseller::findOrFail($id);
        $reseller->status = $reseller->status === 'Aktif'
            ? 'Tidak Aktif'
            : 'Aktif';
        $reseller->save();
        return redirect()->back();
    }

        public function destroy($id)
    {
        $reseller = Reseller::findOrFail($id);
        $reseller->delete();
        return redirect()
            ->route('reseller.index')
            ->with('success', 'Reseller berhasil dihapus');
    }
}