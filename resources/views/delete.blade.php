<ul>
    <li>
        <label for="title">Título:</label>
        <span>{{ $datas['title'] ?? 'N/A' }}</span>
    </li>
    <li>
        <label for="user_id">ID do Usuário:</label>
        <span>{{ auth()->user()->id ?? 'N/A' }}</span>
    </li>
    <li>
        <label for="due_date">Data de Vencimento:</label>
        <span>{{ $datas['dataFormat'] ?? 'N/A' }}</span>
    </li>
    <li>
        <label for="description">Descrição:</label>
        <span>{{ $datas['description'] ?? 'N/A' }}</span>
    </li>
</ul>

<form action="{{ route('tasks.delete', $datas['id']) }}"
method="POST">
    @csrf
    @method('DELETE')


    <button type="submit" onclick="return confirm('Tem certeza de que deseja excluir esta tarefa?')">Deletar</button>
</form>
