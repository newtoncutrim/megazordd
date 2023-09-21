import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faFacebookF,
    faGooglePlusG,
    faLinkedinIn,
} from "@fortawesome/free-brands-svg-icons";

import "./Login.css";
import React from "react";

const FormCadastro = () => {
    const handleSignInClick = () => {
        container.classList.remove("right-panel-active");
    };
    return (
        <form action="#" method="Post">
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
            <button onClick={handleSignInClick}>Inscrever-se</button>
        </form>
    );
};

export default FormCadastro;
