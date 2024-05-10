import React, { useState, useRef, useEffect } from "react";
import styles from "./CustomDropdown.module.css"; // Import CSS module for styling

function CustomDropdown({ options, defaultOption, onSelect }) {
  const [isOpen, setIsOpen] = useState(false);
  const [selectedOption, setSelectedOption] = useState(defaultOption);
  const dropdownRef = useRef(null);

  useEffect(() => {
    const handleClickOutside = (event) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setIsOpen(false);
      }
    };

    window.addEventListener("click", handleClickOutside);

    return () => {
      window.removeEventListener("click", handleClickOutside);
    };
  }, []);

  const toggleDropdown = () => {
    setIsOpen(!isOpen);
  };

  const handleOptionClick = (option) => {
    setSelectedOption(option);
    setIsOpen(false);
    onSelect(option);
  };

  return (
    <div className={styles.customDropdown} ref={dropdownRef}>
      <div className={styles.selectedOption} onClick={toggleDropdown}>
        {selectedOption || defaultOption}
      </div>
      <ul className={`${styles.options} ${isOpen ? styles.open : ""}`}>
        {options.map((option, index) => (
          <li key={index} onClick={() => handleOptionClick(option)}>
            {option}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default CustomDropdown;
