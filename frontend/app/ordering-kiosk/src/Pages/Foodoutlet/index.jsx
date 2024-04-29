import style from './FoodOutlet.module.css';
import { previousStep } from '../../store/order/orderSlice';
import { useDispatch } from 'react-redux';
import CamayaLogo from '../../assets/camaya-logo.svg';
import FooterLayout from '../../layout/FooterLayout';

function FoodOutlet () {
    // const orderStep = useSelector(state => state.order.orderStep);
    const dispatch = useDispatch();

    // Function to move to the previous step of the order process
    const goToPreviousStep = () => {
        dispatch(previousStep());
    };

    // Function to move to the next step of the order process
    // const goToNextStep = () => {
    //     dispatch(nextStep());
    // };

    return(
        <div>
            <div className={style.header}>
                <img src={CamayaLogo} className={style.camayaLogo}/>
                <span className={style.title}>Choose a food outlet</span>
            </div>

            <div className={style.outlets}>
                
            </div>

            <FooterLayout >
                <div className={style.footer}>
                    <div 
                        className={style.backBtn}
                        onClick={goToPreviousStep}
                    >
                        Go back
                    </div>
                </div>
            </FooterLayout>
            
        </div>
    );
}

export default FoodOutlet;