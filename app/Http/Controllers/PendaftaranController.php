<?php

namespace App\Http\Controllers;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\KurasiProduk; // Pastikan model ini sudah dibuat

class PendaftaranController extends Controller
{
    // Tampilkan halaman formulir pendaftaran
    public function showForm()
    {
        return view('pendaftaran'); // resources/views/pendaftaran.blade.php
    }

    // Proses kiriman formulir
    public function submitForm(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nama_usaha'   => 'required|string|max:255',
            'email'        => 'required|email',
            'telepon'      => 'required|string|max:20',
            'alamat'       => 'required|string',

            'nama_produk'  => 'required|string|max:255',
            'kategori'     => 'required|string',
            'deskripsi'    => 'required|string',
            'harga'        => 'required|numeric|min:0',
            'foto'         => 'required',
            'foto.*'       => 'image|mimes:jpeg,png,jpg|max:2048', // max 2MB per file
        ]);

        // Simpan foto ke penyimpanan
        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $path = $foto->store('produk_foto', 'public');
                $fotoPaths[] = $path;
            }
        }

        // Simpan data ke database
       Pendaftaran::create([
            'nama_pemilik' => $validated['nama_pemilik'],
            'nama_usaha'   => $validated['nama_usaha'],
            'email'        => $validated['email'],
            'telepon'      => $validated['telepon'],
            'alamat'       => $validated['alamat'],

            'nama_produk'  => $validated['nama_produk'],
            'kategori'     => $validated['kategori'],
            'deskripsi'    => $validated['deskripsi'],
            'harga'        => $validated['harga'],
            'foto'         => json_encode($fotoPaths),
        ]);
        return redirect()->back()->with('success', 'Pendaftaran kurasi berhasil dikirim!');
    }
}
