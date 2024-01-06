import React from "react";
import axios from "axios";
import styles from "./TodoForm.module.css";
import { UserContext } from "@/UserContext";

const TodoForm = ({ addTodo }) => {
    const [value, setValue] = React.useState("");
    const [description, setDescription] = React.useState("");
    const [loading, setLoading] = React.useState(false);
    const [error, setError] = React.useState(null);

    const { getUserId } = React.useContext(UserContext);

    function addTodo () {
        if (value === "" || description === "") return;
        setLoading(true);
    }

    const handleSubmit = async (e) => {
        e.preventDefault();

        const userId = await getUserId();
        const token = localStorage.getItem("token");

        if (token) {
            try {
                setLoading(true);
                const response = await axios.post(
                    "http://localhost:8989/api/tasks",
                    { title: value, description: description, user_id: userId },
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );

                addTodo(value, description);
                setValue("");
                setDescription("");
                setError(null);
            } catch (error) {
                console.error("Erro ao criar tarefa", error);
                setError("Erro ao criar tarefa. Tente novamente.");
            } finally {
                setLoading(false);
            }
        }

        if (!value || !description || !userId) {
            setError("Por favor, preencha todos os campos.");
            return;
        } else {
            setError(null);
        }
    };

    return (
        <div className={styles.TodoForm}>
            <h2 className={styles.titleTask}>Criar Tarefa:</h2>
            <form onSubmit={handleSubmit} className={styles.form}>
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
                <button onClick={() => addTodo()} className={styles.buttonTodo} disabled={loading}>
                    {loading ? "+" : "+"}
                </button>
                {error && <p className={styles.error}>{error}</p>}
            </form>
        </div>
    );
};

export default TodoForm;
