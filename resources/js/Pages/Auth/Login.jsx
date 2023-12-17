import React from "react";
import styles from "./Login.module.css";
import { Link } from "@inertiajs/react";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms/Button";
import useForm from "@/Hooks/useForm";
import axios from "axios";

const Login = () => {
    const email = useForm("email");
    const password = useForm("password");

    async function getUser() {
        try {
            const token = localStorage.getItem("token");
            if (!token) {
                console.error("Token not found in localStorage");
                return;
            }

            const response = await axios.get("http://localhost:8989/api/user", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });
            // console.log("resposta getUser", response);

            if (response && response.data) {
                const user = response.data;
                console.log("User:", user);
            } else {
                console.error(response);
            }
        } catch (error) {
            console.error(error.message);
        }
    }

    async function handleSubmit(event) {
        event.preventDefault();
        if (email.validate() && password.validate()) {
            try {
                const response = await axios.post(
                    "http://localhost:8989/api/auth/login",
                    {
                        email: email.value,
                        password: password.value,
                    }
                );

                if (response && response.data && response.data.data) {
                    const { token } = response.data.data;
                    localStorage.setItem("token", token);

                    getUser(token);
                    console.log("Login bem-sucedido. Token:", token);
                } else {
                    console.error(
                        "Resposta do servidor não está no formato esperado:",
                        response
                    );
                }
            } catch (error) {
                console.error("Erro na solicitação:", error.message);
            }
        }
    }

    return (
        <div className={styles.loginContainer}>
            <section className={`animeLeft ${styles.login}`}>
                <div className={styles.form}>
                    <form onSubmit={handleSubmit}>
                        <h1 className="title">Login</h1>
                        <Input
                            label="Email :"
                            type="text"
                            name="email"
                            {...email}
                        />

                        <Input
                            label="Senha"
                            type="password"
                            name="senha"
                            {...password}
                        />
                        <Button>Entrar</Button>
                    </form>

                    <Link href="/recuperar " className={styles.perdeu}>
                        Perdeu a Senha ?
                    </Link>

                    <div className={styles.formCadastro}>
                        <h2 className="title">Cadastre-se</h2>
                        <p className={styles.paragrafo}>
                            Ainda não possui uma conta? Cadastre-se grátis{" "}
                        </p>
                        <Button>
                            <Link href="/cadastro ">Cadastro</Link>
                        </Button>
                    </div>
                </div>
            </section>
        </div>
    );
};

export default Login;
