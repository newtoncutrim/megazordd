import React from "react";
import { Link } from "@inertiajs/react";
import { UserContext } from "@/UserContext";
import styles from "./Home.module.css";

const Home = () => {
    const { error, loading } = React.useContext(UserContext);

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
                    {loading ? (
                        <button disabled>Carregando...</button>
                    ) : (
                        <Link href="/login" method="get">
                            <button type="button" className={styles.btnPrimary}>
                                Entrar ou Cadastrar
                            </button>
                        </Link>
                    )}
                    {error && <p className="error">{error}</p>}
                </div>
            </section>
        </div>
    );
};

export default Home;
