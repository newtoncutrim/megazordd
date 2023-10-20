import React from "react";
import { BrowserRouter, Route, Routes, Outlet } from "react-router-dom";
import "../../../css/app.css";

import Header from "@/Components/Header";
import Footer from "@/Components/Footer";
import Home from "@/Components/Home";
import Login from "@/Components/Login/Login";
import LoginCreate from "@/Components/Login/LoginCreate";

const Index = () => {
    return (
        <div>
            <BrowserRouter>
                <Header />
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/login/*" element={<Login />} />
                </Routes>
                <Footer />
            </BrowserRouter>
        </div>
    );
};

export default Index;
