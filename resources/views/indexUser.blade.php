@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Manage User')
@section('content_header_title', 'Manage User')
@section('content_header_subtitle', 'User')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <h5 class="m-0">Manage User</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ url('/user/tambah') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah User</a>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush