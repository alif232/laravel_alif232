@extends('layout.app')

@section('title', isset($rumahSakit) ? 'Edit Rumah Sakit' : 'Tambah Rumah Sakit')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ isset($rumahSakit) ? 'Edit Rumah Sakit' : 'Form Rumah Sakit' }}</h4>

            <form class="forms-sample" method="POST"
                action="{{ isset($rumahSakit) ? route('rumahsakit.update', $rumahSakit->id) : route('rumahsakit.store') }}">
                @csrf
                @if(isset($rumahSakit))
                @method('PUT')
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="form-group">
                    <label>Nama Rumah Sakit</label>
                    <input type="text" class="form-control" name="nama_rumah_sakit"
                        value="{{ old('nama_rumah_sakit', $rumahSakit->nama_rumah_sakit ?? '') }}"
                        placeholder="Nama Rumah Sakit" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email"
                        value="{{ old('email', $rumahSakit->email ?? '') }}" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" class="form-control" name="telepon"
                        value="{{ old('telepon', $rumahSakit->telepon ?? '') }}" placeholder="No Telepon" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="4" name="alamat"
                        required>{{ old('alamat', $rumahSakit->alamat ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary me-2">
                    {{ isset($rumahSakit) ? 'Update' : 'Submit' }}
                </button>
                <a href="{{ url('/rumah-sakit') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection