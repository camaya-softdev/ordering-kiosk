import React, { useEffect, useState } from "react";
import style from "./LocationPage.module.css";
import Progress from "../../components/DineOption/Progress";
import Button from "../../components/Common/Button";
import SummaryFooter from "../../components/Outletorder/SummaryFooter";
import CustomDropdown from "../../components/Location/CustomDropdown";
import useFetchLocations from "../../hooks/useFetchLocations";
import useFetchAreas from "../../hooks/useFetchAreas";
import { useDispatch, useSelector } from "react-redux";
import { nextStep, previousStep, setArea, setLocation } from "../../store/order/orderSlice";
import StartOverConfirmation from "../../components/Outletorder/StartOverConfirmation";

const LocationPage = () => {
  const selectedLocation = useSelector((state) => state.order.location);
  const currentUser = useSelector((state) => state.auth.auth);
  const selectedArea = useSelector((state) => state.order.area);
  const [openModals, setOpenModals] = useState({startOver: false});
  const dispatch = useDispatch();

  const {locations, isLocationsLoading, setLocationsFilter} = useFetchLocations();
  const {areas, isAreasLoading, setAreasFilter} = useFetchAreas();

  const handleDropdown1Select = (option) => {
    dispatch(setLocation(option));
    if(selectedLocation?.id !== option.id){
      dispatch(setArea(null));
    }
  };

  const handleDropdown2Select = (option) => {
    dispatch(setArea(option));
  };

  useEffect(() => {
    if (selectedLocation) {
      setAreasFilter((prev) => ({...prev, location_id: selectedLocation.id}));
    }
  }, [selectedLocation, selectedArea]);

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
                  options={locations?.data}
                  defaultOption={selectedLocation ? selectedLocation.name : "Select"}
                  onSelect={handleDropdown1Select}
                  displayProperty="name"
                  loading={isLocationsLoading}    
                  disabled={isLocationsLoading}            
                />
              </div>
              <div className={style.dropdownSelection}>
                <label>Table/Room Number</label>
                <CustomDropdown
                  options={areas?.data}
                  defaultOption={selectedArea ? selectedArea.name : "Select"}
                  onSelect={handleDropdown2Select}
                  loading={isAreasLoading}
                  displayProperty="name"
                  disabled={!selectedLocation || isAreasLoading}
                />
              </div>
              <Button 
                type="black" style={{ width: "100%" }}
                disabled={!selectedLocation || !selectedArea}
                className={`${!selectedLocation || !selectedArea ? 'disabled' : ''}`}
                onClick={() => dispatch(nextStep())}
              >
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
        showLocationDetails={true}
        backOnClick={() => dispatch(previousStep())}
        startOverBtnOnClick={() => setOpenModals({startOver: true})}
      />

      <StartOverConfirmation
        open={openModals.startOver}
        onClose={() => setOpenModals({startOver: false})}
      />
    </>
  );
};

export default LocationPage;
