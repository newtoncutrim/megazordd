import React from "react";
import Header from "../Header";
import styles from "./Home.module.css";
import Footer from "../Footer";

const Home = () => {
    return (
        <section className={styles.home}>
            <Header />
            <h1 className="title">home</h1>
            <Footer />
        </section>
    );
};

export default Home;
