import { useEffect, useState } from "react";
import style from "./Common.module.css";

function Button({ 
  children, 
  onClick, 
  style: customStyle, 
  className: customClassName, 
  type = "gray",
  disabled = false
}) {
  
  const [typeCss, setTypeCss] = useState(type);
  const [disabledCss, setDisabledCss] = useState('');

  useEffect(() => {
    if(type === "gray"){
      setTypeCss(style.grayBtn);
      setDisabledCss(style.grayBtnDisabled);
    }
    else if(type === "black"){
      setTypeCss(style.blackBtn);
      setDisabledCss(style.blackBtnDisabled);
    }
    else if(type === "white"){
      setTypeCss(style.whiteBtn);
      setDisabledCss(style.whiteBtnDisabled);
    }
    else{
      setTypeCss(style.grayBtn);
      setDisabledCss(style.grayBtnDisabled);
    }
  }, [type, setTypeCss, setDisabledCss]);

  const handleClick = (event) => {
    if (disabled) {
      event.preventDefault();
      return;
    }
    onClick(event);
  }

  return (
      <div 
        className={`${typeCss} ${customClassName} ${disabled ? disabledCss : ''}`}
        style={customStyle}
        onClick={handleClick}
      >
          <span>
            <p>
              {children}
            </p>
          </span>
      </div>

  )
}

export default Button;