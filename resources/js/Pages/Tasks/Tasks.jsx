import React, { useState, useContext, useEffect } from "react";
import axios from "axios";
import styles from "./Tasks.module.css";
import TodoForm from "./Todo/TodoForm";
import Search from "./Todo/Search";
import Filter from "./Todo/Filter";
import { UserContext } from "@/UserContext";
import { IoExitOutline } from "react-icons/io5";

const Tasks = () => {
    const { getUserId, userLogout } = useContext(UserContext);
    const [tasks, setTasks] = useState([]);
    const [filter, setFilter] = useState("All");
    const [sort, setSort] = useState("Asc");
    const [search, setSearch] = useState("");

    const fetchTasks = async () => {
        const userId = await getUserId();
        const token = localStorage.getItem("token");
        if (token) {
            try {
                const response = await axios.get(
                    `http://localhost:8989/api/tasks`,
                    {
                      params: { user_id: userId },
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );
                console.log(response.data.data);
                setTasks(response.data.data);
            } catch (error) {
                console.error("Erro ao buscar tarefas do usuário", error);
            }
        } else {
          window.location.replace("/login");
        }
    };

    useEffect(() => {
        fetchTasks();
    }, []);

    return (
        <section className={styles.sectionTask}>
            <div className={styles.menuTask}>
                <TodoForm fetchTasks={fetchTasks} />
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
                        fetchTasks={fetchTasks}
                    />
                </div>
                <div className={styles.taskTodo}>
                    <div className={styles.todoList}>
                        {tasks.map((task) => (
                            <div key={task.id}>
                                <p>Title: {task.title}</p>
                                <p>Descrição: {task.description}</p>
                            </div>
                        ))}
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
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Tasks;
