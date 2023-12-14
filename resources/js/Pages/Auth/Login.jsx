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
            <section className={styles.login}>
                <h1>Login</h1>
                <form onSubmit={handleSubmit}>
                    <Input
                        type="text"
                        onChange={({ target }) => setUsername(target.value)}
                        value={username}
                    />
                    <Input
                        type="password"
                        onChange={({ target }) => setPassword(target.value)}
                        value={password}
                    />
                    <Button>Entrar</Button>
                </form>
                <Link href="/cadastro ">Login Create</Link>
            </section>
            <Footer />
        </div>
    );
};

export default Login;
