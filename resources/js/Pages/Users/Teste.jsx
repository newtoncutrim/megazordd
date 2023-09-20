import React from "react";
import "./Teste.css";

// const signUpButton = document.getElementById("signUp");
// const signInButton = document.getElementById("signIn");
// const container = document.getElementById("container");

// signUpButton.addEventListener("click", () => {
//     container.classList.add("right-panel-active");
// });

// signInButton.addEventListener("click", () => {
//     container.classList.remove("right-panel-active");
// });

const Teste = () => {
    function handleClick(event) {
        console.log(event.target);
    }
    return (
        <div>
            <div class="container" id="container">
                <div class="form-container sign-up-container">
                    <form action="#">
                        <h1>Criar uma conta</h1>
                        <div class="social-container">
                            <a href="#" class="social">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                            <a href="#" class="social">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                        <span>ou use seu e-mail para cadastro</span>
                        <input type="text" placeholder="Name" />
                        <input type="email" placeholder="Email" />
                        <input type="password" placeholder="Password" />
                        <button>Inscrever-se</button>
                    </form>
                </div>
                <div class="form-container sign-in-container">
                    <form action="#">
                        <h1>Entrar</h1>
                        <div class="social-container">
                            <a href="#" class="social">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                            <a href="#" class="social">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                        <span>ou use sua conta</span>
                        <input type="email" placeholder="Email" />
                        <input type="password" placeholder="Password" />
                        <a href="#">Esqueceu sua senha?</a>
                        <button onClick={handleClick}>Entrar</button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1>Bem vindo de volta!</h1>
                            <p>
                                Para se manter conectado conosco, faça login com
                                suas informações pessoais
                            </p>
                            <button class="ghost" id="signIn">
                                Entrar
                            </button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Olá amigo!</h1>
                            <p>
                                Insira seus dados pessoais e comece sua jornada
                                conosco
                            </p>
                            <button class="ghost" id="signUp">
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
