import React from "react";
import styles from "./Cadastro.module.css";
import Input from "../../Components/Forms/Input";
import Button from "../../Components/Forms/Button";
import useForm from "@/Hooks/useForm";
import axios from "axios";

const Cadastro = () => {
    const name = useForm();
    const email = useForm("email");
    const password = useForm();

    async function handleSubmit(event) {
        event.preventDefault();
    }
    return (
        <section className={styles.cadastroContainer}>
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
                    <Button>Cadastrar</Button>
                </form>
            </div>
        </section>
    );
};

export default Cadastro;
