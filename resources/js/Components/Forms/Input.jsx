import React from "react";
import styles from "../../../css/Input.module.css";

const Input = ({ label, type, name }) => {
    return (
        <div>
            <label htmlFor={name}>{label}</label>
            <input id={name} name={name} className={styles.input} type={type} />
        </div>
    );
};

export default Input;
