import React from 'react'
import styles from './Slide.module.css'
import { FaTimes} from 'react-icons/fa'

const Slidebar = ({active}) => {
const closeSliderbar = () => {
  active(false)

}
  return (
    <div slidebar={active} className={styles.container}>
      <FaTimes onClick={closeSliderbar}/>

    </div>
  )
}

export default Slidebar