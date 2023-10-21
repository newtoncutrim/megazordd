import React from "react";
import { Route, Routes } from "react-router-dom";
import LoginForm from "./LoginForm";
import LoginCreate from "./LoginCreate";
import LoginPasswordLost from "./LoginPasswordLost";
import LoginPasswordReset from "./LoginPasswordReset";
import styles from "../../../css/Login.module.css";

const Login = () => {
    return (
        <section className={styles.login}>
            <div className={styles.forms}>
                <Routes>
                    <Route path="/" element={<LoginForm />}></Route>
                    <Route path="/criar" element={<LoginCreate />}></Route>
                    <Route
                        path="/perdeu"
                        element={<LoginPasswordLost />}
                    ></Route>
                    <Route
                        path="/resetar"
                        element={<LoginPasswordReset />}
                    ></Route>
                </Routes>
            </div>
        </section>
    );
};

export default Login;
