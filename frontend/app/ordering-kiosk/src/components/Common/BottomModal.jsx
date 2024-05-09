import styles from "./Common.module.css";

function BottomModal({ 
    children,
    open, 
    onClose, 
    extras,
    title,
    subtitle,
    showTitleDivider = false,
    style
}) {
    if(open){
        return (
            <div 
                className={styles.modalWrapper}
                // onClick={onClose}
                style={style}
            >
                <div 
                    className={styles.modalContent}
                    // onClick={(e) => e.stopPropagation()}
                >
                    {
                        title ? 
                        <div className={styles.modalTitleWrapper}>
                            <div className={styles.modalInnerWrapper}>
                                <span className={styles.modalTitle}>{title}</span>
                                {
                                    showTitleDivider ?
                                    <div className={styles.modalTitleDivider}></div> : null
                                }
                                <span className={styles.modalSubtitle}>{subtitle}</span>
                            </div>
                        </div> : null
                    }
                    
                    {children}

                    {
                        extras ?
                        <div className={styles.modalExtras}>
                            {extras}
                        </div> : null
                    }
                </div>
            </div>
        );
    }

    return null;
}

export default BottomModal;