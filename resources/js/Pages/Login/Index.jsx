import React from "react";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
import "../../../css/app.css";
import Login from "@/Components/Login/Login";

const Index = () => {
    return (
        <div>
            <Header />
            <Login />
            <Footer />
        </div>
    );
};

export default Index;
