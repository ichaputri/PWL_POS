@extends('m_user/template')

@section('subtitle', 'M_User')
@section('content_header_title', 'M_user')
@section('content_header_subtitle', 'Edit Data M_user')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <h5 class="m-0">Tambah Data User</h5>
                </div>

            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Ops</strong> Input gagal<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('m_user.store') }}" method="POST">
                    @csrf


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Username:</strong>
                            <input type="text" name="username" class="form-control"
                                placeholder="Masukkan username"></input>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>nama:</strong>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama"></input>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" class="form-control"
                                placeholder="Masukkan password"></input>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Level id:</strong>
                            <input type="number" name="level_id" class="form-control"
                                placeholder="Masukkan ID Level"></input>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <a class="btn btn-danger" href="{{ route('m_user.index') }}"> Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

