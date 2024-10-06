@extends('layouts.master')

@section('meta-tag')
    <meta name="description" content="Buat Artikel Baru">
@endsection

@section('title', "Artikel Baru")
@section('subtitle', "Tambahkan Artikel Baru")
@push('styles')
    <style>
        .ck-editor__editable {min-height: 500px;}
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambahkan Artikel</h4>
            </div>
            <div class="card-body">
                <form id="create" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Fenomena">
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
                                <label for="meta_keywords" class="form-label">Meta Keyword</label>
                                <input class="form-control" id="meta_keywords" name="meta_keywords"
                                       placeholder="Energi Terbaharui">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea placeholder="Ini adalah..." class="form-control" id="meta_description" name="meta_description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editor" name="content"
                                  rows="20"
                                  placeholder="Content..."></textarea>
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
            formData.append('content', myeditor.getData());

            $.ajax({
                url: '{{ route('admin.artikel.store') }}',
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
                        window.location.href = '{{ route('admin.artikel.index') }}';
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
