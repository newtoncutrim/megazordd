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
               
            </div> */}
        </div>
    );
};

export default Todo;


         {/* {tasks
              .filter((task) =>
                filter === "All"
                  ? true
                  : filter === "Completed"
                  ? task.isCompleted
                  : !task.isCompleted
              )
              .filter((task) =>
                task.text.toLowerCase().includes(search.toLowerCase())
              )
              .sort((a, b) =>
                sort === "Asc"
                  ? a.text.localeCompare(b.text)
                  : b.text.localeCompare(a.text)
              )
              .map((task) => (
                <Todo
                  key={task.id}
                  todo={task}
                  removeTodos={() => removeTodos(task.id)}
                  completeTodo={() => completeTodo(task.id)}
                />
              ))} */}