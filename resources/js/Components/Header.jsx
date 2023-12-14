import React from "react";
import styles from "./Header.module.css";
import { Link } from "@inertiajs/react";
import Logo from "../../img/MdiChartDonut.svg";

const Header = () => {
    return (
        <header className={`container ${styles.header}`}>
            <Link href="/" method="get">
                <img src={Logo} alt="Logo" />
            </Link>

            <nav className={styles.nav}>
                <ul>
                    <li className={styles.links}>
                        <Link href="/login" method="get">
                            Login / Criar
                        </Link>
                    </li>
                </ul>
            </nav>
        </header>
    );
};

export default Header;
