@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>
                            <i class="bi bi-clipboard-"></i> Editando - {{ $task->task }}
                        </span>

                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('task.create') }}" class="btn btn-primary btn-sm" title="Nova Tarefa">
                                <i class="bi bi-clipboard-plus"></i>
                            </a>
                            <a href="{{ route('task.index') }}" class="btn btn-primary btn-sm" title="Listar Tarefas">
                                <i class="bi bi-list"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('task.update', $task->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="task">Tarefa</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="bi bi-clipboard"></i>
                                            </div>
                                        </div>
                                        <input id="task" type="text" class="form-control @error('task') is-invalid @enderror" name="task" value="{{ old('task') ?? $task->task }}" required autocomplete="task" autofocus>
                                    </div>

                                    @error('task')
                                        <span class="invalid-feedback d-inline-block" role="alert">
                                            <strong>{{ $errors->first('task') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="deadline_date">Data Limite</label>
                                    <input type="date" name="deadline_date" id="deadline_date" class="form-control @error('deadline_date') is-invalid @enderror" value="{{ old('deadline_date') ?? $task->deadline_date }}" required autocomplete="deadline_date" autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#alterTask">Salvar Tarefa</button>
                        </div>

                        <div class="modal fade" id="alterTask" tabindex="-1" aria-labelledby="alterTaskLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="alterTaskLabel">Atenção!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Deseja realmente aplicar estas alterações ?</p>
                                        <p class="text-muted font-italic">Um e-mail de notificação será enviado para você.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-warning">Confirmar</button>
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
@endsection
