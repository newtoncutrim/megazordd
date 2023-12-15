import React from "react";
import styles from "./Cadastro.module.css";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms/Button";
import useForm from "@/Hooks/useForm";
import axios from "axios";

const Cadastro = () => {
    const name = useForm();
    const email = useForm("email");
    const password = useForm("password");

    async function handleSubmit(event) {
        event.preventDefault();

        try {
            const userData = {
                name: name.value,
                email: email.value,
                password: password.value,
            };

            const response = await axios.post(
                "http://localhost:8989/api/users",
                userData
            );

            console.log("Resposta do servidor:", response.data);
        } catch (err) {
            console.error("Erro na solicitação:", err.response.data);
        }
    }
    return (
        <div className={styles.cadastroContainer}>
            <section className={`animeLeft ${styles.cadastroSection}`}>
                <div className={styles.cadastroForm}>
                    <h1 className="title">Cadastre-se</h1>
                    <form onSubmit={handleSubmit}>
                        <Input
                            label="Usuário"
                            type="text"
                            name="name"
                            {...name}
                        />
                        <Input
                            label="Email"
                            type="email"
                            name="email"
                            {...email}
                        />
                        <Input
                            label="Senha"
                            type="password"
                            name="senha"
                            {...password}
                        />
                        <Button>Cadastrar</Button>
                    </form>
                </div>
            </section>
        </div>
    );
};

export default Cadastro;
