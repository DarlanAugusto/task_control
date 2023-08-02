@component('mail::message')
# {{ $task }}

@if ($previousTask != $task)
A tarefa <b>{{ $previousTask }}</b> foi renomeada para <b>{{ $task }}</b>.
@endif

@if ($previousDeadline_date != $deadline_date)
A data limite foi alterada de <b>{{ $previousDeadline_date }}</b> para <b>{{ $deadline_date }}</b>.
@endif

@component('mail::button', ['url' => $url])
Ver Tarefa
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
