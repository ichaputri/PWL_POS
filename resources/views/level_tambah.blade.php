@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Level</h3>
            </div>
                <form method="post" action="/level/tambah_simpan">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="level_kode">Kode Level</label>
                            <input type="text" class="form-control" id="level_kode" name="level_kode"
                                placeholder="Masukkan Kode Level">
                        </div>
                        <div class="form-group">
                            <label for="level_nama">Nama Level</label>
                            <input type="text" class="form-control" id="level_nama" name="level_nama"
                                placeholder="Masukkan Nama Level">
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
</body>

</html>
