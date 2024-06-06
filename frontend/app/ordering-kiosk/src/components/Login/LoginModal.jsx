import { useEffect, useState } from "react";
import BottomModal from "../Common/BottomModal";
import Button from "../Common/Button";
import CustomInputField from "../GCashScanPage/CustomField";
import styles from "./LoginModal.module.css";
import { useLogin } from "../../services/AuthService";
import { useSelector } from "react-redux";
import Cookies from "js-cookie";

function LoginModal() {
  const [open, setOpen] = useState();
  const loginQuery = useLogin();
  const auth = useSelector((state) => state.auth);
  const [credentials, setCredentials] = useState({
    username: "",
    password: "",
  });
  const [error, setError] = useState(null);
  const [userCookie, setUserCookie] = useState(() => {
    const cookie = Cookies.get("user");
    return cookie ? JSON.parse(cookie) : null;
  });

  const handleLogin = async () => {
    try {
      await loginQuery.mutateAsync(credentials);
      onClose();
    } catch (error) {
      setError(error.response.data.message);
    }
  };

  const onClose = () => {
    setOpen(false);
  };

  useEffect(() => {
    const intervalId = setInterval(() => {
      const currentUserCookie = Cookies.get("user");
      if (currentUserCookie !== userCookie) {
        setUserCookie(currentUserCookie);
      }
    }, 1000); // Check every second

    return () => {
      clearInterval(intervalId);
    };
  }, [userCookie]);

  useEffect(() => {
    if (userCookie === undefined || userCookie === null) {
      setOpen(true);
    } else {
      setOpen(false);
    }
  }, [userCookie, auth]);

  return (
    <BottomModal open={open} onClose={onClose}>
      <div className={styles.modalFields}>
        <CustomInputField
          label="Enter username"
          placeholder="username"
          value={credentials.username}
          onChange={(e) =>
            setCredentials({ ...credentials, username: e.target.value })
          }
        />
        <CustomInputField
          label="Enter password"
          placeholder="******"
          type="password"
          value={credentials.password}
          onChange={(e) =>
            setCredentials({ ...credentials, password: e.target.value })
          }
        />

        <div className={styles.modalButtons}>
          <Button
            type="black"
            onClick={handleLogin}
            loading={loginQuery.isLoading}
            disabled={
              !credentials.username ||
              !credentials.password ||
              loginQuery.isLoading
            }
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
