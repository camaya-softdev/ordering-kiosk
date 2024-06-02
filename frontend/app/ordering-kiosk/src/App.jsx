import { useEffect } from "react";
import "./App.css";
import "./index.css";
import { MainLayout } from "./layout/MainLayout";
import { checkCookieValidity } from "./utils/Common/CheckCookieValidity";
import { useDispatch } from "react-redux";

function App() {
  const dispatch = useDispatch();
  useEffect(() => {
    checkCookieValidity(dispatch);

    const disableContextMenu = (e) => {
      e.preventDefault();
    };

    const disableShortcuts = (e) => {
      if (
        (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "J")) || // Ctrl+Shift+I or Ctrl+Shift+J
        e.key === "F12" // F12
      ) {
        e.preventDefault();
      }
    };

    document.addEventListener("contextmenu", disableContextMenu);
    document.addEventListener("keydown", disableShortcuts);

    return () => {
      document.removeEventListener("contextmenu", disableContextMenu);
      document.removeEventListener("keydown", disableShortcuts);
    };
  }, [dispatch]);

  return (
    <>
      <MainLayout />
    </>
  );
}

export default App;
