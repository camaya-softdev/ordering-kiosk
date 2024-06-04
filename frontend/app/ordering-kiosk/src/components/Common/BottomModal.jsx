import { useState, useEffect } from "react";
import styles from "./Common.module.css";

function BottomModal({
  children,
  open,
  onClose,
  extras,
  title,
  subtitle,
  showTitleDivider = false,
  style,
}) {
  const [visible, setVisible] = useState(false);
  const [fadeContent, setFadeContent] = useState(false);

  useEffect(() => {
    if (open) {
      setVisible(true);
      setFadeContent(false);
    } else {
      setFadeContent(true);
      const timer = setTimeout(() => {
        setVisible(false);
        setFadeContent(false);
      }, 2000);
      return () => clearTimeout(timer);
    }
  }, [open]);

  return (
    visible && (
      <div
        className={`${styles.modalWrapper} ${open ? styles.show : ""}`}
        style={style}
      >
        <div
          className={`${styles.modalContent} ${
            fadeContent ? styles.fadeOut : ""
          }`}
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
