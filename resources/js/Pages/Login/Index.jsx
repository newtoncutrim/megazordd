import React from "react";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
import Home from "@/Components/Home/Home";
import Login from "@/Components/Login/Login";
import "../../../css/app.css";

import { BrowserRouter, Routes, Route } from "react-router-dom";

const Index = () => {
    return (
        <div>
            <BrowserRouter>
                <Header />
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/login" element={<Login />} />
                </Routes>
                <Footer />
            </BrowserRouter>
        </div>
    );
};

export default Index;
