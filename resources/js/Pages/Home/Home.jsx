import React from "react";
import styles from "./Home.module.css";

const Home = () => {
    return (
        <div>
            <section className={`container ${styles.home}`}>
                <h1 className={styles.titleHome}>
                    TaskHub<span className={styles.span}>.</span>
                </h1>
                <p className={styles.subTitleHome}>Gerencie suas tarefas </p>
            </section>
        </div>
    );
};

export default Home;
