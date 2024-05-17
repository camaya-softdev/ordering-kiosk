import styles from "./GCashScanPage.module.css";

function CustomInputField({
    label,
    value,
    placeholder,
    onChange,
    onFocus,
    error,
    onBlur,
    type = "text"
}){

    return(
        <div className={styles.fieldWrapper}>
            <div className={styles.labels}>
                <label>{label}</label>
            </div>

            <div className={styles.fieldInput}>
                <input 
                    placeholder={placeholder} 
                    value={value}
                    onChange={onChange} 
                    onFocus={onFocus}
                    onBlur={onBlur}
                    type={type}
                />
                {error && <div className={styles.errorMessage}>{error}</div>}
            </div>
        </div>
    );
}
export default CustomInputField;