import React, { useState } from "react";
import styles from "./Cadastro.module.css";
import Input from "../Forms/Input";
import Button from "../Forms/Button";
import { USER_POST } from "../../../Api/api";
import useForm from "@/Hooks/useForm";

const Login = () => {
    const name = useForm();
    const email = useForm("email");
    const password = useForm();

    async function handleSubmit(event) {
        event.preventDefault();

        const userData = {
            name: name.value,
            email: email.value,
            password: password.value,
        };
        const { url, options } = USER_POST(userData);
        const response = await fetch(url, options);
    }

    return (
        <main className={styles.cadastroContainer}>
            <div className={styles.cadastro}>
                <h1 className="title">Cadastre-se</h1>
                <form onSubmit={handleSubmit}>
                    <Input
                        label="Usuário: "
                        type="text"
                        name="name"
                        {...name}
                    />
                    <Input label="Email:" type="email" {...email} />
                    <Input label="Senha:" type="password" {...password} />
                    <Button />
                </form>
            </div>
        </main>
    );
};

export default Login;
