import { useEffect, useState } from "react";
import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import CustomInputField from "../GCashScanPage/CustomField";
import styles from "./LoginModal.module.css";
import { useLogin } from "../../services/AuthService";

function LoginModal({open, onClose, onLoginSuccess}){
    const loginQuery = useLogin();
    const [credentials, setCredentials] = useState({
        username: "",
        password: ""
    });
    const [error, setError] = useState(null);

    const handleLogin = async () => {
        try {
            const response = await (loginQuery).mutateAsync(credentials);
            onLoginSuccess(response.data);

        } catch (error) {
            setError(error.response.data.message);
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
                        loading={loginQuery.isLoading}
                        disabled={!credentials.username || !credentials.password || loginQuery.isLoading}
                    >
                        Login
                    </Button>

                    
                </div>

                {error && <div className={styles.errorMessage}>{error}</div>}
            </div>
        </BottomModal>
    );
}

export default LoginModal;