import PropTypes from "prop-types";
import styles from './Search.module.css'

const Search = ({ search, setSearch }) => {
  
  return (
    <div className={styles.search}>
      <input
        type="text"
        value={search}
        onChange={(e) => {
          setSearch(e.target.value);
        }}
        placeholder="Digite para pesquisar..."
      />
    </div>
  );
};

Search.propTypes = {
  setSearch: PropTypes.func.isRequired,
};
export default Search;
