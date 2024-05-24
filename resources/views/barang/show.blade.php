@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($barang)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>ID:</strong> {{ $barang->barang_id }}</li>
                            <li class="list-group-item"><strong>Barang Kode:</strong> {{ $barang->barang_kode }}</li>
                            <li class="list-group-item"><strong>Kategori:</strong> {{ $barang->kategori->kategori_nama }}</li>
                            <li class="list-group-item"><strong>Barang Nama:</strong> {{ $barang->barang_nama }}</li>
                            <li class="list-group-item"><strong>Harga Beli:</strong> {{ $barang->harga_beli }}</li>
                            <li class="list-group-item"><strong>Harga Jual:</strong> {{ $barang->harga_jual }}</li>
                            <li class="list-group-item"><strong>Created At:</strong> {{ $barang->created_at }}</li>
                            <li class="list-group-item"><strong>Updated At:</strong> {{ $barang->updated_at }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ $barang->image }}" alt="Gambar Barang" width="45%">
                    </div>
                </div>
            @endempty
            <a href="{{ url('barang') }}" class="btn btn-sm btn-danger mt-2">Kembali</a>
        </div>
    </div>
@endsection
