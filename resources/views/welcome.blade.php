@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-between">
            <div class="col-md-6 ml-0">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Level</h3>
                    </div>
                        <form method="post" action="/level/tambah_simpan">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="level_kode">Kode Level</label>
                                    <input type="text" class="form-control" id="level_kode" name="level_kode" placeholder="Masukkan Kode Level">
                                </div>
                                <div class="form-group">
                                    <label for="level_nama">Nama Level</label>
                                    <input type="text" class="form-control" id="level_nama" name="level_nama" placeholder="Masukkan Nama Level">
                                </div>
                                <div class="form-group text-right">
                                    <input type="submit" class="btn btn-primary" value="Simpan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mr-0">
                <div class="card card-info">
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
                            <div class="form-group  text-right">
                                <input type="submit" class="btn btn-primary" value="Simpan">
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script> @stop
