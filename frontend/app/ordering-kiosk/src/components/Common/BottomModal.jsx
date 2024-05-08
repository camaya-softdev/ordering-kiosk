import styles from "./Common.module.css";

function BottomModal({ 
    children,
    open, 
    onClose, 
    extras,
    title,
    subtitle
}) {
    if(open){
        return (
            <div 
                className={styles.modalWrapper}
                onClick={onClose}
            >
                <div 
                    className={styles.modalContent}
                    onClick={(e) => e.stopPropagation()}
                >
                    <div className={styles.modalTitleWrapper}>
                        <div className={styles.modalInnerWrapper}>
                            <span className={styles.modalTitle}>{title}</span>
                            <span className={styles.modalSubtitle}>{subtitle}</span>
                        </div>
                    </div>
                    
                    <div>{children}</div>

                    <div className={styles.modalExtras}>
                        {extras}
                    </div>
                </div>
            </div>
        );
    }

    return null;
}

export default BottomModal;