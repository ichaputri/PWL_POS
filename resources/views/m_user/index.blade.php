@extends('m_user/template')

@section('subtitle', 'M_User')
@section('content_header_title', 'M_user')
@section('content_header_subtitle', 'User')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <h5 class="m-0">CRUD User</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('m_user.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Input User</a>
                </div>
            </div>
            <div class="card-body">
                
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">User id</th>
                        <th class="text-center">Level id</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Password</th>
                        <th class="text-center">Action</th>
                    </tr>
                    @foreach ($useri as $m_user)
                        <tr>

                            <td>{{ $m_user->user_id }}</td>
                            <td>{{ $m_user->level_id }}</td>
                            <td>{{ $m_user->username }}</td>
                            <td>{{ $m_user->nama }}</td>
                            <td>{{ $m_user->password }}</td>

                            <td class="text-center">
                                <form action="{{ route('m_user.destroy', $m_user->user_id) }}" method="POST">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('m_user.show', $m_user->user_id) }}">Show</a>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('m_user.edit', $m_user->user_id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endsection
