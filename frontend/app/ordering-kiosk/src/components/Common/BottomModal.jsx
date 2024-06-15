import { useState, useEffect } from "react";
import styles from "./Common.module.css";

function BottomModal({
  children,
  open,
  extras,
  title,
  subtitle,
  showTitleDivider = false,
  style,
  addProductOrder,
  fullViewModal,
  policyNotice,
}) {
  const [visible, setVisible] = useState(false);
  const [fadeContent, setFadeContent] = useState(false);
  const [animationKey, setAnimationKey] = useState(0); // Add animationKey state

  useEffect(() => {
    if (open) {
      setVisible(true);
      setFadeContent(false);
      setAnimationKey((prevKey) => prevKey + 1); // Increment animationKey to trigger animation
    } else {
      setFadeContent(true);
      const timer = setTimeout(() => {
        setVisible(false);
        setFadeContent(false);
      }, 2000);
      return () => clearTimeout(timer);
    }
  }, [open]);

  let modalContentClass = styles.modalContent;
  if (!addProductOrder && !fullViewModal && !policyNotice) {
    modalContentClass = styles.modalContent;
  } else if (addProductOrder) {
    modalContentClass = styles.modalCenterContent;
  } else if (fullViewModal) {
    modalContentClass = styles.fullModalWrapper;
  } else if (policyNotice) {
    modalContentClass = styles.policyNotice;
  }

  return (
    visible && (
      <div
        className={`${styles.modalWrapper} ${open ? styles.show : ""}`}
        style={style}
      >
        <div
          className={`${modalContentClass} ${
            fadeContent ? styles.fadeOut : ""
          }`}
          key={animationKey}
        >
          {title && (
            <div className={styles.modalTitleWrapper}>
              <div className={styles.modalInnerWrapper}>
                <span className={styles.modalTitle}>{title}</span>
                {showTitleDivider && (
                  <div className={styles.modalTitleDivider}></div>
                )}
                <span className={styles.modalSubtitle}>{subtitle}</span>
              </div>
            </div>
          )}

          {children}

          {extras && <div className={styles.modalExtras}>{extras}</div>}
        </div>
      </div>
    )
  );
}

export default BottomModal;
