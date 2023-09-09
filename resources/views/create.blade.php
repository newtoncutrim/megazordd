<h1>Formulario de cadastro</h1>

<form action="{{route('tasks.create')}}" method="post">
    @csrf
    <label for="title">Titulo</label>
    <input id="title" type="text" name="title">
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    <input type="date" name="due_date" id="due_date">
    <label for="description">Descricao</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>

    <button type="submit">Criar</button>
</form>
