import React from "react";
import styles from "./Cadastro.module.css";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms/Button";
import useForm from "@/Hooks/useForm";
import { UserContext } from "@/UserContext";

const Cadastro = () => {
    const name = useForm("name");
    const email = useForm("email");
    const password = useForm("password");
    const { userRegister, error, loading } = React.useContext(UserContext);

    async function handleSubmit(event) {
        event.preventDefault();

        if (name.validate() && email.validate() && password.validate()) {
            userRegister(name, email, password);
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
                        {error && <p className="error">{error}</p>}
                        <Button>Cadastrar</Button>
                    </form>
                </div>
            </section>
        </div>
    );
};

export default Cadastro;
