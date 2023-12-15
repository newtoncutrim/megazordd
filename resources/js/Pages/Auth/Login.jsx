import React from "react";
import styles from "./Login.module.css";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
import { Link } from "@inertiajs/react";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms/Button";

const Login = () => {
    const [username, setUsername] = React.useState("");
    const [password, setPassword] = React.useState("");

    function handleSubmit(event) {
        event.preventDefault();
    }

    return (
        <div>
            <Header />
            <section className={`animeLeft ${styles.login}`}>
                <div className={styles.form}>
                    <form onSubmit={handleSubmit}>
                        <h1 className="title">Login</h1>
                        <Input label="Usuário : " name={username} type="text" />
                        <Input
                            label="Senha : "
                            type="password"
                            name={password}
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
            <Footer />
        </div>
    );
};

export default Login;
