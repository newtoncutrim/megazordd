// Header.js
import React from "react";
import styles from "./Header.module.css";
import { Link } from "@inertiajs/react";

const Header = () => {
    return (
        <header className={styles.header}>
            <h1>Header</h1>
            <nav>
                <ul>
                    <li>
                        <Link to="/login">Login</Link>
                    </li>
                </ul>
            </nav>
        </header>
    );
};

export default Header;
