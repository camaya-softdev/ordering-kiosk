import { useDispatch, useSelector } from "react-redux";
import { nextStep, setClassAnimate } from "../../store/order/orderSlice";
import style from "./StartPage.module.css";
import FooterLayout from "../../layout/FooterLayout";
import CamayaLogo from "../../assets/camaya-logo.svg";
import LoginModal from "../../components/Login/LoginModal";
import { useState, useEffect } from "react";
import Cookies from "js-cookie";

import pic1 from "../../assets/Slideshow/pic1.jpeg";
import vid1 from "../../assets/Slideshow/vid1.mp4";
import Slideshow from "../../components/Common/Slideshow";

function StartPage() {
  const [loginModal, setLoginModal] = useState(true);
  // const user = useSelector((state) => state.auth);
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
        <img src={CamayaLogo} alt="camaya-logo" />
        <div className={style.startButton} onClick={goToNextStep}>
          <span className={style.title}>Start order</span>
        </div>
        <div className={style.shine} />
      </FooterLayout>

      <LoginModal/>
    </div>
  );
}

export default StartPage;
