import React, { useState } from "react";
import styles from "./Login.module.css";
import Input from "../Forms/Input";
import Button from "../Forms/Button";
import { LOGIN_POST } from "../../../Api/api";

const Login = () => {
    const [name, setName] = React.useState("");
    const [password, setPassword] = useState("");

    const handleSubmit = async (event) => {
        event.preventDefault();

        const loginData = {
            name,
            password,
        };

        const { url, options } = LOGIN_POST(loginData);

        try {
            const response = await fetch(url, options);

            if (response.ok) {
                const data = await response.json();
                console.log("Token de acesso:", data.access_token);
            } else {
                console.error(
                    "Erro ao fazer login:",
                    response.status,
                    response.statusText
                );
            }
        } catch (error) {
            console.error("Erro na solicitação:", error);
        }
    };

    return (
        <section className={styles.loginContainer}>
            <div className={styles.login}>
                <h1 className="title">Login</h1>
                <form onSubmit={handleSubmit}>
                    <Input
                        label="Usuário: "
                        type="text"
                        placeholder="Digite o usuário"
                        name="username"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />
                    <Input
                        label="Senha: "
                        type="password"
                        name="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                    <Button>Entrar</Button>
                </form>
            </div>
        </section>
    );
};

export default Login;
