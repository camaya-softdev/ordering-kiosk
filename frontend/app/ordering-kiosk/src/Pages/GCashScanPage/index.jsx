import { useEffect, useState } from "react";
import Progress from "../../components/DineOption/Progress";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import { useDispatch, useSelector } from "react-redux";
import { PICK_UP } from "../../utils/Constants/DiningOptions";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";
import { previousStep, setClassAnimate } from "../../store/order/orderSlice";
import { LazyLoadImage } from "react-lazy-load-image-component";
import style from "./GCashScanPage.module.css";
import LoginModal from "../../components/Login/LoginModal";
import useFetchGCashDetails from "../../hooks/useFetchGCashDetails";
import BeatLoader from "react-spinners/BeatLoader";
import PrivacyNote from "../../components/PrivacyNotice/PrivacyNote";

function GCashScanPage() {
  const dispatch = useDispatch();
  const selectedOutlet = useSelector((state) => state.order.selectedOutlet);
  const selectedDiningOption = useSelector((state) => state.order.diningOption);
  const classAnimate = useSelector((state) => state.order.classAnimate);
  const [gcashImage, setGcashImage] = useState(null);
  const [openModal, setOpenModal] = useState({
    startOver: false,
    // confirmPayment: false,
    privacyNote: false,
  });

  const handleBackClick = () => {
    dispatch(previousStep());
    dispatch(setClassAnimate("forwardAnimation"));
  };

  const { gcashDetails, isGcashDetailsLoading } = useFetchGCashDetails({
    outlet_id: selectedOutlet.id,
  });

  useEffect(() => {
    if (gcashDetails?.data?.length > 0) {
      setGcashImage(gcashDetails.data[0].image);
    } else {
      setGcashImage(null);
    }
  }, [gcashDetails]);

  return (
    <div className={`${style[classAnimate]}`}>
      <div className={style.topContainer}>
        <Progress />
      </div>
      <div className={style.mainContainer}>
        <div className={style.gcashWrapper}>
          <div className={style.titleContainer}>GCASH Payment</div>
          <div className={style.instructions}>
            <p>
              <span>1. Open GCASH APP then login.</span>
              <span>2. Click “QR” then scan the QR code below.</span>
            </p>
          </div>

          {isGcashDetailsLoading ? (
            <div
              style={{
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                height: "100vh",
              }}
            >
              <BeatLoader color="#FD3C00" size={35} speedMultiplier={0.5} />
            </div>
          ) : (
            <>
              {gcashImage ? (
                <LazyLoadImage
                  src={`${import.meta.env.VITE_API}/${gcashImage}`}
                  alt="GCash Account"
                  className={style.gcash_qr}
                />
              ) : (
                <span>No GCash details found.</span>
              )}
            </>
          )}
        </div>
      </div>
      <div className={style.circleBlur}></div>

      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
        showLocationDetails={selectedDiningOption === PICK_UP ? false : true}
        backOnClick={handleBackClick}
        startOverBtnOnClick={() => setOpenModal({ startOver: true })}
        showConfirmPaymentBtn={true}
        confirmPaymentOnClick={() => setOpenModal({ privacyNote: true })}
      />

      <StartOverConfirmation
        open={openModal.startOver}
        onClose={() => setOpenModal({ startOver: false })}
      />

      {/* <ConfirmGCashPayment
        open={openModal.confirmPayment}
        onClose={() => setOpenModal({ confirmPayment: false })}
      /> */}

      <PrivacyNote
        open={openModal.privacyNote}
        onClose={() => setOpenModal({ privacyNote: false })}
      />
      <LoginModal />
    </div>
  );
}

export default GCashScanPage;
