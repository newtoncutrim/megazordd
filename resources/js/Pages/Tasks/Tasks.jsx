import React from "react";
import styles from "./Tasks.module.css";

const Tasks = () => {
    return (
        <section className={styles.taskSection}>
            <div className={styles.menuLateral}>
                <h2>Menu lateral</h2>
                <ul>
                    <li>Item 1</li>
                    <li>Item 2</li>
                </ul>
            </div>
            <div>
                <p>Ola,[Nome do usuário] , Bem vindo às suas tarefas</p>
            </div>
        </section>
    );
};

export default Tasks;
