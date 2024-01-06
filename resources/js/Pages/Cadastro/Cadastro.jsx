import React from "react";
import styles from "./Cadastro.module.css";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms/Button";
import useForm from "@/Hooks/useForm";
import { UserContext } from "@/UserContext";
import { FaEye, FaEyeSlash } from "react-icons/fa";


const Cadastro = () => {
    const name = useForm("name");
    const email = useForm("email");
    const password = useForm("password");
    const { userRegister, error, loading } = React.useContext(UserContext);

    const [passwordVisible, setPasswordVisible] = React.useState(false);

    const handleTogglePasswordVisibility = () => {
        setPasswordVisible((prev) => !prev);
    };

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
                        <div className={styles.passwordContainer}>
                            <Input
                                label="Senha"
                                type={passwordVisible ? "text" : "password"}
                                name="senha"
                                {...password}
                            />
                            <button
                                type="button"
                                className={styles.togglePasswordButton}
                                onClick={handleTogglePasswordVisibility}
                            >
                                {passwordVisible ? <FaEyeSlash /> : <FaEye />}
                            </button>
                        </div>
                        {error && <p className="error">{error}</p>}
                        {loading ? (
                            <Button disabled>Carregando...</Button>
                        ) : (
                            <Button>Cadastrar</Button>
                        )}
                    </form>
                </div>
            </section>
        </div>
    );
};

export default Cadastro;
