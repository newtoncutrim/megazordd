import React, { useState, useContext, useEffect } from "react";
import axios from "axios";
import styles from "./Tasks.module.css";
import TodoForm from "./Todo/TodoForm";
import Search from "./Todo/Search";
import Filter from "./Todo/Filter";
import { UserContext } from "@/UserContext";
import { IoExitOutline } from "react-icons/io5";
import { FaCheck, FaTrashAlt } from "react-icons/fa";

const Tasks = () => {
    const { getUserId, userLogout } = useContext(UserContext);
    const [tasks, setTasks] = useState([]);
    const [filter, setFilter] = useState("All");
    const [sort, setSort] = useState("Asc");
    const [search, setSearch] = useState("");

    const fetchTasksUser = async () => {
        const userId = await getUserId();
        const token = localStorage.getItem("token");

        if (token) {
            try {
                const response = await axios.get(
                    `http://localhost:8989/api/user/${userId}/tasks`,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );

                setTasks(response.data.data);
            } catch (error) {
                if (error.response) {
                    console.error(
                        "Erro na resposta do servidor:",
                        error.response.data
                    );
                } else if (error.request) {
                    console.error("Erro na requisição:", error.request);
                } else {
                    console.error("Erro desconhecido:", error.message);
                }
            }
        } else {
            window.location.replace("/login");
        }
    };

    useEffect(() => {
        fetchTasksUser();
    }, []);

    const deleteTaskUser = async (taskId) => {
        const userId = await getUserId();
        const token = localStorage.getItem("token");

        alert("Apagar tarefa?");

        if (token) {
            try {
                const response = await axios.delete(
                    `http://localhost:8989/api/tasks/${taskId}`,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );

                console.log(response);

                setTasks((prevTasks) =>
                    prevTasks.filter((task) => task.id !== taskId)
                );
            } catch (error) {
                console.error("Erro ao excluir tarefa:", error);
            }
        }
    };

    const completedTaskUser = async (taskId) => {
        const userId = await getUserId();
        const token = localStorage.getItem("token");
    
        if (token) {
            try {
                const response = await axios.put(
                    `http://localhost:8989/api/tasks/${taskId}`,
                    null,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );
    
                console.log(response.data.data);
    
                setTasks((prevTasks) =>
                    prevTasks.map((task) =>
                        task.id === taskId ? { ...task, completed: true } : task
                    )
                );
            } catch (error) {
                console.error(error);
            }
        }
    };

    return (
        <section className={styles.sectionTask}>
            <div className={styles.menuTask}>
                <TodoForm fetchTasksUser={fetchTasksUser} />
                <Filter
                    filter={filter}
                    setFilter={setFilter}
                    sort={sort}
                    setSort={setSort}
                />
                <p>Sair :</p>
                <IoExitOutline
                    className={styles.iconeSair}
                    onClick={userLogout}
                />
            </div>

            <div className={styles.contentTask}>
                <div className={styles.tituloContentTask}>
                    <Search
                        search={search}
                        setSearch={setSearch}
                        fetchTasksUser={fetchTasksUser}
                    />
                </div>
                <div className={styles.taskTodo}>
                    <div className={styles.taskList}>
                        {tasks.map((task) => (
                            <div
                                key={task.id}
                                className={`${styles.tasksUser} ${
                                    task.completed ? styles.completedTask : ""
                                }`}
                            >
                                <div className={styles.taskContent}>
                                    <h2>Título: {task.title}</h2>
                                    <p>Descrição: {task.description}</p>
                                </div>
                                <div>
                                    <button
                                        className={styles.completed}
                                        onClick={() =>
                                            completedTaskUser(task.id)
                                        }
                                    >
                                        <FaCheck />
                                    </button>
                                    <button
                                        className={styles.remove}
                                        onClick={() => deleteTaskUser(task.id)}
                                    >
                                        <FaTrashAlt />
                                    </button>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Tasks;
