<h1>Formulario de cadastro</h1>

<form action="{{route('tasks.create')}}" method="post">
    @csrf

    <button type="submit">Criar</button>
</form>
