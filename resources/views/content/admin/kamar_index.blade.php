@extends('mylayout', ['title' => 'Data Kamar'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Data Kamar</h3>
            <a href="/admin/kamar/create" class="btn btn-primary">Tambah Data</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tipe Kamar</th>
                        <th>Fasilitas</th>
                        <th>Keterangan</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kamar as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tipe_kamar }}</td>
                            <td>{{ $item->fasilitas }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->stok_kamar }}</td>
                            <td>{{ $item->harga }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $kamar->Links() !!}
        </div>
    </div>
@endsection
