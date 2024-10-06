@extends('layouts.master')

@section('meta-tag')
    <meta name="description" content="Edit Pengalaman Kerja">
@endsection

@section('title', "Edit Pengalaman Kerja")
@section('subtitle', "Perbarui Pengalaman Kerja")
@push('styles')
    <style>
        .ck-editor__editable {min-height: 500px;}
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Perbarui Pengalaman Kerja</h4>
            </div>
            <div class="card-body">
                <form id="create" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Perusahaan</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                       placeholder="PT. Sudutweb Teknologi Indonesia"
                                       value="{{$data->company_name}}"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{$data->start_date}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position"
                                       placeholder="Junior Backend Developer"
                                       value="{{$data->position}}"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{$data->end_date}}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editor" name="description"
                                  rows="20"
                                  placeholder="Deskripsi Prestasi">{{$data->description}}</textarea>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script src="/assets/static/js/pages/ckeditor.js"></script>
    <script>
        $('#submit').on('click', function (e) {
            e.preventDefault();

            let formData = new FormData($('#create')[0]);
            formData.append('description', myeditor.getData());
            formData.append('_method', 'PUT');

            $.ajax({
                url: '{{ route('admin.work-experience.update', $data->id) }}',
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
                        window.location.href = '{{ route('admin.work-experience.index') }}';
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
