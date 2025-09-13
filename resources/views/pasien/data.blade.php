@extends('layout.app')

@section('title', 'Data Pasien')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card shadow-sm">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div id="alert-container"></div>
        <div class="card-body">
            <h4 class="card-title mb-0">Data Pasien</h4>
            <p class="card-description">Tabel data pasien</p>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <a href="{{ url('/pasien/form') }}" class="btn btn-primary btn-sm me-2">
                        <i class="mdi mdi-plus"></i> Tambah
                    </a>
                    <select id="filterRumahSakit" class="form-select form-select-sm text-dark">
                        <option value="">Semua Rumah Sakit</option>
                        @foreach($rumahSakits as $rs)
                        <option value="{{ $rs->id }}">{{ $rs->nama_rumah_sakit }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <input type="text" id="search" class="form-control form-control-sm" placeholder="Cari Pasien..."
                        style="width: 200px;">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle" id="pasien">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Pasien</th>
                            <th>Rumah Sakit</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-black">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="confirmDelete" class="btn btn-primary btn-sm">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>

<script>
    $(document).ready(function() {
        let deleteId = null;

        function loadData(search = '', rumahSakitId = '') {
            $.get("{{ route('pasien.data') }}", {
                search,
                rumah_sakit_id: rumahSakitId
            }, function(data) {
                let rows = '';
                data.forEach((item, index) => {
                    rows += `
                    <tr>
                        <td>${index+1}</td>
                        <td>${item.nama_pasien}</td>
                        <td>${item.rumah_sakit ? item.rumah_sakit.nama_rumah_sakit : '-'}</td>
                        <td>${item.no_telpon}</td>
                        <td>${item.alamat}</td>
                        <td>
                            <button onclick="window.location.href='{{ url('pasien') }}/${item.id}/edit'" 
                                    class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="${item.id}">Hapus</button>
                        </td>
                    </tr>`;
                });
                $('#pasien tbody').html(rows);
            });
        }

        loadData();

        $('#search').on('keyup', function() {
            const search = $(this).val();
            const rumahSakitId = $('#filterRumahSakit').val();
            loadData(search, rumahSakitId);
        });

        $('#filterRumahSakit').on('change', function() {
            const rumahSakitId = $(this).val();
            const search = $('#search').val();
            loadData(search, rumahSakitId);
        });

        $(document).on('click', '.btn-delete', function() {
            deleteId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            if (deleteId) {
                $.ajax({
                    url: "{{ url('pasien') }}/" + deleteId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        loadData();

                        $('#alert-container').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    },
                    error: function() {
                        $('#deleteModal').modal('hide');
                        $('#alert-container').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Terjadi kesalahan saat menghapus data
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    }
                });
            }
        });
    });
</script>
@endsection