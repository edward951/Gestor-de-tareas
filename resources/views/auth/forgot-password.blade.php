@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="mb-3">
                            <img src="{{ asset('images/planificacion.png') }}" alt="Task Icon" class="img-fluid"
                                style="max-height: 100px; display: block; margin: 0 auto;">
                        </div>
                        <h2 class="mb-0">Recuperar Contraseña</h2>
                    </div>

                    <div class="card-body">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('¿Olvidó su contraseña? No hay problema. Solo déjenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.') }}
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar enlace') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
