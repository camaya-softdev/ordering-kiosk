import style from "./DineOptions.module.css";
import dineinlogo from "../../assets/dineoptionlogo/dinein.svg";
import deliverlogo from "../../assets/dineoptionlogo/deliver.svg";
import takeawaylogo from "../../assets/dineoptionlogo/takeaway.svg";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import { useDispatch, useSelector } from "react-redux";
import { nextStep, previousStep, setArea, setDiningOption, setLocation, setOrderStep } from "../../store/order/orderSlice";
import { DELIVERY, DINE_IN, PICK_UP } from "../../utils/Constants/DiningOptions";
import { useState } from "react";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import useFetchLocations from "../../hooks/useFetchLocations";

function DineOptions() {
  const dispatch = useDispatch();
  const [openModal, setOpenModal] = useState({startOver: false});
  const {locations, isLocationsLoading, setLocationsFilter} = useFetchLocations();
  const currentUser = useSelector((state) => state.auth.auth);

  const selectDiningOption = (option) => {
    dispatch(setDiningOption(option));
    if(option === DINE_IN){
      try{
        setLocationsFilter((prev) => ({...prev, outlet_id: currentUser.outlet_id}));
        if(!isLocationsLoading && locations.data.length > 0){
          dispatch(setLocation(locations.data[0]));
        }
      }
      catch(e){
        console.log(e);
      }
      finally{
        dispatch(nextStep());
      }
    }
    else if(option === DELIVERY){
      dispatch(nextStep());
    }
    else if(option === PICK_UP){
      dispatch(setOrderStep(5));
      dispatch(setLocation(null));
      dispatch(setArea(null));
    }
  }

  return (
    <>
      <div className={style.topContainer}>
        <Progress width={20} />
      </div>
      <div className={style.mainContainer}>
        <div className={style.wrapper}>
          <span className={style.text}>Where would you like to eat?</span>
          <div className={style.section}>
            <div className={style.wrapperOption}>
              <div 
                className={style.buttonOption} 
                onClick={() => selectDiningOption(DINE_IN)}
              >
                <span>DINE IN</span>
                <img src={dineinlogo} alt="Dine In Logo" />
              </div>
              <div 
                className={style.buttonOption}
                onClick={() => selectDiningOption(PICK_UP)}
              >
                <span>PICKUP TAKEAWAY</span>
                <img src={takeawaylogo} alt="Takeaway Logo" />
              </div>
              <div 
                className={style.buttonOption}
                onClick={() => selectDiningOption(DELIVERY)}
              >
                <span>DELIVERY</span>
                <img src={deliverlogo} alt="Delivery Logo" />
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
        startOverBtnOnClick={() => setOpenModal((prev) => ({...prev, startOver: true}))}
        backOnClick={() => dispatch(previousStep())}
      />

      <StartOverConfirmation
        open={openModal.startOver}
        onClose={() => setOpenModal((prev) => ({...prev, startOver: false}))}
      />
    </>
  );
}

export default DineOptions;
