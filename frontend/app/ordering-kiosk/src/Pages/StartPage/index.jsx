import { useDispatch, useSelector } from "react-redux";
import { nextStep } from "../../store/order/orderSlice";
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
  const [user, setUser] = useState(Cookies.get("user"));
  const dispatch = useDispatch();

  const goToNextStep = () => {
    dispatch(nextStep());
  };

  useEffect(() => {
    if (user !== undefined) {
      setLoginModal(false);
    }
  }, [user]);

  const handleLoginSuccess = (userData) => {
    setUser(userData);
    setLoginModal(false);
  };

  return (
    <div>
      <div className={style.imageWrapper}>
        <Slideshow items={[pic1, vid1]} />
      </div>
      <FooterLayout className={style.footer}>
        <img src={CamayaLogo} />
        <div className={style.startButton} onClick={goToNextStep}>
          <span className={style.title}>Start order</span>
        </div>
        <div className={style.shine} />
      </FooterLayout>

      <LoginModal
        open={loginModal}
        onClose={() => setLoginModal(false)}
        onLoginSuccess={handleLoginSuccess}
      />
    </div>
  );
}

export default StartPage;
