@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="bi bi-list"></i> Tarefas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($tasks->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data Limite</th>
                                    <th scope="col" class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $task->id }}</th>
                                        <td>

                                            {{ $task->task }}</td>
                                        <td>{{ date('d/m/Y', strtotime($task->deadline_date)) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="text-decoration-none p-1 text-muted">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="#" class="text-decoration-none p-1 text-danger">
                                                    <i class="bi bi-trash3"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Nenhuma tarefa pendente. <a href="{{ route('task.create') }}">Crie uma clicando aqui</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
