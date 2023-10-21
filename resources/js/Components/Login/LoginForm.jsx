import React from "react";
import { Link } from "react-router-dom";
import useForm from "@/Hooks/useForm";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms//Button";
import Error from "@/Components/Elements/Error";
import styles from "../../../css/LoginForm.module.css";

import stylesBtn from "../../../css/Button.module.css";

const LoginForm = () => {
    const username = useForm("email");
    const password = useForm("password");

    function handleSubmit(event) {
        event.preventDefault();
        axios
            .post(
                "http://localhost:8989/api/users",
                {
                    username: username.value,
                    password: password.value,
                },
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                }
            )
            .then((response) => {
                console.log(response);
                return response.json();
            })
            .catch((error) => {
                console.error("Erro na solicitação:", error);
            });
    }

    return (
        <section className="animeLeft">
            <h1 className="title">Login</h1>
            <form className={styles.form} onSubmit={handleSubmit}>
                <Input
                    name="username"
                    label="Usuário"
                    type="text"
                    {...username}
                />
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
