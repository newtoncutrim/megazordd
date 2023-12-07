import React from "react";
import styles from "../Components/Header.module.css";
import MdiChartDonut from "../../img/MdiChartDonut.svg";
import { Link } from "react-router-dom";

const Header = () => {
    return (
        <header className={styles.header}>
            <nav className={styles.nav}>
                <Link to="/" aria-label="Soul - Home">
                    <img className={styles.svg} src={MdiChartDonut} alt="" />
                </Link>
                <Link to="/login">Login / Criar</Link>
            </nav>
        </header>
    );
};

export default Header;
