@extends('layouts.master')

@section('meta-tag')
    <meta name="description" content="Edit Project">
@endsection

@section('title', "Edit Project")
@section('subtitle', "Perbarui Project")
@push('styles')
    <style>
        .ck-editor__editable {min-height: 500px;}
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Perbarui Project</h4>
            </div>
            <div class="card-body">
                <form id="create" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Juara 1 Lomba Sudutweb"
                                       value="{{$data->title}}"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="test-test"
                                       value="{{$data->slug}}"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text" placeholder="Lomba KMIPN V" class="form-control" id="meta_description" name="meta_description" value="{{$data->meta_description}}">
                            </div>
                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keyword</label>
                                <input class="form-control" id="meta_keywords" name="meta_keywords"
                                       placeholder="Kemendikbud" value="{{$data->meta_keywords}}">
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Link</label>
                                <input class="form-control" id="link" name="link"
                                       placeholder="Kemendikbud" value="{{$data->link}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted"><span class="text-danger">*</span>Kosongkan jika tidak ingin mengubah gambar</small>
                                <br>
                                @if($data->image)
                                    <small class="text-muted">Gambar saat ini : </small>
                                    <img src="{{ asset('storage/project/' . $data->image) }}" alt="{{ $data->name }}" class="img-fluid mt-2">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editor" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editor" name="content"
                                  rows="20"
                                  placeholder="Deskripsi Artikel">{{$data->content}}</textarea>
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
            formData.append('_method', 'PUT');

            $.ajax({
                url: '{{ route('admin.project.update', $data->id) }}',
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
                        window.location.href = '{{ route('admin.project.index') }}';
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
