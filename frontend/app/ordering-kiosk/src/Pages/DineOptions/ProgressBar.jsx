import React from "react";

const ProgressBar = ({ value, max = 100 }) => {
  return (
    <div>
      <progress value={value} max={max} />
      <span>{Math.round((value / max) * 100)}%</span>
    </div>
  );
};

export default ProgressBar;
