import { useState, useRef, useEffect } from "react";
import styles from "./CustomDropdown.module.css";
import BeatLoader from "react-spinners/BeatLoader";
import downIcon from "../../assets/chevron-down.svg";
import upIcon from "../../assets/chevron-up.svg";

function CustomDropdown({ options, defaultOption, onSelect, displayProperty = "name", loading, disabled}) {
  const [isOpen, setIsOpen] = useState(false);
  const [selectedOption, setSelectedOption] = useState(defaultOption);
  const dropdownRef = useRef(null);

  useEffect(() => {
    setSelectedOption(defaultOption);
  }, [defaultOption]);

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
    if (!disabled) {
      setIsOpen(!isOpen);
    }
  };

  const handleOptionClick = (option) => {
    if (!disabled) {
      setSelectedOption(option[displayProperty]); // use the displayProperty
      setIsOpen(false);
      onSelect(option); 
    }
  };

  return (
    <div className={`${styles.customDropdown} ${disabled ? 'disabled' : ""}`} ref={dropdownRef}>
      <div className={styles.selectedOption} onClick={toggleDropdown}>
        {
          loading ? <BeatLoader/> : selectedOption || defaultOption
        }
        <img src={isOpen ? upIcon : downIcon} alt="dropdown icon" />
      </div>
      {
        loading ? null : (
          <ul className={`${styles.options} ${isOpen ? styles.open : ""}`}>
            {options.map((option, index) => (
              <li key={index} onClick={() => handleOptionClick(option)}>
                {option[displayProperty]} 
              </li>
            ))}
          </ul>
        )
      }
    </div>
  );
}

export default CustomDropdown;