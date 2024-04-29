import { useSelector } from "react-redux";
import StartPage from "../../Pages/StartPage";
import style from "./MainLayout.module.css";
import FoodOutlet from "../../Pages/Foodoutlet";
import OutletOrder from "../../Pages/Outletorder";

function stylized(WrappedComponent) {
    const StylizedComponent = function(props) {
        return (
            <div className={style.mainLayout}>
                <WrappedComponent {...props} />
            </div>
        );
    }
    StylizedComponent.displayName = WrappedComponent.displayName || WrappedComponent.name || 'Component';
    return StylizedComponent;
}

function MainLayout() {
    const orderStep = useSelector(state => state.order.orderStep);

    switch(orderStep) {
        case 0:
            return stylized(StartPage)();
        case 1:
            return stylized(FoodOutlet)();
        case 2:
            return stylized(OutletOrder)();
        default:
            return stylized(StartPage)();
    }
}

export default MainLayout;