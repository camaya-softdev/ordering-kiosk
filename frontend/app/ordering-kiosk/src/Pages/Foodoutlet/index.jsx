import style from "./Foodoutlet.module.css";
import { previousStep } from "../../store/order/orderSlice";
import { useDispatch } from "react-redux";
import CamayaLogo from "../../assets/camaya-logo.svg";
import CamayaLogoGray from "../../assets/camaya-logo-gray.svg";
import FooterLayout from "../../layout/FooterLayout";
import OutletList from "../../components/FoodOutlets/OutletList";
import Button from "../../components/Common/Button";

function FoodOutlet() {
  // const orderStep = useSelector(state => state.order.orderStep);
  const dispatch = useDispatch();

  // Function to move to the previous step of the order process
  const goToPreviousStep = () => {
    dispatch(previousStep());
  };
  // Function to move to the next step of the order process
  // const goToNextStep = () => {
  //     dispatch(nextStep());
  // };

  return (
    <div className={style.wrapper}>
      <div className={style.header}>
        <img src={CamayaLogo} className={style.camayaLogo} />
        <span className={style.title}>Choose a food outlet</span>
      </div>

      <div className={style.outlets}>
        <OutletList />
      </div>

      <FooterLayout>
        <div className={style.footer}>
          <div className={style.backBtn}>
            <Button onClick={goToPreviousStep}>
              Go back
            </Button>
          </div>
        </div>
      </FooterLayout>

      <img src={CamayaLogoGray} className={style.camayaLogoGray} />
    </div>
  );
}

export default FoodOutlet;
