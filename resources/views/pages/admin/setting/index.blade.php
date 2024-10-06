@extends('layouts.master')

@section('title', 'Setting')
@section('meta-tag')
    <meta name="description" content="Setting">
@endsection

@section('title', 'Setting')
@section('subtitle', 'Adjust the system settings')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-grid d-md-flex gap-3">
                                <div class="mb-3 flex-fill">
                                    <label for="app_name" class="form-label">App Name</label>
                                    <input type="text" class="form-control" id="app_name" name="app_name"
                                           placeholder="Nama Aplikasi"
                                           value="{{ $setting->app_name ?? '' }}">
                                </div>
                                <div class="mb-3 flex-fill">
                                    <label for="app_telp" class="form-label">No Telp</label>
                                    <input type="text" class="form-control" id="app_telp" name="app_telp"
                                           placeholder="082*****"
                                           value="{{ $setting->app_telp ?? '' }}">
                                </div>
                            </div>
                            <div class="d-grid d-md-flex gap-3">
                                <div class="mb-3 flex-fill">
                                    <label for="app_ig" class="form-label">Instagram</label>
                                    <input type="text" class="form-control" id="app_ig" name="app_ig"
                                           placeholder="https://ig.com"
                                           value="{{ $setting->app_ig ?? '' }}">
                                </div>
                                <div class="mb-3 flex-fill">
                                    <label for="app_linkedin" class="form-label">Linkedin</label>
                                    <input type="text" class="form-control" id="app_linkedin" name="app_linkedin"
                                           placeholder="https://linkedin.com"
                                           value="{{ $setting->app_linkedin ?? '' }}">
                                </div>
                            </div>
                            <div class="d-grid d-md-flex gap-3">
                                <div class="mb-3 flex-fill">
                                    <label for="app_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="app_email" name="app_email"
                                           placeholder="admin@gmail.com"
                                           value="{{ $setting->app_email ?? '' }}">
                                </div>
                            </div>
                            <div class="d-grid d-md-flex gap-3">
                                <div class="mb-3 flex-fill">
                                    <label for="name" class="form-label">App Description</label>
                                    <textarea class="form-control h-auto" id="description" name="app_description"
                                              placeholder="Deskripsi">{{ $setting->app_description ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="profile" class="form-label">Foto Profile</label>
                                <input type="file" class="form-control" id="profile" name="app_profile" accept="image/*">
                                <p class="form-text"><span class="text-danger">*</span> Leave it blank if you don't want to
                                    change the profile.
                                    @if($setting && $setting->app_profile != null)
                                        <img src="{{ asset('storage/logo/' . $setting->app_profile) }}" alt="{{ $setting->app_name }}" class="img-fluid mt-2" style="max-height: 200px;">
                                    @else
                                        <span class="text-danger">Tidak ada profile</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="favicon" class="form-label">Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="app_favicon" accept="image/*">
                                <p class="form-text"><span class="text-danger">*</span> Leave it blank if you don't want to
                                    change the favicon.
                                    @if($setting && $setting->app_favicon != null)
                                        <img src="{{ asset('storage/logo/' . $setting->app_favicon) }}" alt="{{ $setting->app_name }}" class="img-fluid mt-2" style="max-height: 200px;">
                                    @else
                                        <span class="text-danger">Tidak ada favicon</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://kit.fontawesome.com/1d954ea888.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
            @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
            });
            @endif
        });
    </script>
@endpush

