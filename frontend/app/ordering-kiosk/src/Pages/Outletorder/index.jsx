import style from "./Outletorder.module.css";
import CategoryList from "../../components/Outletorder/CategoryList";
import ProductList from "../../components/Outletorder/ProductList";
import OrderFooter from "../../components/Outletorder/OrderFooter";
import { useSelector } from "react-redux";

const Outletorder = () => {
  const selectedOutlet = useSelector((state) => state.order.selectedOutlet);

  return (
    <div className={style.wrapper}>
      <div className={style.mainWrapper}>
        <div className={style.categoriesWrapper}>
          <div className={style.outletLogo}>
            <img
              src={`${import.meta.env.VITE_API}/${selectedOutlet.image}`}
              alt={selectedOutlet.name}
              className={style.outletLogoImage}
            />
          </div>

          <CategoryList />
        </div>

        <div className={style.productsWrapper}>
          <div className={style.innerWrapper}>
            <ProductList />
          </div>
        </div>
      </div>

      <OrderFooter />
    </div>
  );
};

export default Outletorder;
