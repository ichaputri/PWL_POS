@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @empty($barang)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/barang/' . $barang->barang_id) }}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->

                    <div class="form-group row">
                        <label for="barang_kode">Kode Barang</label>
                        <input type="text" class="form-control @error('barang_kode') is-invalid @enderror" id="barang_kode"
                            name="barang_kode" value="{{ old('barang_kode', $barang->barang_kode) }}" required>
                        @error('barang_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="barang_nama">Nama Barang</label>
                        <input type="text" class="form-control @error('barang_nama') is-invalid @enderror" id="barang_nama"
                            name="barang_nama" value="{{ old('barang_nama', $barang->barang_nama) }}" required>
                        @error('barang_nama')
                            <small class="alert alert-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli"
                            name="harga_beli" value="{{ old('harga_beli', $barang->harga_beli) }}" required>
                        @error('harga_beli')
                            <small class="alert alert-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual"
                            name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                        @error('harga_jual')
                            <small class="alert alert-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id"
                            name="kategori_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->kategori_id }}" {{ $item->kategori_id == old('kategori_id', $barang->kategori_id) ? 'selected' : '' }}>
                                    {{ $item->kategori_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <small class="alert alert-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 col-form-label">Upload Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            @if ($barang->image)
                                <img src="{{ asset($barang->image) }}" alt="Current Image" class="img-thumbnail mt-2" width="30%">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button> <a
                                class="btn btn-sm btn-danger ml-1" href="{{ url('barang') }}">Kembali</a>
                        </div>
                    </div>

                </form>
            @endempty
        </div>
    </div>
@endsection
