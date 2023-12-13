import Footer from "@/Components/Footer";
import Header from "@/Components/Header";
import React from "react";

const Cadastro = () => {
    function handleSubmit(event) {
        event.preventDefault();
        console.log("cadastrou");
    }

    return (
        <section>
            <Header />
            <div>
                <h1>Cadastro</h1>
                <form onSubmit={handleSubmit}>
                    <label>
                        Name:
                        <input type="text" name="name" />
                    </label>
                    <br />
                    <label>
                        Email:
                        <input type="email" name="email" />
                    </label>
                    <br />
                    <label>
                        Senha:
                        <input type="password" name="password" />
                    </label>
                    <br />
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
            <Footer />
        </section>
    );
};

export default Cadastro;
