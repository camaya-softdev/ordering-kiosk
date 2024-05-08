import styles from "./Common.module.css";

function BottomModal({ children, open, onClose, extra }) {
    if(open){
        return (
            <div className={styles.modalWrapper}>
                <div className={styles.modalContent}>
                    {children}
                </div>
            </div>
        );
    }

    return null;
}

export default BottomModal;