@component('mail::message')
# {{ $task }}

Data limite: {{ $deadline_date }}

@component('mail::button', ['url' => $url])
Ver Tarefa
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
