import style from "./Outletorder.module.css";
import { useDispatch } from "react-redux";
import CategoryList from "../../components/Outletorder/CategoryList";
import ProductList from "../../components/Outletorder/ProductList";
import OrderFooter from "../../components/Outletorder/OrderFooter";

const Outletorder = () => {
  const dispatch = useDispatch();

  return (
    <div>
      <div className={style.mainWrapper}>
        <div className={style.categoriesWrapper}>
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
