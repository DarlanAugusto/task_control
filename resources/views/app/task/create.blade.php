@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>
                            <i class="bi bi-clipboard-plus"></i> {{ __('Nova Tarefa') }}
                        </span>

                        <a href="{{ route('task.index') }}" class="btn btn-primary btn-sm" title="Listar tarefas">
                            <i class="bi bi-list"></i>
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('task.store') }}" method="POST">
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
                                        <input id="task" type="text" class="form-control @error('task') is-invalid @enderror" name="task" value="{{ old('task') }}" required autocomplete="task" autofocus>
                                    </div>

                                    @error('task')
                                        <span class="invalid-feedback d-inline-block" role="alert">
                                            <strong>{{ $errors->first('task') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="deadline_date">Data Limite</label>
                                    <input type="date" name="deadline_date" id="deadline_date" class="form-control @error('deadline_date') is-invalid @enderror" value="{{ old('deadline_date') }}" required autocomplete="deadline_date" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Criar Nova Tarefa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
