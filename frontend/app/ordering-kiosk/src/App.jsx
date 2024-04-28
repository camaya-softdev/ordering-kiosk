import React, { useState } from "react";
import "./index.css";
import "./App.css";
import Foodoutlet from "./Pages/Foodoutlet/index";

function App() {
  const [showOrderButton, setShowOrderButton] = useState(true); // State to manage visibility of Order button

  // Function to toggle visibility of Order button
  const toggleOrderButton = () => {
    setShowOrderButton(!showOrderButton);
  };

  return (
    <>
      {/* Render the button or Foodoutlet component based on showOrderButton */}
      {showOrderButton ? (
        <div className="main-container">
          <div className="img" />
          <div className="img-2">
            <div className="img-3" />
            <div className="pic" />
            <div className="section">
              <span className="text" onClick={toggleOrderButton}>
                Start Order
              </span>
            </div>
          </div>
        </div>
      ) : (
        <Foodoutlet onGoBack={toggleOrderButton} /> // Pass the callback function
      )}
    </>
  );
}

export default App;
