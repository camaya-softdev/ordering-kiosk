import { useDispatch } from "react-redux";
import { setSelectedOutlet, nextStep } from "../../store/order/orderSlice";

function OutletCard({ outlet }) {
  const style = {
    card: {
      display: "flex",
      width: "298px",
      height: "250px",
      flexDirection: "row",
      alignItems: "center",
      justifyContent: "center",
      flexShrink: 0,
      borderRadius: "16px",
      background: "#FFF",
      cursor: "pointer",
      boxShadow:
        "0px 0px 16px -4px rgba(16, 24, 40, 0.16), 0px 0px 6px -2px rgba(16, 24, 40, 0.16)",
    },
    image: {
      width: "250px",
      height: "250px",
      objectFit: "cover",
    },
  };

  const dispatch = useDispatch();

  const handleSelect = () => {
    if(outlet.status){
      dispatch(setSelectedOutlet(outlet));
      dispatch(nextStep());
    }
  };

  return (
    <div 
      style={style.card} 
      onClick={handleSelect}
      className={outlet.status ? '': 'disabled'}
    >
      <img
        src={`${import.meta.env.VITE_API}${outlet.image}`}
        alt={outlet.name}
        style={style.image}
      />
    </div>
  );
}

export default OutletCard;
