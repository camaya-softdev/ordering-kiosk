import style from "./Outletorder.module.css";
import CategoryList from "../../components/Outletorder/CategoryList";
import ProductList from "../../components/Outletorder/ProductList";
import OrderFooter from "../../components/Outletorder/OrderFooter";
import { useSelector } from "react-redux";

const Outletorder = () => {
  const selectedOutlet = useSelector(state => state.order.selectedOutlet);

  return (
    <div>
      <div className={style.mainWrapper}>
        <div className={style.categoriesWrapper}>
          <div className={style.outletLogo}>
            <img 
              src={`${import.meta.env.VITE_API}/${selectedOutlet.image}`} 
              alt={selectedOutlet.name}
              className={style.outletLogoImage}
            />
          </div>
          
          <CategoryList/>
        </div>

        <div className={style.productsWrapper}>
          <ProductList/>
        </div>
      </div>

      <OrderFooter/>
    </div>
  );
};

export default Outletorder;
