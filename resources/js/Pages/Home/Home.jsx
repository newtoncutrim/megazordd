import React from "react";
import styles from "./Home.module.css";
import Header from "@/Components/Header";
import Footer from "@/Components/Footer";

const Home = () => {
    return (
        <div>
            <Header />
            <section className={styles.home}>
                <h1>Home</h1>
            </section>
            <Footer />
        </div>
    );
};

export default Home;
