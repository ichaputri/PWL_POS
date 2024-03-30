@extends('m_user/template')

@section('subtitle', 'M_User')
@section('content_header_title', 'M_user')
@section('content_header_subtitle', 'Detail Data M_user')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <h5 class="m-0">Tampilkan Detail User</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User_id:</strong>
                            {{ $useri->user_id }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Level_id:</strong>
                            {{ $useri->level_id }}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Username:</strong>
                            {{ $useri->username }}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nama:</strong>
                            {{ $useri->nama }}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            {{ $useri->password }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <a class="btn btn-danger" href="{{ route('m_user.index') }}"> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
