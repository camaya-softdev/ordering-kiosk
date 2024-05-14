import { useDispatch } from 'react-redux';
import { nextStep } from '../../store/order/orderSlice';
import style from "./StartPage.module.css";
import pic from "../../assets/orderpage.jpg";
import FooterLayout from '../../layout/FooterLayout';
import CamayaLogo from '../../assets/camaya-logo.svg';

function StartPage (){
    const dispatch = useDispatch();

    // Function to move to the next step of the order process
    const goToNextStep = () => {
        dispatch(nextStep());
    };

    return(
        <div>
            <img src={pic} />
            <FooterLayout className={style.footer}>
                <img src={CamayaLogo}/>
                <div 
                    className={style.startButton}
                    onClick={goToNextStep}
                >
                    <span className={style.title}>Start order</span>
                </div>

                <div className={style.shine}/>
            </FooterLayout>
        </div>
    );
}

export default StartPage;