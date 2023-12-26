import React from "react";
import styles from "./Tasks.module.css";
import { useState } from "react";
import Todo from "./Todo/Todo";
import TodoForm from "./Todo/TodoForm";
import Search from "./Todo/Search";
import Filter from "./Todo/Filter";

import { UserContext } from "@/UserContext";
import { Link } from "@inertiajs/react";

const Tasks = () => {
    const { data, userLogout } = React.useContext(UserContext);

    const [todos, setTodos] = useState([
        {
            id: 1,
            text: "Criar funcionalidades",
            category: "Trabalho",
            isCompleted: false,
        },
        {
            id: 2,
            text: "Ir para a academia",
            category: "Pessoal",

            isCompleted: false,
        },
        {
            id: 3,
            text: "Estudar React",
            category: "Pessoal",

            isCompleted: false,
        },
    ]);

    const [search, setSearch] = useState("");

    const [filter, setFilter] = useState("All");
    const [sort, setSort] = useState("Asc");
    // função cria um novo array com id aleatório
    const addTodo = (text, category) => {
        const newTodos = [
            ...todos,
            {
                id: Math.floor(Math.random() * 1000),
                text,
                category,
                isCompleted: false,
            },
        ];

        setTodos(newTodos);
    };

    // função para remover tarefas
    const removeTodos = (id) => {
        const newTodos = [...todos];
        const filteredTodos = newTodos.filter((todo) =>
            todo.id !== id ? todo : null
        );
        setTodos(filteredTodos);
    };

    // função para completar tarefa
    const completeTodo = (id) => {
        const newTodos = [...todos];
        newTodos.map((todo) =>
            todo.id === id ? (todo.isCompleted = !todo.isCompleted) : todo
        );
        setTodos(newTodos);
    };
    return (
        <section className={styles.sectionTask}>
            <div className={styles.menuTask}>
                <h2>Menu lateral</h2>
                <li className={styles.links}>
                    {data ? (
                        <Link href="/login" method="post">
                            {data.name}
                            <button onClick={userLogout}>Sair</button>
                        </Link>
                    ) : (
                        <Link href="/login" method="get">
                            Login / Criar
                        </Link>
                    )}
                </li>
            </div>
            <div className={styles.contentTask}>
                <div className={styles.tituloContentTask}>
                    <h2>
                        Bem Vindo {data && data.name} a sua página de tarefas!!{" "}
                    </h2>
                    <Search search={search} setSearch={setSearch} />
                </div>
                <div className={styles.taskTodo}>
                <TodoForm addTodo={addTodo} />
                    <Filter
                        filter={filter}
                        setFilter={setFilter}
                        setSort={setSort}
                    />
                    <div className={styles.todoList}>
                        {todos
                            .filter((todo) =>
                                filter === "All"
                                    ? true
                                    : filter === "Completed"
                                    ? todo.isCompleted
                                    : !todo.isCompleted
                            )
                            .filter((todo) =>
                                todo.text
                                    .toLowerCase()
                                    .includes(search.toLowerCase())
                            )
                            .sort((a, b) =>
                                sort === "Asc"
                                    ? a.text.localeCompare(b.text)
                                    : b.text.localeCompare(a.text)
                            )
                            .map((todo) => (
                                <Todo
                                    key={todo.id}
                                    todo={todo}
                                    removeTodos={removeTodos}
                                    completeTodo={completeTodo}
                                />
                            ))}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Tasks;
