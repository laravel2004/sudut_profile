@extends('layouts.master')

@section('meta-tag')
    <meta name="description" content="Buat Prestasi Baru">
@endsection

@section('title', "Prestasi Baru")
@section('subtitle', "Tambahkan Prestasi Baru")
@push('styles')
    <style>
        .ck-editor__editable {min-height: 500px;}
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambahkan Prestasi</h4>
            </div>
            <div class="card-body">
                <form id="create" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Juara 1 Lomba Sudutweb">
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="test-test"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text" placeholder="Lomba KMIPN V" class="form-control" id="meta_description" name="meta_description" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="competition_organizer" class="form-label">Penyelenggara Lomba</label>
                        <input class="form-control" id="competition_organizer" name="competition_organizer"
                                  placeholder="Kemendikbud">
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editor" name="description"
                                  rows="20"
                                  placeholder="Deskripsi Prestasi"></textarea>
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

            $.ajax({
                url: '{{ route('admin.prestation.store') }}',
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
                        window.location.href = '{{ route('admin.prestation.index') }}';
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
