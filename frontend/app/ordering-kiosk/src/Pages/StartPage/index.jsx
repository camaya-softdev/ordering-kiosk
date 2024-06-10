import { useDispatch, useSelector } from "react-redux";
import { nextStep, setClassAnimate, setOrderStep, setSelectedOutlet } from "../../store/order/orderSlice";
import style from "./StartPage.module.css";
import FooterLayout from "../../layout/FooterLayout";
import LoginModal from "../../components/Login/LoginModal";
import pic1 from "../../assets/Slideshow/pic1.webp";
import vid1 from "../../assets/Slideshow/vid1.mp4";
import Slideshow from "../../components/Common/Slideshow";
import { LazyLoadImage } from "react-lazy-load-image-component";
import useFetchOutlets from "../../hooks/useFetchOutlets";
import { useEffect } from "react";

function StartPage() {
  const dispatch = useDispatch();
  const selectedOutlet = useSelector((state) => state.order.selectedOutlet);
  const user = useSelector((state) => state.auth.auth);
  const {outlets, setOuletFilter} = useFetchOutlets();
  
  useEffect(() => {
    if(outlets?.data.length === 1){
      try{
        dispatch(setSelectedOutlet(outlets.data[0]));
      }
      finally{
        dispatch(setOrderStep(2));
        dispatch(setClassAnimate("backwardAnimation"));
      }
    }
  }, [outlets]);

  const goToNextStep = () => {
    if (user.outlet_id !== null) {
      setOuletFilter((prev) => ({ ...prev, id: user.outlet_id }));
    }
    else{
      dispatch(nextStep());
      dispatch(setClassAnimate("backwardAnimation"));
    }
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
