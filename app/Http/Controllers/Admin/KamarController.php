<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        // Membuat objek baru dari model Kamar
        $kamar = new \App\Models\Kamar();

        // Mengisi atribut-atribut pada objek $kamar dengan data yang diterima dari request
        $kamar->fill($requestData);

        // Menyimpan nama file foto yang diupload ke dalam atribut 'foto' pada objek $kamar
        // Nama file foto diambil dari file yang diupload dan ditambahkan dengan path 'uploads'
        $kamar->foto = 'uploads' . $request->file('foto')->getClientOriginalName();

        // Menyimpan file foto yang diupload ke dalam folder 'uploads' di storage publik
        // Menggunakan metode storeAs untuk menentukan nama file dan lokasi penyimpanan
        $request->file('foto')->storeAs('uploads', $request->file('foto')->getClientOriginalName(), 'public');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
