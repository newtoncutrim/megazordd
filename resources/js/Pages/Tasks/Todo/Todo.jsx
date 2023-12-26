import React from "react";
import styles from './Todo.module.css'

const Todo = ({ todo, removeTodos, completeTodo }) => {
  return (
    <div>
      <div
        className={styles.todo}
        style={{ textDecoration: todo.isCompleted ? "line-through" : "" }}
      >
        <div   className={styles.content}>
          <p>{todo.text}</p>
          <p>({todo.category})</p>
        </div>
        <div>
          <button className={styles.complete} onClick={() => completeTodo(todo.id)}>
            Completar
          </button>
          <button className={styles.remove} onClick={() => removeTodos(todo.id)}>
            x
          </button>
        </div>
      </div>
    </div>
  );
};

export default Todo;
