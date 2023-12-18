import axios from "axios";
import React, { createContext, useState, useEffect } from "react";

export const UserContext = React.createContext();

export const UserStorage = ({ children }) => {
    const [data, setData] = React.useState(null);
    const [logado, setLogado] = React.useState(null);
    const [loading, setLoading] = React.useState(null);
    const [error, setError] = React.useState(null);

    React.useEffect(() => {
        async function autoLogin() {
            const token = localStorage.getItem("token");
            if (token) {
                try {
                    setError(null);
                    setLoading(true);
                    const response = await axios.get(
                        "http://localhost:8989/api/user",
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                            },
                        }
                    );
                    if (!response.status === 200)
                        throw new Error("Token inválido");
                    await getUser(token);
                } catch (err) {
                    userLogout();
                } finally {
                    setLoading(false);
                }
            }
        }
        autoLogin();
    }, []);

    async function getUser(token) {
        const response = await axios.get("http://localhost:8989/api/user", {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        setData(response.data);
        setLogado(true);
    }

    // função para resetar os estados
    async function userLogout() {
        setData(null);
        setError(null);
        setLoading(false);
        setLogado(false);
        localStorage.removeItem("token");
        window.location.href = "/login";
    }

    async function userLogin(email, password) {
        try {
            setError(null);
            setLoading(true);
            const response = await axios.post(
                "http://localhost:8989/api/auth/login",
                {
                    email: email,
                    password: password,
                }
            );
            const { token } = response.data.data;
            if (!response.status === 200) throw new Error("Usuário Inválido");
            localStorage.setItem("token", token);
            await getUser(token);
            window.location.href = "/tarefas";
        } catch (err) {
            setError("Error: Usuário Inválido");
            setLogado(false);
        } finally {
            setLoading(false);
        }
    }

    async function userRegister(name, email, password) {
        try {
            setError(null);
            setLoading(true);
            const userData = {
                name: name.value,
                email: email.value,
                password: password.value,
            };

            const response = await axios.post(
                "http://localhost:8989/api/users",
                userData
            );
            if (!response.status === 200)
                throw new Error("Email ja cadastrado");
            setError(null);
            window.location.href = "/login";
        } catch (error) {
            if (error.response) {
                setError(error.response.data.message);
            }
        } finally {
            setLoading(false);
        }
    }

    return (
        <UserContext.Provider
            value={{
                userLogin,
                userLogout,
                userRegister,
                data,
                logado,
                loading,
                error,
            }}
        >
            {children}
        </UserContext.Provider>
    );
};
