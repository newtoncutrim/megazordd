import React from "react";
import "./Login.css";

import FormCadastro from "./FormCadastro";
import FormEntrar from "./FormEntrar";

const Login = () => {
    const handleSignUpClick = () => {
        container.classList.add("right-panel-active");
    };

    const handleSignInClick = () => {
        container.classList.remove("right-panel-active");
    };

    return (
        <div>
            <div className="container" id="container">
                <div className="form-container sign-up-container">
                    <FormCadastro />
                </div>
                <div className="form-container sign-in-container">
                    <FormEntrar />
                </div>
                <div className="overlay-container">
                    <div className="overlay">
                        <div className="overlay-panel overlay-left">
                            <h1>Bem vindo de volta!</h1>
                            <p>
                                Para se manter conectado conosco, faça login com
                                suas informações pessoais
                            </p>
                            <button
                                onClick={handleSignInClick}
                                className="ghost"
                                id="signIn"
                            >
                                Entrar
                            </button>
                        </div>
                        <div className="overlay-panel overlay-right">
                            <h1>Olá amigo!</h1>
                            <p>
                                Insira seus dados pessoais e comece sua jornada
                                conosco
                            </p>
                            <button
                                onClick={handleSignUpClick}
                                className="ghost"
                                id="signUp"
                            >
                                Inscrever-se
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};
export default Login;
