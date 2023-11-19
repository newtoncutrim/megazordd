import React, { useState } from "react";
import styles from "./Login.module.css";
import Input from "../Forms/Input";
import Button from "../Forms/Button";
import { USER_POST } from "../../../Api/Api";

const Login = () => {
    const [name, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    async function handleSubmit(event) {
        event.preventDefault();

        const userData = {
            name,
            email,
            password,
        };

        console.log("Dados a serem enviados", userData);

        const { url, options } = USER_POST(userData);

        try {
            const response = await fetch(url, options);

            if (!response.ok) {
                if (response.status === 422) {
                    const errorData = await response.json();
                    console.error("Erro de validação:", errorData);
                } else {
                    console.error("Erro na solicitação:", response);
                }
            } else {
                console.log("Resposta bem-sucedida:", response);
            }
        } catch (error) {
            console.error("Erro na solicitação:", error);
        }
    }

    return (
        <main className={styles.loginContainer}>
            <div className={styles.login}>
                <h1 className="title">Cadastre-se</h1>
                <form onSubmit={handleSubmit}>
                    <Input
                        label="Usuário: "
                        type="text"
                        name="name"
                        value={name}
                        onChange={(e) => setUsername(e.target.value)}
                    />
                    <Input
                        label="Email:"
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                    <Input
                        label="Senha:"
                        type="password"
                        placeholder="Password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                    <Button />
                </form>
            </div>
        </main>
    );
};

export default Login;
