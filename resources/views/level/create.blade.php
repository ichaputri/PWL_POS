@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('level') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label for="level_kode">Kode Level</label>
                    <input type="text" class="form-control @error('level_kode') is-invalid @enderror" id="level_kode"
                        name="level_kode" placeholder="Masukkan Kode Level">

                    @error('level_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="level_nama">Nama Level</label>
                    <input type="text" class="form-control @error('level_nama') is-invalid @enderror" id="level_nama"
                        name="level_nama" placeholder="Masukkan Nama Level">
                    @error('level_nama')
                        <small class="alert alert-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button> <a
                            class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
</body>

</html>
