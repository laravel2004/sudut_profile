@extends('layouts.master')

@section('title', 'Manajemen Profil')
@section('meta-tag')
    <meta name="description" content="Manajemen Profil">
@endsection

@section('title', 'Manajemen Profil')
@section('subtitle', 'Adjust the system settings')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <h5>Profile</h5>
                        <p class="text-muted">Update your profile information.</p>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 flex-fill">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe"
                                       value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 flex-fill">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="admin@sudutweb.com" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <h5>Credentials</h5>
                        <p class="text-muted">Leave it blank if you don't want to change the password.</p>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="new_password" class="form-label">New Password</label>
                            <div class="mb-3 flex-fill input-group">
                                <input type="password" class="form-control shw_pswd" id="new_password"
                                       name="new_password" placeholder="********">
                                <span class="input-group-text">
                                    <i class="bi bi-eye-slash" id="toggleNewPassword"
                                       onclick="togglePassword('new_password', 'toggleNewPassword')"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <div class="mb-3 flex-fill input-group">
                                <input type="password" class="form-control shw_pswd" id="confirm_password"
                                       name="confirm_password" placeholder="********">
                                <span class="input-group-text">
                                    <i class="bi bi-eye-slash" id="toggleConfirmPassword"
                                       onclick="togglePassword('confirm_password', 'toggleConfirmPassword')"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <label for="old_password" class="form-label">Old Password</label>
                    <div class="mb-3 flex-fill input-group">
                        <input type="password" class="form-control shw_pswd" id="old_password" name="old_password"
                               placeholder="********">
                        <span class="input-group-text">
                            <i class="bi bi-eye-slash" id="toggleOldPassword"
                               onclick="togglePassword('old_password', 'toggleOldPassword')"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
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

        function togglePassword(fieldId, toggleIconId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(toggleIconId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            }
        }
    </script>
@endpush

