import { useState } from "react";
import styles from './TodoForm.module.css'
import axios from "axios";

const TodoForm = ({ addTodo }) => {
  const [value, setValue] = useState("");
  // const [category, setCategory] = useState("");
  const [description, setDescription] = useState('')

  // função para conectar formulário
  const handleSubmit = async (e) => {
    e.preventDefault();

    const token = localStorage.getItem('token')
    if(token){
      try{
        const response = await axios.post('http://localhost:8989/api/tasks', {title: value, description: description}, {
          headers: {
            Authorization: `Bearer ${token}`
          },
        } );
        console.log('Tarefa criada com sucesso', response.data)
      } catch (error){
        console.log('Error ao criar tarefa', error)
      }
    }

    // validação para dados nulos
    if (!value || !description) return;
    // adiciona os todos
    addTodo(value, description);
    // limpa os campos
    setValue("");
    setDescription("");
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
        <input
        className={styles.input}
          type="text"
          placeholder="Faça uma descrição da tarefa"
          value={description}
          onChange={(e) => setDescription(e.target.value)}
        />
        {/* <select className={styles.select} value={category} onChange={(e) => setCategory(e.target.value)}>
          <option value="">Selecione uma Categoria</option>
          <option value="Trabalho">Trabalho</option>
          <option value="Pessoal">Pessoal</option>
          <option value="Estudos">Estudos</option>
        </select> */}
        <button className={styles.buttonTodo}>Criar Tarefa</button>
      </form>
    </div>
  );
};

export default TodoForm;
