import React, { useState, useContext } from "react";
import styles from "./Tasks.module.css";
import Todo from "./Todo/Todo";
import TodoForm from "./Todo/TodoForm";
import Search from "./Todo/Search";
import Filter from "./Todo/Filter";

import { UserContext } from "@/UserContext";

import { IoExitOutline } from "react-icons/io5";

const Tasks = () => {
    const { data, userLogout } = useContext(UserContext);

    const [filter, setFilter] = useState("All");
    const [sort, setSort] = useState("Asc");
    const [search, setSearch] = useState("");

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

    // Função cria um novo array com id aleatório
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

    // Função para remover tarefas
    const removeTodos = (id) => {
        const newTodos = todos.filter((todo) => todo.id !== id);
        setTodos(newTodos);
    };

    // Função para completar tarefa
    const completeTodo = (id) => {
        const newTodos = todos.map((todo) =>
            todo.id === id ? { ...todo, isCompleted: !todo.isCompleted } : todo
        );
        setTodos(newTodos);
    };

    // função para pesquisar uma tarefa
    function handleSearch() {
        console.log("realizando pesquisando");
    }

    return (
        <section className={styles.sectionTask}>
            <div className={styles.menuTask}>
                <TodoForm addTodo={addTodo} />
                <Filter
                        filter={filter}
                        setFilter={setFilter}
                        sort={sort}
                        setSort={setSort}
                    />
                    <p>Sair :</p>
                    <IoExitOutline  className={styles.iconeSair} onClick={userLogout} />
            </div>

            <div className={styles.contentTask}>
                <div className={styles.tituloContentTask}>
                    <Search
                        search={search}
                        setSearch={setSearch}
                        handleSearch={handleSearch}
                    />
                   
                </div>
                <div className={styles.taskTodo}>
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
