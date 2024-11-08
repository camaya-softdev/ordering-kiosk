import style from "./Outletorder.module.css";
import CategoryList from "../../components/Outletorder/CategoryList";
import ProductList from "../../components/Outletorder/ProductList";
import OrderFooter from "../../components/Outletorder/OrderFooter";
import { useSelector } from "react-redux";
import LoginModal from "../../components/Login/LoginModal";
import { LazyLoadImage } from 'react-lazy-load-image-component';

const Outletorder = () => {
  const selectedOutlet = useSelector((state) => state.order.selectedOutlet);
  const classAnimate = useSelector((state) => state.order.classAnimate);

  return (
    <div className={`${style[classAnimate]}`}>
      <div className={style.mainWrapper}>
        <div className={style.categoriesWrapper}>
          <div className={style.outletLogo}>
            <LazyLoadImage
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
      <LoginModal/>
    </div>
  );
};

export default Outletorder;
