import { useDispatch, useSelector } from "react-redux";
import { nextStep, setClassAnimate } from "../../store/order/orderSlice";
import style from "./StartPage.module.css";
import FooterLayout from "../../layout/FooterLayout";
import LoginModal from "../../components/Login/LoginModal";
import pic1 from "../../assets/Slideshow/pic1.webp";
import vid1 from "../../assets/Slideshow/vid1.mp4";
import Slideshow from "../../components/Common/Slideshow";
import { LazyLoadImage } from "react-lazy-load-image-component";

function StartPage() {
  const dispatch = useDispatch();

  const goToNextStep = () => {
    dispatch(nextStep());
    dispatch(setClassAnimate("backwardAnimation"));
  };

  const classAnimate = useSelector((state) => state.order.classAnimate);

  return (
    <div className={`${style[classAnimate]}`}>
      <div className={style.imageWrapper}>
        <Slideshow items={[pic1, vid1]} />
      </div>
      <FooterLayout className={style.footer}>
        <div className={style.startButton} onClick={goToNextStep}>
          <span className={style.title}>Tap here to order</span>
        </div>
        <div className={style.shine} />
      </FooterLayout>

      <LoginModal />
    </div>
  );
}

export default StartPage;
