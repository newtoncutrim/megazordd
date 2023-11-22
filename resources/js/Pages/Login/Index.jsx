import React from "react";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
// import Home from "@/Components/Home/Home";
import "../../../css/app.css";
import Cadastro from "@/Components/Cadastro/Cadastro";
import Login from "@/Components/Login/Login";

const Index = () => {
    return (
        <div>
            {/* <Home /> */}
            <Header />
            <Cadastro />
            <Login />
            <Footer />
        </div>
    );
};

export default Index;
