import React from "react";
import { Link } from "react-router-dom";
import useForm from "@/Hooks/useForm";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms//Button";
import Error from "@/Components/Elements/Error";
import styles from "../../../css/LoginForm.module.css";

import stylesBtn from "../../../css/Button.module.css";

const LoginForm = () => {
    const email = useForm("email");
    const password = useForm();

    function handleSubmit(event) {
        event.preventDefault();
        fetch("http://localhost:8989/api/auth/login", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                email: email.value,
                password: password.value,
            }),
        })
            .then((response) => {
                console.log(response);
            })
            .catch((error) => {
                console.log(error.response.data);
            });
    }

    return (
        <section className="animeLeft">
            <h1 className="title">Login</h1>
            <form className={styles.form} onSubmit={handleSubmit}>
                <Input label="Email" type="email" name="email" {...email} />
                <Input
                    label="Senha"
                    type="password"
                    name="password"
                    {...password}
                />
                <Button>Entrar</Button>
                <Error />
            </form>
            <Link to="/login/perdeu" className={styles.perdeu}>
                Esqueceu a senha?
            </Link>
            <div className={styles.cadastro}>
                <h2 className={styles.subtitle}>Cadastre-se</h2>
                <p>Ainda não podia conta? Cadastre-se</p>
            </div>
            <Link to="/login/criar" className={stylesBtn.button}>
                Cadastro
            </Link>
        </section>
    );
};

export default LoginForm;
