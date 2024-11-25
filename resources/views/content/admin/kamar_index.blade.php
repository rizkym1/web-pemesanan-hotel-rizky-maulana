@extends('mylayout', ['title' => 'Data Kamar'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Data Kamar</h3>
            <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary">Tambah Data</a>
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
                            <td class="d-flex align-items-center">
                                <a href="/admin/kamar/{{ $item->id }}/edit" class="btn btn-warning btn-sm me-2">Edit</a>
                                <form action="/admin/kamar/{{ $item->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Anda Yakin?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $kamar->Links() !!}
        </div>
    </div>
@endsection
