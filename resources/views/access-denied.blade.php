@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acesso negado!</div>

                <div class="card-body">
                    Oops! Você não tem acesso a este recurso.
                    <a href="{{ route('task.index') }}" class="link">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
