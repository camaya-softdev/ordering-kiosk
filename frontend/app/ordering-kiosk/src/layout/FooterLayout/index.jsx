import styles from '../FooterLayout/FooterLayout.module.css';

function FooterLayout({children, style: customStyle, className: customClassName }) {

    return(
        <div className={`${styles.footer} ${customClassName}`} style={customStyle}>
            {children}
        </div>
    );
}

export default FooterLayout;