import React from "react";
import axios from "axios";
import styles from './TodoForm.module.css'

const TodoForm = ({ addTodo }) => {
  const [value, setValue] = React.useState("");
  const [description, setDescription] = React.useState("");
  const [loading, setLoading] = React.useState(false);

  const handleSubmit = async (e) => {
      e.preventDefault();

      const token = localStorage.getItem("token");

      if (token) {
          try {
              setLoading(true);
              const response = await axios.post(
                  "http://localhost:8989/api/tasks",
                  { title: value, description: description },
                  {
                      headers: {
                          Authorization: `Bearer ${token}`,
                      },
                  }
              );
              console.log("Tarefa criada com sucesso", response.data);
              addTodo(value, description);
              setValue("");
              setDescription("");
          } catch(error) {
             console.log('Erro ao criar tarefa', error)
          } finally {
              setLoading(false);
          }
      }

      if (!value || !description) {
          console.log("Por favor, preencha todos os campos.");
          return;
      }
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
              <button className={styles.buttonTodo} disabled={loading}>
                  {loading ? "Aguarde..." : "Criar Tarefa"}
              </button>
          </form>
      </div>
  );
};

export default TodoForm;
