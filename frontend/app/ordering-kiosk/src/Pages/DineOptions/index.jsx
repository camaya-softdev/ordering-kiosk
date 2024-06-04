import style from "./DineOptions.module.css";
import dineinlogo from "../../assets/dineoptionlogo/dinein.svg";
import deliverlogo from "../../assets/dineoptionlogo/deliver.svg";
import takeawaylogo from "../../assets/dineoptionlogo/takeaway.svg";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import { useDispatch, useSelector } from "react-redux";
import { nextStep, previousStep, setArea, setDiningOption, setLocation, setOrderStep, setClassAnimate,
} from "../../store/order/orderSlice";
import { DELIVERY, DINE_IN, PICK_UP } from "../../utils/Constants/DiningOptions";
import { useEffect, useState } from "react";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import useFetchLocations from "../../hooks/useFetchLocations";
import LoginModal from "../../components/Login/LoginModal";
import { LazyLoadImage } from 'react-lazy-load-image-component';

function DineOptions() {
  const dispatch = useDispatch();
  const [openModal, setOpenModal] = useState({startOver: false});
  const diningOption = useSelector((state) => state.order.diningOption);
  const {locations, isLocationsLoading, setLocationsFilter, locationsFilter} = useFetchLocations();
  const currentUser = useSelector((state) => state.auth);
  const location = useSelector((state) => state.order.location);
  const [tempDiningOption, setTempDiningOption] = useState(null);

  useEffect(() => {
    if(diningOption === DINE_IN){
      if(locationsFilter.outlet_id !== null && !isLocationsLoading && locations?.data?.length > 0){
        dispatch(setLocation(locations.data[0]));
        dispatch(setArea(null));
      }
    }
  }, [locationsFilter, diningOption, locations]);

  useEffect(() => {
    if(diningOption === DINE_IN && location !== null && tempDiningOption !== null){
      dispatch(nextStep());
    }
  }, [location]);
    const classAnimate = useSelector((state) => state.order.classAnimate);
  const selectDiningOption = (option) => {
    dispatch(setDiningOption(option));
    setTempDiningOption(option);
    if(option === DINE_IN){
      if(currentUser.auth.outlet_id !== null){
        setLocationsFilter({outlet_id: currentUser.auth.outlet_id});
      }
      else{
        dispatch(nextStep());
      }
    }
    else if(option === DELIVERY){
      dispatch(nextStep());
      dispatch(setClassAnimate("backwardAnimation"));
    } else if (option === PICK_UP) {
      dispatch(setOrderStep(5));
      dispatch(setLocation(null));
      dispatch(setArea(null));
    }
  };
  const handleBackClick = () => {
    dispatch(previousStep());
    dispatch(setClassAnimate("forwardAnimation"));
  };
  return (
    <>
      <div className={`${style[classAnimate]}`}>
        <div className={style.topContainer}>
          <Progress/>
        </div>
        <div className={style.mainContainer}>
          <div className={style.wrapper}>
            <span className={style.text}>Where would you like to eat?</span>
            <div className={style.section}>
              <div className={style.wrapperOption}>
                <div
                  className={`${style.buttonOption} ${currentUser.auth.outlet_id === null ? "disabled" : ""}`}
                  onClick={() => {
                  if(currentUser.auth.outlet_id !== null){
                    selectDiningOption(DINE_IN);
                  }
                }}
                >
                  <span>DINE IN</span>
                  <LazyLoadImage src={dineinlogo} alt="Dine In Logo" />
                </div>
                <div
                  className={style.buttonOption}
                  onClick={() => selectDiningOption(PICK_UP)}
                >
                  <span>PICKUP TAKEAWAY</span>
                  <LazyLoadImage src={takeawaylogo} alt="Takeaway Logo" />
                </div>
                <div
                  className={style.buttonOption}
                  onClick={() => selectDiningOption(DELIVERY)}
                >
                  <span>DELIVERY</span>
                  <LazyLoadImage src={deliverlogo} alt="Delivery Logo" />
                </div>
              </div>
            </div>
          </div>
          <div className={style.circleBlur}></div>
        </div>
        <SummaryFooter
          showBackBtn={true}
          showStartOver={true}
          showDiningDetails={true}
          startOverBtnOnClick={() =>
            setOpenModal((prev) => ({ ...prev, startOver: true }))
          }
          backOnClick={handleBackClick}
        />

        <StartOverConfirmation
          open={openModal.startOver}
          onClose={() =>
            setOpenModal((prev) => ({ ...prev, startOver: false }))
          }
        />
      </div>
      <LoginModal/>
    </>
  );
}

export default DineOptions;
