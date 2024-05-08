import { useDispatch } from "react-redux";
import { setSelectedOutlet, nextStep } from "../../store/order/orderSlice";
import styles from "./OutletList.module.css";

function OutletCard({ outlet }) {
  const dispatch = useDispatch();

  const handleSelect = () => {
    if(outlet.status){
      dispatch(setSelectedOutlet(outlet));
      dispatch(nextStep());
    }
  };

  return (
    <div 
      onClick={handleSelect}
      className={`${outlet.status ? '': 'disabled'} ${styles.outletCard}`}
    >
      <img
        src={`${import.meta.env.VITE_API}${outlet.image}`}
        alt={outlet.name}
        className={styles.outletImage}
      />
    </div>
  );
}

export default OutletCard;
