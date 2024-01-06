import PropTypes from "prop-types";
import styles from './Search.module.css'
import { FaSearch} from 'react-icons/fa'

const Search = ({ search, setSearch, handleSearch }) => {
  
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
          <button>
              <FaSearch  onClick={handleSearch}/>
          </button>
      </div>
  );
};

Search.propTypes = {
  setSearch: PropTypes.func.isRequired,
};
export default Search;
