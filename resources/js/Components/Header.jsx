import React from "react";
import styles from "../../css/Header.module.css";
import { Link } from "react-router-dom";

const Header = () => {
    return (
        <header className={styles.header}>
            <nav className={`${styles.nav} container`}>
                <Link to="/" aria-label="Home" className={styles.logo}>
                    GN
                </Link>
                <Link className={styles.login} to="/login">
                    Login / Criar
                </Link>
            </nav>
        </header>
    );
};

export default Header;
