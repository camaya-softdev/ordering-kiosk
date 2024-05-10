import React, { useState } from "react";
import style from "./LocationPage.module.css";
import Progress from "../../components/DineOption/Progress";
import Button from "../../components/Common/Button";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import CustomDropdown from "../../components/Location/CustomDropdown";
const LocationPage = () => {
  const [selectedOption1, setSelectedOption1] = useState("");
  const [selectedOption2, setSelectedOption2] = useState("");

  const options1 = ["Option 1", "Option 2", "Option 3"];
  const options2 = ["Option A", "Option B", "Option C"];

  const handleDropdown1Select = (option) => {
    setSelectedOption1(option);
  };

  const handleDropdown2Select = (option) => {
    setSelectedOption2(option);
  };
  return (
    <>
      <div className={style.topContainer}>
        <Progress width={40} />
      </div>
      <div className={style.mainContainer}>
        <div className={style.wrapper}>
          <span className={style.text}>Where is your location?</span>
          <div className={style.section}>
            <div className={style.wrapperOption}>
              <div className={style.dropdownSelection}>
                <label>Location</label>
                <CustomDropdown
                  options={options1}
                  defaultOption="Select"
                  onSelect={handleDropdown1Select}
                />
              </div>
              <div className={style.dropdownSelection}>
                <label>Table/Room Number</label>
                <CustomDropdown
                  options={options2}
                  defaultOption="Select"
                  onSelect={handleDropdown2Select}
                />
              </div>
              <Button type="black" disabled style={{ width: "100%" }}>
                Proceed to checkout
              </Button>
            </div>
          </div>
        </div>
        <div className={style.circleBlur}></div>
      </div>
      <SummaryFooter
        showBackBtn={true}
        showStartOver={true}
        showDiningDetails={true}
      />
    </>
  );
};

export default LocationPage;
