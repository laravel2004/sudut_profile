@extends('layouts.master')

@section('meta-tag')
    <meta name="description" content="Buat Pendidikan Baru">
@endsection

@section('title', "Pendidikan Baru")
@section('subtitle', "Tambahkan Pendidikan Baru")
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambahkan Pendidikan</h4>
            </div>
            <div class="card-body">
                <form id="create" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="school_name" class="form-label">Instansi Pendidikan</label>
                                <input type="text" class="form-control" id="school_name" name="school_name"
                                       placeholder="SMA Negeri 1 Kesamben">
                            </div>
                            <div class="mb-3">
                                <label for="start_year" class="form-label">Start Year</label>
                                <input type="text" class="form-control" id="start_year" name="start_year" maxlength="4"
                                       placeholder="YYYY" oninput="validateYear(this)"/>
                            </div>
                            <div class="mb-3">
                                <label for="order" class="form-label">Pendidikan Ke</label>
                                <input type="number" class="form-control" id="order" name="order"
                                       placeholder="0"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <small class="text-muted"><span class="text-danger">*</span>Tidak harus diisi</small>
                                <input type="text" class="form-control" id="jurusan" name="jurusan"
                                       placeholder="Teknik Informatika"/>
                            </div>
                            <div class="mb-3">
                                <label for="end_year" class="form-label">End Year</label>
                                <input type="text" class="form-control" id="end_year" name="end_year" maxlength="4"
                                       placeholder="YYYY" oninput="validateYear(this)"/>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Link Instansi</label>
                                <small class="text-muted"><span class="text-danger">*</span>Tidak harus diisi</small>
                                <input type="text" class="form-control" id="link" name="link"
                                       placeholder="http://test.com"/>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function validateYear(input) {
            input.value = input.value.replace(/[^0-9]/g, '').slice(0, 4);
        }

        $('#submit').on('click', function (e) {
            e.preventDefault();

            let formData = new FormData($('#create')[0]);

            $.ajax({
                url: '{{ route('admin.education.store') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                    }).then(() => {
                        window.location.href = '{{ route('admin.education.index') }}';
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                    });
                }
            });
        });
    </script>
@endpush
