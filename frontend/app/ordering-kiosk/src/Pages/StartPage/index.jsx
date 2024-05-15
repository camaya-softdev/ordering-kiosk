import { useSelector } from 'react-redux';
import { nextStep } from '../../store/order/orderSlice';
import style from "./StartPage.module.css";
import pic from "../../assets/orderpage.jpg";
import FooterLayout from '../../layout/FooterLayout';
import CamayaLogo from '../../assets/camaya-logo.svg';
import LoginModal from '../../components/Login/LoginModal';
import { useState, useEffect } from 'react';
import { useCheckUser } from '../../hooks/useCheckUser'; // Import useCheckUser hook

function StartPage (){
    const user = useSelector(state => state.user.user); // Select user from Redux store
    const [loginModal, setLoginModal] = useState(true);

    useCheckUser(); // Use custom hook

    // Function to move to the next step of the order process
    const goToNextStep = () => {
        dispatch(nextStep());
    };

    useEffect(() => {
        if (user) {
            setLoginModal(false); // Close modal if user is logged in
        }
    }, [user]); // Add user as dependency

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

            <LoginModal
                open={loginModal}
                onClose={() => setLoginModal(false)}
            />
        </div>
    );
}

export default StartPage;