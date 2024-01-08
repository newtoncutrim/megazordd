import React from "react";
import axios from "axios";
import styles from "./TodoForm.module.css";
import { UserContext } from "@/UserContext";

const TodoForm = ({ fetchTasksUser }) => {
    const [value, setValue] = React.useState("");
    const [description, setDescription] = React.useState("");
    const [loading, setLoading] = React.useState(false);
    const [error, setError] = React.useState(null);

    const { getUserId } = React.useContext(UserContext);

    const addTodo = async () => {
        if (!value || !description) {
            setError("Por favor, preencha todos os campos.");
            return;
        }

        const userId = await getUserId();
        const token = localStorage.getItem("token");

        if (!userId || !token) {
            setError("Usuário não autenticado. Por favor, faça o login.");
            return;
        }

        try {
            setLoading(true);
            const response =  await axios.post(
                "http://localhost:8989/api/tasks",
                { title: value, description: description, user_id: userId },
                {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                }
            );

            fetchTasksUser();
            setValue("");
            setDescription("");
            setError(null);

        } catch (error) {
            console.error("Erro ao criar tarefa", error);
            setError("Erro ao criar tarefa. Tente novamente.");
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className={styles.TodoForm}>
            <h2 className={styles.titleTask}>Criar Tarefa:</h2>
            <form onSubmit={(e) => e.preventDefault()} className={styles.form}>
                <input
                    className={styles.input}
                    type="text"
                    placeholder="Digite um Título"
                    value={value}
                    onChange={(e) => setValue(e.target.value)}
                />
                <textarea
                    className={styles.textarea}
                    placeholder="Faça uma descrição da tarefa"
                    value={description}
                    onChange={(e) => setDescription(e.target.value)}
                />
                <button onClick={addTodo} className={styles.buttonTodo} disabled={loading}>
                    {loading ? "Adicionando..." : "Adicionar Tarefa"}
                </button>
                {error && <p className={styles.error}>{error}</p>}
            </form>
        </div>
    );
};

export default TodoForm;
