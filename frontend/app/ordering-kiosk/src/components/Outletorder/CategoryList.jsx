import { useEffect } from 'react';
import useFetchCategories from '../../hooks/useFetchCategories';
import styles from './CategoryList.module.css';
import { useDispatch, useSelector } from "react-redux";
import categoryIcon from "../../assets/categories.svg";
import BeatLoader from 'react-spinners/BeatLoader';
import { setSelectedCategory } from '../../store/order/orderSlice';

function CategoryList() {
    const selectedOutletId = useSelector(state => state.order.selectedOutlet.id);
    const {categories, isCategoriesLoading, setCategoriesFilter} = useFetchCategories();
    const dispatch = useDispatch();

    useEffect(() => {
        if(selectedOutletId) {
            setCategoriesFilter((prev) => ({...prev, outlet_id: selectedOutletId}));
        }
    }, [selectedOutletId]);

    const selectCategory = (category) => {
        dispatch(setSelectedCategory(category));
    }

    return(
        <div className={styles.categoryWrapper}>
            {
                isCategoriesLoading ?
                <div className={styles.loadingIcon}>
                    <BeatLoader
                        color="#FD3C00"
                        size={35}
                        speedMultiplier={0.5}
                    />
                </div>
                :
                <>
                {
                    categories?.data?.length > 0 ?
                    <div className={styles.categoryButtons}>
                        <div className={styles.categoryCard}>
                            <img src={categoryIcon} alt='categoryIcon' className={styles.categoryIcon}/>
                            <span className={styles.categoryName}>
                                <p>Newly Added</p>
                            </span>
                        </div>

                        {
                            categories.data.map((category) => (
                                <div 
                                    onClick={() => selectCategory(category)}
                                    key={category.id} className={styles.categoryCard}
                                >
                                    <img src={categoryIcon} alt='categoryIcon' className={styles.categoryIcon}/>
                                    <span className={styles.categoryName}>
                                        <p>{category.name}</p>
                                    </span>
                                </div>
                            ))
                        }
                    </div>
                    : null
                }
                </>
            }
        </div>
    );
}

export default CategoryList;