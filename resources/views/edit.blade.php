<h1>Formulario de edicao</h1>

<form action="{{route('tasks.update', $datas['id'])}}" method="post">
    @csrf
    <label for="title">Titulo</label>
    <input id="title" type="text" name="title" value="{{$datas['title']}}">
    <input type="number" name="user_id" value="{{$datas['id']}}">
    <input type="date" name="due_date" id="due_date" value="{{$datas['due_date']}}">
    <label for="description">Descricao</label>
    <textarea name="description" id="description" cols="30" rows="10">{{$datas['description']}}</textarea>

    <button type="submit">Criar</button>
</form>
