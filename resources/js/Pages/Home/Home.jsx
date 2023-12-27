import React from "react";
import styles from "./Home.module.css";
import Image from "../../../img/foto-home.jpg";

const Home = () => {
    return (
        <div>
            <section className={`container ${styles.home}`}>
                <div className={styles.homeContent}>
                    <h1 className={styles.titleHome}>
                        TaskHub<span className={styles.span}>.</span>
                    </h1>
                    <p className={styles.subTitleHome}>
                        Gerencie suas tarefas aqui{" "}
                    </p>
                    <button
                        type="button"
                        className={`btn btn-primary ${styles.btnPrimary}`}
                        onClick={() => {
                            window.location = "login";
                        }}
                    >
                        Entrar ou Cadastrar
                    </button>
                </div>

                <div className={styles.homeImage}>
                    <img src={Image} alt="Imagem Home" />
                </div>
            </section>
        </div>
    );
};

export default Home;
