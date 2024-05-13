import { useEffect, useState } from 'react';
import useFetchOutlets from '../../hooks/useFetchOutlets';
import style from './OutletList.module.css';
import BeatLoader from "react-spinners/BeatLoader";
import OutletCard from './OutletCard';

function OutletList(){
    const { outlets, isOutletsLoading } = useFetchOutlets();
    const [groupedOutlets, setGroupedOutlets] = useState([]);

    useEffect(() => {
        if (outlets && outlets.data) {
            const grouped = outlets.data.reduce((acc, outlet) => {
                const key = outlet.outlet_classification;
                if (!acc[key]) {
                    acc[key] = [];
                }
                acc[key].push(outlet);
                return acc;
            }, {});
            setGroupedOutlets(grouped);
        }
    }, [outlets]);

    return(
        <div className={style.wrapper}>
            {
                isOutletsLoading ?
                <BeatLoader 
                    color="#FD3C00"
                    size={35}
                    speedMultiplier={0.5}
                />
                :
                <div className={style.classificationWrapper}>
                    {
                        Object.entries(groupedOutlets).map(([classification, outlets], index) => (
                            <div key={classification}>
                                <span className={style.classificationText}>{classification}</span>
                                <hr className={style.divider}/>
                                <div 
                                    className={style.outletsWrapper}
                                    style={index === groupedOutlets.length -1 ? {marginBottom: 40} : {marginBottom: 20}}
                                >
                                    {outlets.map(outlet => (
                                        <OutletCard key={outlet.id} outlet={outlet}/>
                                    ))}
                                </div>
                            </div>
                        ))
                    }
                </div>
            }
        </div>
    );
}

export default OutletList;