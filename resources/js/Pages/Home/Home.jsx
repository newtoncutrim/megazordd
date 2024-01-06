import React from "react";
import { Link } from "@inertiajs/react";
import styles from "./Home.module.css";

const Home = () => {

    return (
        <div className={styles.homeSection}>
            <section className={`container ${styles.home}`}>
                <div className={styles.homeContent}>
                    <h1 className={styles.titleHome}>
                        TaskHub<span className={styles.span}>.</span>
                    </h1>
                    <p className={styles.subTitleHome}>
                        Gerencie suas tarefas aqui{" "}
                    </p>
                        <Link href="/login" method="get">
                            <button type="button" className={styles.btnPrimary}>
                                Entrar ou Cadastrar
                            </button>
                        </Link>
                </div>
            </section>
        </div>
    );
};

export default Home;
