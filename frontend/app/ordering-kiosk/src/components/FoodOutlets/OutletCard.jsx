import { useDispatch } from "react-redux";
import {
  setSelectedOutlet,
  nextStep,
  setClassAnimate,
} from "../../store/order/orderSlice";
import styles from "./OutletList.module.css";
import { LazyLoadImage } from "react-lazy-load-image-component";

function OutletCard({ outlet }) {
  const dispatch = useDispatch();

  const handleSelect = () => {
    if (outlet.status) {
      dispatch(setSelectedOutlet(outlet));
      dispatch(setClassAnimate("backwardAnimation"));
      dispatch(nextStep());
    }
  };

  return (
    <div
      onClick={handleSelect}
      className={`${outlet.status ? "" : "hidden"} ${styles.outletCard}`}
    >
      <LazyLoadImage
        src={`${import.meta.env.VITE_API}${outlet.image}`}
        alt={outlet.name}
        className={styles.outletImage}
      />
    </div>
  );
}

export default OutletCard;
