import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faFacebookF,
    faGooglePlusG,
    faLinkedinIn,
} from "@fortawesome/free-brands-svg-icons";

import "./Login.css";
import React from "react";

const FormEntrar = () => {
    const handleSignUpClick = () => {
        container.classList.add("right-panel-active");
    };

    return (
        <form action="#" method="#">
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
    );
};

export default FormEntrar;
