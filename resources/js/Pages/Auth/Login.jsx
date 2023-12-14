import React from "react";
import styles from "./Login.module.css";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
import { Link } from "@inertiajs/react";

const Login = () => {
    return (
        <div>
            <Header />
            <section className={styles.login}>
                <h1>Login</h1>
                <Link href="/cadastro ">Login Create</Link>
            </section>
            <Footer />
        </div>
    );
};

export default Login;
