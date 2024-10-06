@extends('layouts.master')

@section('meta-tag')
    <meta name="description" content="Manajemen Pengalaman Kerja Anda">
@endsection

@section('title', 'Manajemen Pengalaman Kerja')
@section('subtitle', 'Manajemen Pengalaman Kerja, Buat, Edit, Hapus, dan Lihat Detail Pengalaman Kerja')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pengalaman Kerja</h4>
                <div class="text-end">
                    <a href="{{ route('admin.work-experience.create') }}" class="btn btn-primary">+ Pengalaman Kerja</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4 align-items-end">
                    <div class="col-md-2">
                        <label for="limit" class="form-label">Limit</label>
                        <select name="limit" id="limit" class="form-select">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Cari Pengalaman Kerja Anda">
                            <button class="btn btn-primary" type="button" onclick="onSearch()">Cari</button>
                            @if(request()->has('search') || request()->has('limit'))
                                &nbsp;
                                <a href="{{ route('admin.prestation.index') }}" class="btn btn-danger">Reset</a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tabel Destinasi Wisata dengan table-responsive -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-primary">
                        <tr>
                            <th scope="col" class="text-white">#</th>
                            <th scope="col" class="text-white">Perusahaan</th>
                            <th scope="col" class="text-white">Posisi</th>
                            <th scope="col" class="text-white">Start date</th>
                            <th scope="col" class="text-white">End date</th>
                            <th scope="col" class="text-white">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->position }}</td>
                                <td>{{ $item->start_date }}</td>
                                <td>{{ $item->end_date }}</td>
                                <td>
                                    <a href="{{ route('admin.work-experience.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger" onclick="deletePrestation({{ $item->id }})">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function deletePrestation(id) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.work-experience.destroy',':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        }


        function onSearch() {
            let limit = $('#limit').val();
            let search = $('#search').val();

            window.location.href = '{{ route('admin.work-experience.index') }}?limit=' + limit + '&search=' + search;
        }
    </script>
@endpush