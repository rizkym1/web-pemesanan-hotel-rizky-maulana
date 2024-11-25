<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kamar']  = \App\Models\Kamar::latest()->paginate(5);
        return view('content.admin.kamar_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.admin.kamar_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tipe_kamar' => 'required|min:5',
            'fasilitas' => 'required',
            'keterangan' => 'required',
            'stok_kamar' => 'required|numeric',
            'harga' => 'required|numeric',
            'kode_kamar' => 'required|unique:kamars',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:10000',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('uploads/kamar', 'public'); // Menyimpan ke storage/app/public/uploads/kamar
            $requestData['foto'] = $path; // Menyimpan path foto ke array $requestData
        }

        // Membuat objek baru dari model Kamar
        $kamar = new \App\Models\Kamar();

        // Mengisi atribut-atribut pada objek $kamar dengan data yang diterima dari request
        $kamar->fill($requestData);

        // Menyimpan objek $kamar ke dalam database
        $kamar->save();

        flash('Data Berhasil Ditambahkan')->success();
        return redirect()->route('admin.kamar.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['kamar'] = \App\Models\Kamar::findOrFail($id);
        return view('content.admin.kamar_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'tipe_kamar' => 'required|min:5',
            'fasilitas' => 'required',
            'keterangan' => 'required',
            'stok_kamar' => 'required|numeric',
            'harga' => 'required|numeric',
            'kode_kamar' => 'required|unique:kamars,kode_kamar,' . $id, // Mengabaikan kode_kamar yang sama pada ID saat ini
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
        ]);

        // Ambil data kamar berdasarkan ID
        $kamar = \App\Models\Kamar::findOrFail($id);

        // Jika ada file baru yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus file lama jika ada
            if ($kamar->foto && Storage::disk('public')->exists($kamar->foto)) {
                Storage::disk('public')->delete($kamar->foto);
            }

            // Simpan file baru
            $file = $request->file('foto');
            $path = $file->store('uploads/kamar', 'public'); // Menyimpan ke storage/app/public/uploads/kamar
            $requestData['foto'] = $path; // Menyimpan path foto ke array $requestData
        }

        // Update data kamar dengan data baru
        $kamar->update($requestData);

        flash('Data Berhasil Diperbarui')->success();
        return redirect()->route('admin.kamar.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan data kamar berdasarkan ID
        $kamar = \App\Models\Kamar::findOrFail($id);

        // Cek apakah file foto ada di folder penyimpanan
        if ($kamar->foto && Storage::disk('public')->exists($kamar->foto)) {
            // Hapus file foto dari penyimpanan
            Storage::disk('public')->delete($kamar->foto);
        }

        // Hapus data dari database
        $kamar->delete();

        // Berikan pesan sukses
        flash('Data berhasil dihapus')->success();

        // Redirect ke halaman sebelumnya
        return back();
    }
}
