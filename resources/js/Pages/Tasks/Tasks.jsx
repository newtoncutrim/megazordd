import React, { useState, useContext, useEffect } from "react";
import axios from "axios";
import styles from "./Tasks.module.css";
import TodoForm from "./Todo/TodoForm";
import Search from "./Todo/Search";
import Filter from "./Todo/Filter";
import { UserContext } from "@/UserContext";
import { IoExitOutline } from "react-icons/io5";
import { FaCheck, FaTrashAlt, FaPencilAlt } from "react-icons/fa";

const Tasks = () => {
    const { getUserId, userLogout } = useContext(UserContext);
    const [tasks, setTasks] = useState([]);
    const [filter, setFilter] = useState("All");
    const [sort, setSort] = useState("Asc");
    const [search, setSearch] = useState("");
    const [editingTaskId, setEditingTaskId] = useState(null);

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


                 // Mapeia as tarefas do servidor e adiciona a propriedade "completed" para fins de estilo
                 const tasksWithCompletionStatus = response.data.data.map((task) => ({
                    ...task,
                    completed: task.finished, // ou qualquer outra lógica que você estiver usando
                }));

                setTasks(tasksWithCompletionStatus);

                
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

    // função para deletar tarefa
    const deleteTaskUser = async (taskId) => {
        const token = localStorage.getItem("token");

        const shouldDelete = window.confirm(
            "Tem certeza que deseja apagar a tarefa?"
        );

        if (token && shouldDelete) {
            try {
                const response = await axios.delete(
                    `http://localhost:8989/api/tasks/${taskId}`,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );
                setTasks((prevTasks) =>
                    prevTasks.filter((task) => task.id !== taskId)
                );
            } catch (error) {
                console.error("Erro ao excluir tarefa:", error);
            }
        }
    };

    // função para executar edição da tarefa
    const handleEditInputChange = (e, taskId, field) => {
        setTasks((prevTasks) =>
            prevTasks.map((task) =>
                task.id === taskId ? { ...task, [field]: e.target.value } : task
            )
        );
    };
    // função para salvar tarefa editada
    const saveEditedTask = async (taskId) => {
        const token = localStorage.getItem("token");
        const editedTask = tasks.find((task) => task.id === taskId);

        if (token) {
            try {
                const response = await axios.put(
                    `http://localhost:8989/api/tasks/${taskId}`,
                    {
                        title: editedTask.title,
                        description: editedTask.description,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );
                setEditingTaskId(null);
            } catch (error) {
                console.error("Erro ao salvar a tarefa editada:", error);
            }
        }
    };

    // função para cancelar edição
    const cancelEdit = () => {
        setEditingTaskId(null);
    };

    // Função para marcar a tarefa como completa
    // Função para marcar a tarefa como completa
const completedTaskUser = async (taskId) => {
    const token = localStorage.getItem("token");
    const completedTask = tasks.find((task) => task.id === taskId);

    if (token) {
        try {
            const response = await axios.put(
                `http://localhost:8989/api/tasks/${taskId}`,
                {
                    title: completedTask.title,
                    description: completedTask.description,
                    finished: true,
                },
                {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                }
            );

            console.log(response.data.data);

            // Atualiza o estado local de tarefas
            setTasks((prevTasks) =>
                prevTasks.map((task) =>
                    task.id === taskId
                        ? {
                              ...task,
                              finished: true,
                              completed: !task.completed,
                          }
                        : task
                )
            );

            // Obtém as tarefas do localStorage
            const tasksFromLocalStorage = JSON.parse(localStorage.getItem("tasks")) || [];

            // Atualiza o estado local e o localStorage com as tarefas modificadas
            const updatedTasks = tasksFromLocalStorage.map((task) =>
                task.id === taskId
                    ? {
                          ...task,
                          finished: true,
                          completed: !task.completed,
                      }
                    : task
            );

            localStorage.setItem("tasks", JSON.stringify(updatedTasks));

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
                                    {editingTaskId === task.id ? (
                                        // Formulário de edição
                                        <div>
                                            <input
                                                className={styles.input}
                                                type="text"
                                                value={task.title}
                                                onChange={(e) =>
                                                    handleEditInputChange(
                                                        e,
                                                        task.id,
                                                        "title"
                                                    )
                                                }
                                            />
                                            <textarea
                                                className={styles.textarea}
                                                type="text"
                                                value={task.description}
                                                onChange={(e) =>
                                                    handleEditInputChange(
                                                        e,
                                                        task.id,
                                                        "description"
                                                    )
                                                }
                                            />
                                            <div className={styles.divEdit}>
                                                <button
                                                    onClick={() =>
                                                        saveEditedTask(task.id)
                                                    }
                                                >
                                                    Salvar
                                                </button>
                                                <button
                                                    onClick={() => cancelEdit()}
                                                >
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    ) : (
                                        // Visualização padrão
                                        <div className={styles.taskContent}>
                                            <h2>Título: {task.title}</h2>
                                            <p>Descrição: {task.description}</p>
                                        </div>
                                    )}
                                </div>
                                <div>
                                    <button
                                        className={styles.edit}
                                        onClick={() =>
                                            setEditingTaskId(task.id)
                                        }
                                    >
                                        <FaPencilAlt />
                                    </button>
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
