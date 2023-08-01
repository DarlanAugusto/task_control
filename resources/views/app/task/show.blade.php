@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="bi bi-clipboard"></i> {{ $task->task }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Data limite: {{ date('d/m/Y', strtotime($task->deadline_date)) }}</p>

                    <div class="d-flex justify-content-between">
                        <a class="btn btn-primary" href="{{ url()->previous() }}">
                            <i class="bi bi-arrow-left"></i>
                            Voltar
                        </a>

                        <button type="button" class="btn btn-danger" disabled>
                            <i class="bi bi-trash3"></i>
                            Excluir Tarefa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
