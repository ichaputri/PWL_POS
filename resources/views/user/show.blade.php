@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($user)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($user->image)
                        <img src="{{ asset($user->image) }}" alt="User Image" class="img-thumbnail mb-3 rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('gambar/default-avatar.jpg') }}" alt="Default Image" class="img-thumbnail mb-3 rounded-circle shadow" style="width: 200px; height: 200px; object-fit: cover;">
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table table-hover table-striped shadow-sm rounded">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $user->user_id }}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{ $user->level->level_nama }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>********</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endempty
        <a href="{{ url('user') }}" class="btn btn-sm btn-primary mt-3">Kembali</a>
    </div>
</div>
@endsection

@push('css')
    <style>
        .card-title {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table th {
            width: 25%;
            background-color: #f8f9fa;
            font-weight: bold;
            border-top: none;
        }

        .table td {
            background-color: #ffffff;
            border-top: none;
        }

        .img-thumbnail {
            border: 3px solid #dee2e6;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
@endpush

@push('js')
@endpush
