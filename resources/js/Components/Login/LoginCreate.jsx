import React from "react";
import Input from "@/Components/Forms/Input";
import Button from "@/Components/Forms/Button";
import useForm from "@/Hooks/useForm";

const LoginCreate = () => {
    const username = useForm();
    const email = useForm("email");
    const password = useForm();

    function handleSubmit(event) {
        event.preventDefault();
        fetch("http://localhost:8989/api/users", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                name: username,
                email: email,
                password: password,
            }),
        })
            .then((response) => {
                console.log(response);
                return response.json();
            })
            .then((json) => {
                console.log(json);
                return json;
            });
        // console.log({ username: username, email: email, password: password });
    }

    return (
        <section className="animeLeft">
            <h1 className="title">Cadastre-se</h1>
            <form onSubmit={handleSubmit}>
                <Input
                    label="Usuário"
                    type="text"
                    name="username"
                    {...username}
                />
                <Input label="Email" type="email" name="email" {...email} />
                <Input
                    label="Senha"
                    type="password"
                    name="password"
                    {...password}
                />
                <Button>Cadastrar</Button>
            </form>
        </section>
    );
};

export default LoginCreate;
