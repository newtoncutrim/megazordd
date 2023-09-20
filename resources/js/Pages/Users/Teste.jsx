import React from "react";
import "./Teste.css";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faFacebookF,
    faGooglePlusG,
    faLinkedinIn,
} from "@fortawesome/free-brands-svg-icons";

const Teste = () => {
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
                    <form action="#">
                        <h1>Criar uma conta</h1>
                        <div className="social-container">
                            <a href="#" className="social">
                                <FontAwesomeIcon icon={faFacebookF} />
                            </a>
                            <a href="#" className="social">
                                <FontAwesomeIcon icon={faGooglePlusG} />
                            </a>
                            <a href="#" className="social">
                                <FontAwesomeIcon icon={faLinkedinIn} />
                            </a>
                        </div>
                        <span>ou use seu e-mail para cadastro</span>
                        <input type="text" placeholder="Name" />
                        <input type="email" placeholder="Email" />
                        <input type="password" placeholder="Password" />
                        <button onClick={handleSignInClick}>
                            Inscrever-se
                        </button>
                    </form>
                </div>
                <div className="form-container sign-in-container">
                    <form action="#">
                        <h1>Entrar</h1>
                        <div className="social-container">
                            <a href="#" className="social">
                                <FontAwesomeIcon icon={faFacebookF} />
                            </a>
                            <a href="#" className="social">
                                <FontAwesomeIcon icon={faGooglePlusG} />
                            </a>
                            <a href="#" className="social">
                                <FontAwesomeIcon icon={faLinkedinIn} />
                            </a>
                        </div>
                        <span>ou use sua conta</span>
                        <input type="email" placeholder="Email" />
                        <input type="password" placeholder="Password" />
                        <a href="#">Esqueceu sua senha?</a>
                        <button onClick={handleSignUpClick}>Entrar</button>
                    </form>
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
export default Teste;
