@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <div class="mb-3">
                        <img src="{{ asset('images/planificacion.png') }}" alt="Task Icon" class="img-fluid"
                            style="max-height: 100px; display: block; margin: 0 auto;">
                    </div>
                    <h2 class="mb-0">Registro</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword"
                                    aria-label="Toggle password visibility">
                                    <i class="bi bi-eye" id="passwordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirm"
                                    aria-label="Toggle password visibility">
                                    <i class="bi bi-eye" id="passwordConfirmIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordButton = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            const togglePasswordConfirmButton = document.getElementById('togglePasswordConfirm');
            const passwordConfirmField = document.getElementById('password_confirmation');
            const passwordConfirmIcon = document.getElementById('passwordConfirmIcon');

            togglePasswordButton.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordIcon.classList.remove('bi-eye');
                    passwordIcon.classList.add('bi-eye-slash');
                } else {
                    passwordField.type = 'password';
                    passwordIcon.classList.remove('bi-eye-slash');
                    passwordIcon.classList.add('bi-eye');
                }
            });

            togglePasswordConfirmButton.addEventListener('click', function() {
                if (passwordConfirmField.type === 'password') {
                    passwordConfirmField.type = 'text';
                    passwordConfirmIcon.classList.remove('bi-eye');
                    passwordConfirmIcon.classList.add('bi-eye-slash');
                } else {
                    passwordConfirmField.type = 'password';
                    passwordConfirmIcon.classList.remove('bi-eye-slash');
                    passwordConfirmIcon.classList.add('bi-eye');
                }
            });
        });
    </script>
@endpush
