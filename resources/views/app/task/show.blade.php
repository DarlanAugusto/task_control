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

                        <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteTask">
                                <i class="bi bi-trash3"></i>
                                Excluir Tarefa
                            </button>

                            <div class="modal fade" id="deleteTask" tabindex="-1" aria-labelledby="deleteTaskLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteTaskLabel">Atenção!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Deseja realmente remover <b>{{ $task->task }}</b>?</p>
                                            <p class="text-muted font-italic">Um e-mail de notificação será enviado para você.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
