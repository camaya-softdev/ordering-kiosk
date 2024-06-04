import { useSelector } from "react-redux";
import StartPage from "../../Pages/StartPage";
import style from "./MainLayout.module.css";
import FoodOutlet from "../../Pages/Foodoutlet";
import OutletOrder from "../../Pages/Outletorder";
import DineOptions from "../../Pages/DineOptions";
import LocationPage from "../../Pages/LocationPage";
import OrderSummary from "../../Pages/OrderSummary";
import PaymentOptions from "../../Pages/PaymentOptions";
import GCashScanPage from "../../Pages/GCashScanPage";
import OrderConfirmed from "../../Pages/OrderConfirmed";
import OrderPending from "../../Pages/OrderPending";

function stylized(WrappedComponent) {
  const StylizedComponent = function (props) {
    return (
      <div className={style.mainLayout}>
        <WrappedComponent {...props} />
      </div>
    );
  };
  StylizedComponent.displayName =
    WrappedComponent.displayName || WrappedComponent.name || "Component";
  return StylizedComponent;
}

function MainLayout() {
  const orderStep = useSelector((state) => state.order.orderStep);

  switch (orderStep) {
    case 0:
      return stylized(StartPage)();
    case 1:
      return stylized(FoodOutlet)();
    case 2:
      return stylized(OutletOrder)();
    case 3:
      return stylized(DineOptions)();
    case 4:
      return stylized(LocationPage)();
    case 5:
      return stylized(OrderSummary)();
    case 6:
      return stylized(PaymentOptions)();
    case 7:
      return stylized(GCashScanPage)();
    case 8:
      return stylized(OrderPending)();
    case 9:
      return stylized(OrderConfirmed)();
    default:
      return stylized(StartPage)();
  }
}

export { MainLayout, stylized };
