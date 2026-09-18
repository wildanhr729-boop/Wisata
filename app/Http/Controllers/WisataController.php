<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        // Mengambil data wisata beserta ulasannya
        $wisata = Wisata::with('ulasans')->get();
        return view('wisata.index', compact('wisata'));
    }

    public function tambah()
    {
        return view('wisata.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required',
            'kategori'    => 'required',
            'deskripsi'   => 'required',
            'alamat'      => 'required',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('wisata', $namaFoto, 'public');
        }

        Wisata::create([
            'nama_wisata' => $request->nama_wisata,
            'kategori'    => $request->kategori,
            'deskripsi'   => $request->deskripsi,
            'alamat'      => $request->alamat,
            'foto'        => $namaFoto,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'rating'      => $request->rating,
            'ulasan'      => $request->ulasan,
        ]);

        return redirect('/wisata')
            ->with('success', 'Data wisata berhasil ditambahkan!');
    }

    // Method baru untuk menyimpan ulasan publik
    public function storeUlasan(Request $request)
    {
        $request->validate([
            'wisata_id'       => 'required|exists:wisata,id',
            'nama_pengunjung' => 'required|string|max:100',
            'rating'          => 'required|integer|min:1|max:5',
            'komentar'        => 'required|string',
        ]);

        Ulasan::create([
            'wisata_id'       => $request->wisata_id,
            'nama_pengunjung' => $request->nama_pengunjung,
            'rating'          => $request->rating,
            'komentar'        => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}