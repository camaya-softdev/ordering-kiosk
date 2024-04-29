import StartPage from "../Pages/StartPage";
import style from "./MainLayout.module.css";

function MainLayout() {
    return(
        <div className={style.mainLayout}>
            <StartPage/>
        </div>
    )
}

export default MainLayout;