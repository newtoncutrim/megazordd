import { useState } from "react";
import styles from './TodoForm.module.css'

const TodoForm = ({ addTodo }) => {
  const [value, setValue] = useState("");
  const [category, setCategory] = useState("");

  // função para conectar formulário
  const handleSubmit = (e) => {
    e.preventDefault();
    // validação para dados nulos
    if (!value || !category) return;
    // adiciona os todos
    addTodo(value, category);
    // limpa os campos
    setValue("");
    setCategory("");
  };

  return (
    <div className={styles.TodoForm}>
      <h2>Criar Tarefa:</h2>
      <form onSubmit={handleSubmit} className={styles.form}>
        <input
        className={styles.input}
          type="text"
          placeholder="Digite um Título"
          value={value}
          onChange={(e) => setValue(e.target.value)}
        />
        <select className={styles.select} value={category} onChange={(e) => setCategory(e.target.value)}>
          <option value="">Selecione uma Categoria</option>
          <option value="Trabalho">Trabalho</option>
          <option value="Pessoal">Pessoal</option>
          <option value="Estudos">Estudos</option>
        </select>
        <button className={styles.buttonTodo}>Criar Tarefa</button>
      </form>
    </div>
  );
};

export default TodoForm;
