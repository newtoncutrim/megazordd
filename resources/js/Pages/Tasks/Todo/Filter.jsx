import React from "react";
import styles from "./Filter.module.css";

const Filter = ({ filter, setFilter, setSort }) => {
    const handleSort = (order) => {
        setSort(order);
    };

    return (
        <div className={styles.filter}>
            <h2 className={styles.titleFilter}>Filtrar:</h2>
            <div className={styles.filterOptions}>
                <div className={styles.ordemTask}>
                    <p>Ordem Alfabética</p>
                    <button onClick={() => handleSort("Asc")}>Asc</button>
                    <button onClick={() => handleSort("Desc")}>Desc</button>
                </div>
                <div>
                    <p className={styles.status}>status:</p>
                    <select
                        value={filter}
                        onChange={(e) => setFilter(e.target.value)}
                    >
                        <option value="All">Todas</option>
                        <option value="Completed">Completas</option>
                        <option value="Incomplete">Incompletas</option>
                    </select>
                </div>
            </div>
        </div>
    );
};

export default Filter;
