import styles from './Filter.module.css'


const Filter = ({ filter, setFilter, setSort }) => {

   
    return (
      <div className={styles.filter}>
        <h2>Filtrar:</h2>
        <div className={styles.filterOptions}>
          <div>
            <p>status:</p>
            <select value={filter} onChange={(e) => setFilter(e.target.value)}>
              <option value="All">Todas</option>
              <option value="Completed">Completas</option>
              <option value="Incomplete">Incompletas</option>
            </select>
          </div>
          <div>
            <p>Ordem Alfabética</p>
            <button onClick={() => setSort("Asc")}>Asc</button>
            <button onClick={() => setSort("Desc")}>Desc</button>
          </div>
        </div>
      </div>
    );
  };
  
  export default Filter;
  