import { useEffect } from "react";
import "./App.css";
import "./index.css";
import {MainLayout} from "./layout/MainLayout";
import { checkCookieValidity } from "./utils/Common/CheckCookieValidity";
import { useDispatch } from "react-redux";

function App() {
  const dispatch = useDispatch();
  useEffect(() => {
    checkCookieValidity(dispatch);
  }, []);

  return (
    <>
      <MainLayout/>
    </>
  );
}

export default App;
