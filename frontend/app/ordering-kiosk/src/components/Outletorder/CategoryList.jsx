import { useEffect } from 'react';
import useFetchCategories from '../../hooks/useFetchCategories';
import styles from './CategoryList.module.css';
import { useDispatch, useSelector } from "react-redux";
import categoryIcon from "../../assets/categories.svg";
import BeatLoader from 'react-spinners/BeatLoader';
import { setSelectedCategory } from '../../store/order/orderSlice';

function CategoryList() {
    const selectedOutletId = useSelector(state => state.order.selectedOutlet.id);
    const selectedCategory = useSelector(state => state.order.selectedCategory);
    const {categories, isCategoriesLoading, setCategoriesFilter} = useFetchCategories();
    const dispatch = useDispatch();

    useEffect(() => {
        if(selectedOutletId) {
            setCategoriesFilter((prev) => ({...prev, outlet_id: selectedOutletId}));
        }
    }, [selectedOutletId]);

    useEffect(() => {
        if(categories?.data?.length > 0 && !selectedCategory) {
            selectCategory(categories.data[0]);
        }
    }, [categories]);

    const selectCategory = (category) => {
        dispatch(setSelectedCategory(category));
    }

    const renderCategoryCard = (category, isSelected) => (
        <div 
            onClick={() => selectCategory(category)}
            key={category.name} 
            className={`${styles.categoryCard} ${isSelected ? styles.selected : ''}`}
        >
            <img src={categoryIcon} alt='categoryIcon' className={styles.categoryIcon}/>
            <span className={styles.categoryName}>
                <p>{category.name}</p>
            </span>
            {isSelected && <div className={styles.circle}></div>}
        </div>
    );

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
                        {categories.data
                            .sort((a, b) => {
                                if (a.name === "Newly Added") return -1;
                                if (b.name === "Newly Added") return 1;
                                return a.name.localeCompare(b.name);
                            })
                            .map((category) => renderCategoryCard(category, selectedCategory && selectedCategory.name === category.name))}
                    </div>
                    : null
                }
                </>
            }
        </div>
    );
}

export default CategoryList;