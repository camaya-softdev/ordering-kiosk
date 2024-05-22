import { useEffect } from "react";
import "./App.css";
import "./index.css";
import {MainLayout} from "./layout/MainLayout";
import { checkCookieValidity } from "./utils/Common/CheckCookieValidity";

function App() {
  
  useEffect(() => {
    checkCookieValidity();
  }, []);

  return (
    <>
      <MainLayout/>
    </>
  );
}

export default App;
