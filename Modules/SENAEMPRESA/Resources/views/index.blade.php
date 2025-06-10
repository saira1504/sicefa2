@extends('senaempresa::layouts.master')

@section('content')
    <div class="container mt-5 text-center">
        <h1 class="display-4">¡Bienvenido a SENAEMPRESA!</h1>
        <p class="lead">Plataforma de gestión empresarial y académica del SENA.</p>
        <hr class="my-4">
        <p>Usa el menú superior para comenzar a .</p>

        <div class="mt-4">
            <img src="{{ asset('modules/senaempresa/images/Aviso Modelo Final.jpg') }}" alt="SENA Empresa"
                 class="img-fluid rounded shadow" style="max-width: 600px;">
        </div>
    </div>
@endsection

