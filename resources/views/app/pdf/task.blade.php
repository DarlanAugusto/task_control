<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Lista de Tarefas</title>

        <style>
            * {
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, tr, td {
                border: 1px solid #000;
            }
        </style>
    </head>
    <body>
        <table cellpadding="4">
            <tr>
                <td colspan="4" align="center" style="background-color: rgba(137, 43, 226, 0.736); color: #fff">
                    <h2>LISTA DE TAREFAS</h2>
                </td>
            </tr>
            <tr style="background-color: rgba(137, 43, 226, 0.348);">
                <td><b>ID</b></td>
                <td><b>Usuário</b></td>
                <td><b>Tarefa</b></td>
                <td><b>Conclusão</b></td>
            </tr>
            @foreach ($tasks as $task)
                <tr style="background-color: rgba(137, 43, 226, 0.104);">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->task }}</td>
                    <td>{{ date('d/m/Y', strtotime($task->deadline_date)) }}</td>
                </tr>
            @endforeach
        </table>

    </body>
</html>
