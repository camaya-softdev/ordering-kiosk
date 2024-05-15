import { useDispatch, useSelector } from 'react-redux';
import { nextStep } from '../../store/order/orderSlice';
import style from "./StartPage.module.css";
import pic from "../../assets/orderpage.jpg";
import FooterLayout from '../../layout/FooterLayout';
import CamayaLogo from '../../assets/camaya-logo.svg';
import LoginModal from '../../components/Login/LoginModal';
import { useState, useEffect } from 'react';
import Cookies from 'js-cookie';

function StartPage (){
    const [loginModal, setLoginModal] = useState(true);
    const [user, setUser] = useState(Cookies.get('user'));
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
                onLoginSuccess={handleLoginSuccess} 
            />
        </div>
    );
}

export default StartPage;