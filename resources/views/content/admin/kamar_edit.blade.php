@extends('mylayout', ['title' => 'Tambah Data Pasien'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Edit kamar <b>{{ $kamar->tipe_kamar }}</b></h3>
            <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group mb-3">
                    <label for="foto">Foto Kamar</label>
                    <input id="foto" class="form-control @error('foto') is-invalid @enderror" type="file"
                        name="foto">
                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                    <img src="{{ asset('storage/' . $kamar->foto) }}" alt="Foto Kamar" class="img-thumbnail mt-2"
                        style="width: 100px">

                </div>
                <div class="form-group mb-3">
                    <label for="tipe_kamar">Tipe Kamar</label>
                    <input id="tipe_kamar" class="form-control @error('tipe_kamar') is-invalid @enderror" type="text"
                        name="tipe_kamar" value="{{ old('tipe_kamar') ?? $kamar->tipe_kamar }}">
                    <span class="text-danger">{{ $errors->first('tipe_kamar') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="fasilitas">Fasilitas</label>
                    <input id="fasilitas" class="form-control @error('tipe_kamar') is-invalid @enderror" type="text"
                        name="fasilitas" value="{{ old('fasilitas') ?? $kamar->fasilitas }}">
                    <span class="text-danger">{{ $errors->first('fasilitas') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan">Keterangan</label>
                    <input id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" type="text"
                        name="keterangan" value="{{ old('keterangan') ?? $kamar->keterangan }}">
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="stok_kamar">Stok_kamar</label>
                    <input id="stok_kamar" class="form-control @error('stok_kamar') is-invalid @enderror" type="text"
                        name="stok_kamar" value="{{ old('stok_kamar') ?? $kamar->stok_kamar }}">
                    <span class="text-danger">{{ $errors->first('stok_kamar') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">harga</label>
                    <input id="harga" class="form-control @error('harga') is-invalid @enderror" type="text"
                        name="harga" value="{{ old('harga') ?? $kamar->harga }}">
                    <span class="text-danger">{{ $errors->first('harga') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="kode_kamar">kode_kamar</label>
                    <input id="kode_kamar" class="form-control @error('kode_kamar') is-invalid @enderror" type="text"
                        name="kode_kamar" value="{{ old('kode_kamar') ?? $kamar->kode_kamar }}">
                    <span class="text-danger">{{ $errors->first('kode_kamar') }}</span>
                </div>
                <button type="submit" class="btn btn-primary">UPDATE</button>
            </form>
        </div>
    </div>
@endsection
