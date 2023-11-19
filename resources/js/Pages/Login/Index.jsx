import React from "react";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
// import Home from "@/Components/Home/Home";
import "../../../css/app.css";
import Cadastro from "@/Components/Cadastro/Cadastro";

const Index = () => {
    return (
        <div>
            {/* <Home /> */}
            <Header />
            <Cadastro />
            <Footer />
        </div>
    );
};

export default Index;
