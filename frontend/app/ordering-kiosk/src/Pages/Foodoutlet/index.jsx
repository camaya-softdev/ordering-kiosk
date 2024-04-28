import React, { useState } from "react";
import armynavylogo from "../../assets/army-navy-logo.png";
import dencioslogo from "../../assets/dencios_logo.png";
import pancakelogo from "../../assets/pancake_house_logo.png";
import camayalogo from "../../assets/camaya-logo.svg";
import figarologo from "../../assets/figaro_logo.png";
import ucclogo from "../../assets/ucc_logo.png";
import Outletorder from "../Outletorder/index";

import style from "./Foodoutlet.module.css";

const Foodoutlet = ({ onGoBack }) => {
  const [pickOrderPage, setPickOrderPage] = useState(true); // State to manage visibility of Order button

  // Function to toggle visibility of Order button
  const toggleOrderButton = () => {
    setPickOrderPage(!pickOrderPage);
  };

  return (
    <>
      {pickOrderPage ? (
        <div className={style.mainContainer}>
          <div className={style.pic} />
          <div className={style.box}>
            <span className={style.text}>Choose a food outlet</span>
            <div className={style.box2}>
              <div className={style.wrapper}>
                <div className={style.section}>
                  <span className={style.text2}>Restaurants</span>
                  <div className={style.box3} />
                </div>
                <div className={style.group}>
                  <div className={style.section2} onClick={toggleOrderButton}>
                    <div className={style.pic2} />
                  </div>
                  <div className={style.box4}>
                    <div className={style.img} />
                  </div>
                  <div className={style.wrapper2}>
                    <div className={style.img2} />
                  </div>
                </div>
              </div>
              <div className={style.box5}>
                <div className={style.wrapper3}>
                  <span className={style.text3}>Coffee</span>
                  <div className={style.group2} />
                </div>
                <div className={style.wrapper4}>
                  <div className={style.wrapper5}>
                    <div className={style.pic3} />
                  </div>
                  <div className={style.section3}>
                    <div className={style.img3} />
                  </div>
                </div>
              </div>
            </div>
            {/* <div className={style.pic4} /> */}
            <div className={style.group3} onClick={onGoBack}>
              <div className={style.box6}>
                <div className={style.group4}>
                  <div className={style.section4}>
                    <span className={style.text4}>Go back</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      ) : (
        <Outletorder onGoBack={toggleOrderButton} />
      )}
    </>
  );
};

export default Foodoutlet;
