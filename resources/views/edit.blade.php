<h1>Formulario de edicao</h1>

<form action="{{route('tasks.update', $datas['id'])}}" method="post">
    @csrf
    @method('PUT')
    <label for="title">Titulo</label>
    <input id="title" type="text" name="title" value="{{$datas['title']}}">
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    <input type="date" name="due_date" id="due_date" value="{{ date('Y-m-d', strtotime($datas['dataFormat'])) }}">
    <label for="description">Descricao</label>
    <textarea name="description" id="description" cols="30" rows="10">{{$datas['description']}}</textarea>

    <button type="submit">Editar</button>
</form>
