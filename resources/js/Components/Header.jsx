// import React from "react";
// import styles from "../Components/Header.module.css";
// // import MdiChartDonut from "../../img/MdiChartDonut.svg";
// // import { Link } from "react-router-dom";

// const Header = ({ children }) => {
//     return (
//         <header className={styles.header}>
//             header
//             {/* <nav className={styles.nav}>
//                 <Link to="/" aria-label="Soul - Home">
//                     <img className={styles.svg} src={MdiChartDonut} alt="" />
//                 </Link>
//                 <Link to="/login">Login / Criar</Link>
//             </nav> */}
//         </header>
//     );
// };

// export default Header;

// Header.js
import React from "react";
import { Link } from "react-router-dom";

const Header = () => {
    return (
        <nav>
            <ul>
                <li>
                    <Link to="/">Home</Link>
                </li>
                <li>
                    <Link to="/cadastrar">Cadastro</Link>
                </li>
                {/* Adicione outros links conforme necessário */}
            </ul>
        </nav>
    );
};

export default Header;
