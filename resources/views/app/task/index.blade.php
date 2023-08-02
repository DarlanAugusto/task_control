@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>
                            <i class="bi bi-list"></i> Tarefas
                        </span>
                        <nav aria-label="...">
                            <ul class="pagination pagination-sm m-0">
                                <li class="page-item @if($tasks->currentPage() == 1) disabled @endif" title="Primeira página (1)">
                                    <a class="page-link" href="{{ $tasks->toArray()['first_page_url'] }}">&laquo;</a>
                                </li>
                                @php
                                    $page = 1;
                                    if($tasks->currentPage() >= 3) {
                                        $page = $tasks->currentPage() - 1;
                                    }
                                @endphp
                                @for ($i = $page; $i <= $tasks->lastPage(); $i++)
                                    @if ($i <= ($page + 2))
                                        <li class="page-item @if($i == $tasks->currentPage()) active @endif" aria-current="page" title="Página {{ $i }} de {{ $tasks->lastPage() }}">
                                            <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                                <li class="page-item @if($tasks->currentPage() == $tasks->lastPage()) disabled @endif" title="Última página ({{ $tasks->lastPage() }})">
                                    <a class="page-link" href="{{ $tasks->url($tasks->lastPage()) }}">&raquo;</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

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
                                    <th scope="col" class="text-center">
                                        <i class="bi bi-three-dots"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $task->id }}</th>
                                        <td>

                                            {{ $task->task }}</td>
                                        <td>{{ date('d/m/Y', strtotime($task->deadline_date)) }}</td>
                                        <td align="center">
                                            <a href="{{ route('task.edit', $task->id) }}" class="text-decoration-none p-1 text-muted">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="#" class="text-decoration-none p-1 text-danger">
                                                <i class="bi bi-trash3"></i>
                                            </a>
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
