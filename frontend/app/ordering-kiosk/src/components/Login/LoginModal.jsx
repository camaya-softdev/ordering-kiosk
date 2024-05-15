import { useEffect, useState } from "react";
import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import CustomInputField from "../GCashScanPage/CustomField";
import styles from "./LoginModal.module.css";
import { useLogin } from "../../services/AuthService";
import Cookies from 'js-cookie';

function LoginModal({open, onClose}){
    const loginQuery = useLogin();
    const [credentials, setCredentials] = useState({
        username: "",
        password: ""
    });

    const handleLogin = async () => {
        try {
            const response = await (await loginQuery).mutateAsync(credentials);
            console.log(response);
        } catch (error) {
            alert("Cannot create transaction. Please try again.");
        }
    };

    return (
        <BottomModal
            open={open}
            onClose={onClose}
        >
            <div className={styles.modalFields}>
                <CustomInputField
                    label="Enter username"
                    placeholder="username"
                    value={credentials.username}
                    onChange={(e) => setCredentials({ ...credentials, username: e.target.value })}
                />
                <CustomInputField
                    label="Enter password"
                    placeholder="******"
                    type="password"
                    value={credentials.password}
                    onChange={(e) => setCredentials({ ...credentials, password: e.target.value })}
                />

                <div className={styles.modalButtons}>
                    <Button
                        type="black"
                        onClick={handleLogin}
                        // loading={placeOrderQuery.isLoading}
                        disabled={!credentials.username || !credentials.password}
                    >
                        Login
                    </Button>
                </div>
            </div>
        </BottomModal>
    );
}

export default LoginModal;