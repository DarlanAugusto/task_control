@component('mail::message')
# Introdução

O corpo da sua mensagem

@component('mail::button', ['url' => ''])
    Texto do Botão
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
