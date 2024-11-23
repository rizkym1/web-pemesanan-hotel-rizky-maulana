@extends('mylayout', ['title' => 'Tambah Data Pasien'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Form Kamar</h3>
            <form action="/admin/kamar" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="foto">Foto Kamar</label>
                    <input id="foto" class="form-control @error('foto') is-invalid @enderror" type="file"
                        name="foto">
                    <span class="text-danger">{{ $errors->first('foto') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="tipe_kamar">Tipe Kamar</label>
                    <input id="tipe_kamar" class="form-control @error('tipe_kamar') is-invalid @enderror" type="text"
                        name="tipe_kamar" value="{{ old('tipe_kamar') }}">
                    <span class="text-danger">{{ $errors->first('tipe_kamar') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="fasilitas">Fasilitas</label>
                    <input id="fasilitas" class="form-control @error('tipe_kamar') is-invalid @enderror" type="text"
                        name="fasilitas" value="{{ old('fasilitas') }}">
                    <span class="text-danger">{{ $errors->first('fasilitas') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="keterangan">Keterangan</label>
                    <input id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" type="text"
                        name="keterangan" value="{{ old('keterangan') }}">
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="stok_kamar">Stok_kamar</label>
                    <input id="stok_kamar" class="form-control @error('stok_kamar') is-invalid @enderror" type="text"
                        name="stok_kamar" value="{{ old('stok_kamar') }}">
                    <span class="text-danger">{{ $errors->first('stok_kamar') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="harga">harga</label>
                    <input id="harga" class="form-control @error('harga') is-invalid @enderror" type="text"
                        name="harga" value="{{ old('harga') }}">
                    <span class="text-danger">{{ $errors->first('harga') }}</span>
                </div>
                <div class="form-group mb-3">
                    <label for="kode_kamar">kode_kamar</label>
                    <input id="kode_kamar" class="form-control @error('kode_kamar') is-invalid @enderror" type="text"
                        name="kode_kamar" value="{{ old('kode_kamar') }}">
                    <span class="text-danger">{{ $errors->first('kode_kamar') }}</span>
                </div>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </form>
        </div>
    </div>
@endsection
