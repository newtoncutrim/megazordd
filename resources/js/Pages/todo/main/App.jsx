// import "bootstrap/dist/css/bootstrap.min.css";
// import "font-awesome/css/font-awesome.min.css";
import Logo from "../template/Logo";
import Nav from "../template/Nav";
import Main from "../template/Main";
import Footer from "../template/Footer";
import "./App.css";
import React from "react";

const App = () => (
    <div className="app">
        <Logo />
        <Nav />
        <Main />
        <Footer />
    </div>
);

export default App;
