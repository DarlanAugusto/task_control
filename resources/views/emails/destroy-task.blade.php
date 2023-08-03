@component('mail::message')
# {{ $task }} Excluída

A tarefa <b>{{ $task }}</b> foi excluída com sucesso.

@component('mail::button', ['url' => $url])
Ver Tarefas Pendentes
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
