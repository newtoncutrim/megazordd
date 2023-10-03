import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faFacebookF,
    faGooglePlusG,
    faLinkedinIn,
} from "@fortawesome/free-brands-svg-icons";

import "./Login.css";
import React from "react";

const FormEntrar = () => {
    // const handleSignUpClick = () => {
    //     container.classList.add("right-panel-active");
    // };
    const [email, setEmail] = React.useState("");
    const [senha, setSenha] = React.useState("");

    function handleSubmit(event) {
        event.preventDefault();
        console.log(event);
    }

    return (
        <form onSubmit={handleSubmit}>
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
            <input
                type="text"
                placeholder="Email..."
                id="email"
                value={email}
                onChange={(event) => setEmail(event.target.value)}
            />
            <input
                type="password"
                placeholder="Password"
                value={senha}
                id="senha"
                onChange={(event) => setSenha(event.target.value)}
            />
            <a href="#">Esqueceu sua senha?</a>
            <button>Entrar</button>
        </form>
        // <form action="#" method="#">

        //     <input type="email" placeholder="Email" />

        // </form>
    );
};

export default FormEntrar;
