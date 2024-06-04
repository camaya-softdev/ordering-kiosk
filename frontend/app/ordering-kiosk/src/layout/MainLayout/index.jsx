import React from "react";
import { useSelector, Provider } from "react-redux";
import { Suspense } from 'react';
import style from "./MainLayout.module.css";
import BeatLoader from "react-spinners/BeatLoader";

const StartPage = React.lazy(() => import("../../Pages/StartPage"));
const FoodOutlet = React.lazy(() => import("../../Pages/Foodoutlet"));
const OutletOrder = React.lazy(() => import("../../Pages/Outletorder"));
const DineOptions = React.lazy(() => import("../../Pages/DineOptions"));
const LocationPage = React.lazy(() => import("../../Pages/LocationPage"));
const OrderSummary = React.lazy(() => import("../../Pages/OrderSummary"));
const PaymentOptions = React.lazy(() => import("../../Pages/PaymentOptions"));
const GCashScanPage = React.lazy(() => import("../../Pages/GCashScanPage"));
const OrderPending = React.lazy(() => import("../../Pages/OrderPending"));

function stylized(WrappedComponent) {
  const StylizedComponent = function (props) {
    return (
      <div className={style.mainLayout}>
        <Suspense fallback={
          <div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', height: '100vh' }}>
            <BeatLoader 
              color="#FD3C00"
              size={35}
              speedMultiplier={0.5}
            />
          </div>
        }>
          <WrappedComponent {...props} />
        </Suspense>
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
    default:
      return stylized(StartPage)();
  }
}

export default MainLayout;