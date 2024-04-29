import { useSelector, useDispatch } from 'react-redux';
import { nextStep, previousStep } from '../../store/order/orderSlice';
import Foodoutlet from "../Foodoutlet";
import style from "./StartPage.module.css";

function StartPage (){
    const orderStep = useSelector(state => state.order.orderStep);
    const dispatch = useDispatch();

    // Function to move to the next step of the order process
    const goToNextStep = () => {
        dispatch(nextStep());
    };

    // Function to move to the previous step of the order process
    const goToPreviousStep = () => {
        dispatch(previousStep());
    };

    return(
        <div>
            {/* Render the button or Foodoutlet component based on orderStarted */}
            {orderStep === 0 ? (
                <div className={style.mainContainer}>
                    <div className={style.img} />
                    <div className={style.img2}>
                        <div className={style.img3} />
                        <div className={style.pic} />
                        <div className={style.section}>
                        <span className={style.text} onClick={goToNextStep}>
                            Start Order
                        </span>
                        </div>
                    </div>
                </div>
            ) : (
                <Foodoutlet onGoBack={goToPreviousStep} /> // Pass the callback function
            )}
        </div>
    );
}

export default StartPage;