@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data User</h3>
            </div>

            <form method="post" action="/user/tambah_simpan">

                {{ csrf_field() }}
                <div class="card-body">


                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="level_id">Level ID</label>
                        <input type="number" name="level_id" class="form-control" id="level_id"
                            placeholder="Masukkan ID Level">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Simpan">
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection
</body>

</html>
