import React from "react";
import styles from "../Components/Footer.module.css";

const Footer = () => {
    return (
        <div className={styles.footer}>
            <p className={styles.copy}>
                &copy; 2023 Kriks. Todos os direitos reservados.
            </p>
        </div>
    );
};

export default Footer;
