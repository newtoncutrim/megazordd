import React from "react";
import Header from "../Header";
import styles from "./Home.module.css";
import Footer from "../Footer";
import "../../../css/app.css";

const Home = () => {
    return (
        <section className={styles.homeSection}>
            <Header />

            <h1 className="title">Home</h1>
            <Footer />
        </section>
    );
};

export default Home;
