@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Level</h3>
            </div>
            <form method="post" action="/level/tambah_simpan">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="level_kode">Kode Level</label>
                        <input type="text" class="form-control @error('level_kode') is-invalid @enderror" id="level_kode"
                            name="level_kode" placeholder="Masukkan Kode Level">

                        @error('level_kode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="level_nama">Nama Level</label>
                        <input type="text" class="form-control @error('level_nama') is-invalid @enderror" id="level_nama"
                            name="level_nama" placeholder="Masukkan Nama Level">
                        @error('level_nama')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-right">
                        <a href="/level" class="btn btn-danger">Kembali</a>
                        <input type="submit" class="btn btn-info" value="Simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
</body>

</html>
