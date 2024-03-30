@extends('m_user/template')

@section('subtitle', 'M_User')
@section('content_header_title', 'M_user')
@section('content_header_subtitle', 'Edit Data M_user')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <h5 class="m-0">Edit Data User</h5>
                </div>

            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Ops!</strong> Error <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('m_user.update', $useri->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>User_id:</strong>
                                <input type="text" name="userid" value="{{ $useri->user_id }}" class="form-control"
                                    placeholder="Masukkan user id">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Level_id:</strong>
                                <input type="text" name="levelid" value="{{ $useri->level_id }}" class="form-control"
                                    placeholder="Masukkan level">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Username:</strong>
                                <input type="text" value= "{{ $useri->username }}" class="form-control" name="username"
                                    placeholder="Masukkan Nomor username"">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>nama:</strong>
                                <input type="text" value= "{{ $useri->nama }}"name="nama" class="form-control"
                                    placeholder="Masukkan nama"></input>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="password" value= "{{ $useri->password }}"name="password" class="form-control"
                                    placeholder="Masukkan password"></input>
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
