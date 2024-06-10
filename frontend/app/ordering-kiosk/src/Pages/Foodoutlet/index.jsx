import style from "./Foodoutlet.module.css";
import { setClassAnimate, setOrderStep } from "../../store/order/orderSlice";
import { useDispatch, useSelector } from "react-redux";
import CamayaLogo from "../../assets/camaya-logo.svg";
import CamayaLogoGray from "../../assets/camaya-logo-gray.svg";
import FooterLayout from "../../layout/FooterLayout";
import OutletList from "../../components/FoodOutlets/OutletList";
import Button from "../../components/Common/Button";
import LoginModal from "../../components/Login/LoginModal";
import { LazyLoadImage } from "react-lazy-load-image-component";

function FoodOutlet() {
  // const orderStep = useSelector(state => state.order.orderStep);
  const dispatch = useDispatch();

  // Function to move to the previous step of the order process
  const goToPreviousStep = () => {
    dispatch(setOrderStep(0));
    dispatch(setClassAnimate("forwardAnimation"));
  };

  const classAnimate = useSelector((state) => state.order.classAnimate);

  return (
    <div className={`${style[classAnimate]}`}>
      <div className={style.header}>
        <LazyLoadImage
          src={CamayaLogo}
          className={style.camayaLogo}
          alt="camaya logo"
        />
        <span className={style.title}>CHOOSE A FOOD OUTLET</span>
      </div>

      <div className={style.outlets}>
        <OutletList />
      </div>

      <FooterLayout>
        <div className={style.footer}>
          <div className={style.backBtn}>
            <Button onClick={goToPreviousStep}>Go back</Button>
          </div>
        </div>
      </FooterLayout>

      <LazyLoadImage
        src={CamayaLogoGray}
        className={style.camayaLogoGray}
        alt="camaya logo"
      />
      <LoginModal />
    </div>
  );
}

export default FoodOutlet;
