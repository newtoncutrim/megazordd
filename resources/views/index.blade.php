<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('user.logout')}}">Sair</a>
    <h1><a href="{{route('tasks.new')}}">Criar tarefa</a></h1>
    <p>Olá {{auth()->user()->name}}</p>
    <p>id usuario: {{auth()->user()->id}}</p>
    <table>
        <thead>
            <th>Titulo</th>
            <th>Descricao</th>
            <th>Data</th>
            <th>Actions</th>
        </thead>
        <tbody>

            @foreach ($tasks as $task)
                <tr>
                    <td>{{$task['title']}}</td>
                    <td>{{$task['description']}}</td>
                    <td>{{$task['due_date']}}</td>
                    <td>
                        <a href="{{route('tasks.edit', $task['id'])}}">Editar</a>
                        <a href="{{route('tasks.detalhe', $task['id'])}}">Detalhes</a>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>
</body>
</html>
