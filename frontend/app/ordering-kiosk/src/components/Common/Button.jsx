import { useEffect, useState } from "react";
import style from "./Button.module.css";

function Button({ children, onClick, style: customStyle, className: customClassName, type = "gray" }) {
  
  const [typeCss, setTypeCss] = useState(type);

  useEffect(() => {
    if(type === "gray"){
      setTypeCss(style.grayBtn);
    }
    else if(type === "black"){
      setTypeCss(style.blackBtn);
    }
    else if(type === "white"){
      setTypeCss(style.whiteBtn);
    }
    else{
      setTypeCss(style.grayBtn);
    }
  }, [type, setTypeCss]);

  return (
      <div 
        className={`${typeCss} ${customClassName}`}
        style={customStyle}
        onClick={onClick}
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