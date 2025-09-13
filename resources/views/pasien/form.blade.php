@extends('layout.app')

@section('title', isset($pasien) ? 'Edit Pasien' : 'Tambah Pasien')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ isset($pasien) ? 'Edit Pasien' : 'Form Pasien' }}</h4>

            <form class="forms-sample" method="POST"
                action="{{ isset($pasien) ? route('pasien.update', $pasien->id) : route('pasien.store') }}">
                @csrf
                @if(isset($pasien))
                @method('PUT')
                @endif

                {{-- Error handling --}}
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
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control" name="nama_pasien"
                        value="{{ old('nama_pasien', $pasien->nama_pasien ?? '') }}" placeholder="Nama Pasien" required>
                </div>

                <div class="form-group">
                    <label>Rumah Sakit</label>
                    <select class="form-control text-dark" name="rumah_sakit_id" required>
                        <option value="" class="text-dark">-- Pilih Rumah Sakit --</option>
                        @foreach($rumahSakits as $rs)
                        <option value="{{ $rs->id }}" class="text-dark"
                            {{ old('rumah_sakit_id', $pasien->rumah_sakit_id ?? '') == $rs->id ? 'selected' : '' }}>
                            {{ $rs->nama_rumah_sakit }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" class="form-control" name="no_telpon"
                        value="{{ old('no_telpon', $pasien->no_telpon ?? '') }}" placeholder="No Telepon" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="4" name="alamat"
                        required>{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary me-2">
                    {{ isset($pasien) ? 'Update' : 'Submit' }}
                </button>
                <a href="{{ url('/pasien') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection