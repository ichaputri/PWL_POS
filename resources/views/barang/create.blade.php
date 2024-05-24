@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/barang') }}" class="form-horizontal" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="barang_kode">Kode Barang</label>
                    <input type="text" name="barang_kode" id="barang_kode"
                        class="form-control @error('barang_kode') is-invalid @enderror" value="{{ old('barang_kode') }}"
                        placeholder="Masukkan kode barang" required>
                    @error('barang_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="barang_nama">Nama Barang</label>
                    <input type="text" name="barang_nama" id="barang_nama"
                        class="form-control @error('barang_nama') is-invalid @enderror" value="{{ old('barang_nama') }}"
                        placeholder="Masukkan nama barang" required>
                    @error('barang_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="text" name="harga_beli" id="harga_beli"
                        class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli') }}"
                        placeholder="Masukkan harga beli" required>
                    @error('harga_beli')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" name="harga_jual" id="harga_jual"
                        class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}"
                        placeholder="Masukkan harga jual" required>
                    @error('harga_jual')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id"
                        class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Barang</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-danger ml-1" href="{{ url('barang') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
