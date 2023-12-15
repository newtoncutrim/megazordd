import React from "react";
import styles from "./Login.module.css";

import { Link } from "@inertiajs/react";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms/Button";
import useForm from "@/Hooks/useForm";

const Login = () => {
    const email = useForm("email");
    const password = useForm("password");

    async function handleSubmit(event) {
        event.preventDefault();
        try {
            const response = await axios.post(
                "http://localhost:8989/api/auth/login",
                {
                    email: email.value,
                    password: password.value,
                }
            );

            console.log("Resposta do servidor:", response.data);
        } catch (error) {
            console.error("Erro na solicitação:", error.response.data);
        }
    }

    return (
        <div className={styles.loginContainer}>
            <section className={`animeLeft ${styles.login}`}>
                <div className={styles.form}>
                    <form onSubmit={handleSubmit}>
                        <h1 className="title">Login</h1>
                        <Input
                            label="Usuário :"
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
