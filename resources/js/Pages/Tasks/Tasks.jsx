import React from "react";
import styles from "./Tasks.module.css";

const Tasks = () => {
    return (
        <section className={styles.sectionTask}>
            <div className={styles.menuLateral}>
                <h2>Menu lateral</h2>
            </div>
            <div className={styles.conteudo}>
                <h2>Conteudo</h2>
            </div>
           
        </section>

    );
};

export default Tasks;
