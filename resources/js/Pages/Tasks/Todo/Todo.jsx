import React, { useEffect, useState } from "react";
// import axios from "axios";
// import styles from "./Todo.module.css";
// import { UserContext } from "@/UserContext";

const Todo = ({ todo, removeTodos, completeTodo }) => {
    // const [taskDetails, setTaskDetails] = useState(null);
    // const { getUserId } = React.useContext(UserContext);

    // React.useEffect(() => {
    //     const fetchTaskDetails = async () => {
    //         const userId = await getUserId();
    //         console.log("Id:", userId);
    //         const token = localStorage.getItem("token");
    //         console.log("Token:", token);

    //         try {
    //             const response = await axios.get(
    //                 `http://localhost:8989/api/tasks/user/${userId}`
    //             );
    //             setTaskDetails(response.data);
    //         } catch (error) {
    //             console.error("Erro ao buscar detalhes da tarefa", error);
    //         }
    //     };

    //     fetchTaskDetails();
    // }, [getUserId]);

    return (
        <div>
            {/* <div
                className={styles.todo}
                style={{
                    textDecoration: todo.isCompleted ? "line-through" : "",
                }}
            >
                <div className={styles.content}>
                    <p>{todo.text}</p>
                    <p>({todo.category})</p>
                    {taskDetails && (
                        <p>Detalhes da Tarefa: {taskDetails.description}</p>
                    )}
                </div>
                <div>
                    <button
                        className={styles.complete}
                        onClick={() => completeTodo(todo.id)}
                    >
                        Completar
                    </button>
                    <button
                        className={styles.remove}
                        onClick={() => removeTodos(todo.id)}
                    >
                        x
                    </button>
                </div>
            </div> */}
        </div>
    );
};

export default Todo;
