import { useEffect } from "react";
import useFetchCategories from "../../hooks/useFetchCategories";
import styles from "./OutletOrder.module.css";
import { useDispatch, useSelector } from "react-redux";
import categoryIcon from "../../assets/categories.svg";
import BeatLoader from "react-spinners/BeatLoader";
import { setSelectedCategory } from "../../store/order/orderSlice";
import { LazyLoadImage } from "react-lazy-load-image-component";

function CategoryList() {
  const selectedOutletId = useSelector(
    (state) => state.order.selectedOutlet.id
  );
  const selectedCategory = useSelector((state) => state.order.selectedCategory);
  const { categories, isCategoriesLoading, setCategoriesFilter } =
    useFetchCategories();
  const dispatch = useDispatch();

  useEffect(() => {
    if (selectedOutletId) {
      setCategoriesFilter((prev) => ({ ...prev, outlet_id: selectedOutletId }));
    }
  }, [selectedOutletId]);

  useEffect(() => {
    if (categories?.data?.length > 0 && !selectedCategory) {
      // Find the "Newly Added" category
      const newlyAddedCategory = categories.data.find(
        (category) => category.name === "Newly Added"
      );

      // Select the "Newly Added" category if found
      if (newlyAddedCategory) {
        selectCategory(newlyAddedCategory);
      } else {
        // If "Newly Added" category is not found, select the first category
        selectCategory(categories.data[0]);
      }
    }
  }, [categories, selectedCategory]); // Include selectedCategory to trigger re-selection

  const selectCategory = (category) => {
    if (category.status) {
      dispatch(setSelectedCategory(category));
    }
  };

  const renderCategoryCard = (category, isSelected) => {
    return (
      <div
        onClick={() => selectCategory(category)}
        key={category.id}
        className={`${styles.categoryCard} ${
          isSelected ? styles.selected : ""
        } ${category.status ? "" : "disabled"}`}
      >
        <LazyLoadImage
          src={categoryIcon}
          alt="categoryIcon"
          className={styles.categoryIcon}
        />
        <span className={styles.categoryName}>
          <p>{category.name}</p>
        </span>
        {isSelected && <div className={styles.circle}></div>}
      </div>
    );
  };

  return (
    <div className={styles.categoryWrapper}>
      {isCategoriesLoading ? (
        <div className={styles.loadingIcon}>
          <BeatLoader color="#FD3C00" size={35} speedMultiplier={0.5} />
        </div>
      ) : (
        <>
          {categories?.data?.length > 0 ? (
            <div className={styles.categoryButtons}>
              {categories.data
                .slice() // Create a shallow copy to avoid mutating original array
                .sort((a, b) => {
                  if (a.name === "Newly Added") return -1;
                  if (b.name === "Newly Added") return 1;
                  // Handle null ids by placing them first
                  if (a.id === null && b.id !== null) return -1;
                  if (a.id !== null && b.id === null) return 1;

                  // Sort by id if both ids are not null
                  return (a.id || 0) - (b.id || 0);
                })
                .map((category) =>
                  renderCategoryCard(
                    category,
                    selectedCategory && selectedCategory.id === category.id
                  )
                )}
            </div>
          ) : null}
        </>
      )}
    </div>
  );
}

export default CategoryList;
