import Input from "@/Components/Forms/Input";
import React from "react";
import { Link } from "react-router-dom";
import Button from "@/Components/Forms//Button";

const LoginForm = () => {
    const [username, setUsername] = React.useState("");
    const [password, setPassword] = React.useState("");

    function handleSubmit(event) {
        event.preventDefault();
        axios
            .post(
                "http://localhost:8989/api/users",
                {
                    username,
                    password,
                },
                {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                }
            )
            .then((response) => {
                console.log(response);
                return response.json();
            })
            .catch((error) => {
                console.error("Erro na solicitação:", error);
            });
    }

    return (
        <section>
            <h1>Login</h1>
            <form action="" onSubmit={handleSubmit}>
                <Input name="username" label="Usuário" type="text" />
                <Input label="Senha" type="password" name="password" />
                <Button>Entrar</Button>
            </form>
            <Link to="/login/criar">Cadastro</Link>
        </section>
    );
};

export default LoginForm;
