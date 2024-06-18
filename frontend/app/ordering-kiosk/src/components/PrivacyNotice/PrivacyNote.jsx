import React, { useState } from "react";
import BottomModal from "../Common/BottomModal";
import style from "./PrivacyNote.module.css";
import Button from "../Common/Button";
import ConfirmGCashPayment from "../../components/GCashScanPage/ConfirmGCashPayment";

const PrivacyNote = ({ open, onClose }) => {
  const [openModal, setOpenModal] = useState({
    confirmPayment: false,
  });

  const handleClose = () => {
    onClose();
  };

  const handleAgree = () => {
    setOpenModal({ confirmPayment: true });
    handleClose();
  };

  return (
    <>
      <BottomModal open={open} onClose={handleClose} policyNotice={true}>
        <div className={style.container}>
          <div className={style.topContainer}>
            <div className={style.titleWrapper}>PRIVACY NOTICE</div>
            <div className={style.bodyWrapper}>
              <strong className={style.titleBody}>POLICY STATEMENT</strong>
              <div className={style.descriptionBody}>
                Earth and Shore Leisure Communities Corporation (ESLCC), its
                affiliates and/or subsidiaries and related companies respect the
                value and importance of the right to privacy of every
                individual. We are committed that all Personal information are
                protected and processed under Data Privacy Act or Republic Act
                No. 10173 including its Implementing Rules and Regulations
                (IRR). We collect, process and store personal data about you
                when you avail of our products and services including our
                websites and mobile applications, third party social networks,
                apply for a job with us, or enter into any contract with us
                provided that you have given your express consent.
              </div>
              <br />
              <br />
              <strong className={style.titleBody}>
                PERSONAL INFORMATION COLLECTION
              </strong>
              <div className={style.descriptionBody}>
                <ul>
                  We collect the following personal information from you when
                  you perform the following activities:
                  <li>
                    I. When you interact with our property consultants,
                    reservation officers, customer relation management officers,
                    and other employees and specialists through
                  </li>
                  <li>
                    II. email, telephone, chat services, or face-to-face
                    meetings;
                  </li>
                  <li>
                    III. When you purchase or avail any of products, services,
                    promos, activities and events;
                  </li>
                  <li>
                    IV. When you submit information through manual and online
                    forms on our digital assets (i.e., websites, applications)
                    or contact us through any of our social media accounts
                    (i.e., Facebook, Twitter, Instagram, LinkedIn, including any
                    other social media platforms);
                  </li>
                  <li>
                    V. When you register, maintain, or use our digital
                    platforms, including our mobile applications;
                  </li>
                  <li>
                    VI. When you provide personal information to our customer
                    relation management officers and other employees and
                    departments relative to your inquiries, requests, and
                    complaints;{" "}
                  </li>
                  <li>
                    VII. When you visit our premises with CCTV surveillance
                    camera that are used for safety and security purposes of our
                    employees, guests, and other visitors of our offices,
                    terminals, transport services, and resorts;{" "}
                  </li>
                  <li>
                    VIII. When you respond to our surveys, promotions, and other
                    sales and marketing initiatives and activities;
                  </li>
                  <li> IX. When you apply for a job;</li>
                  <li>
                    X. When you referred to us by third parties or business
                    partners; and
                  </li>
                  <li>
                    XI. When you submit your personal information to us for any
                    other reason.
                  </li>
                </ul>
              </div>
              <br />
              <br />
              <strong className={style.titleBody}>
                GENERAL USAGE OF PERSONAL INFORMATION
              </strong>
              <div className={style.descriptionBody}>
                <ul>
                  <li>I. Comply with the requirements of your account;</li>
                  <li>
                    II. Provide you with product and services that you have
                    requested, including customer support;
                  </li>
                  <li>
                    III. Communication of relevant services, advisories, and
                    response to your concerns, queries, requests and complaints;
                  </li>
                  <li>
                    IV. Providing you with information about our upcoming
                    products, transport services, promos and other related
                    services which may be if interest to you;
                  </li>
                  <li>
                    V. Compliance with the requirements of the law and legal
                    proceedings, such as court orders, and legal obligations;
                    prevention of imminent harm to the public; and ensuring
                    public security, safety, and order;
                  </li>
                  <li>
                    VI. Processing of information for statistical, analytical,
                    and research purposes;
                  </li>
                  <li> VII. Conduct appropriate due diligence checks; </li>
                  <li>
                    VIII. Registering your inquiry and attending to your
                    follow-up calls;
                  </li>
                  <li>
                    IX. Sales and marketing documentation and any other
                    documentation as may be imposed;
                  </li>
                  <li>
                    X. In the performance of financial processes related to
                    sale: down payment, amortization, and other related fees;
                  </li>
                  <li>
                    XI. In management of unit or lot turn-over activities; and
                  </li>
                  <li>
                    XII. Coordination of advisories, notices and changes to the
                    purchased unit or lot.
                  </li>
                </ul>
              </div>
              <br />
              <br />
              <strong className={style.titleBody}>POLICY UPDATES</strong>
              <div className={style.descriptionBody}>
                We will continue to enhance our online services. We will update
                new features and services from time to time without prior
                notice.
              </div>
              <br />
              <br />
              <strong className={style.titleBody}>CONTACT US</strong>
              <div className={style.descriptionBody}>
                For comments, questions, or queries relating to this privacy
                policy or complaints in relation to your rights under this
                privacy policy, you may get in touch with:
                daniel.lapus@camayacoast.com
              </div>
            </div>
          </div>
          <div className={style.bottomContainer}>
            <Button
              type="black"
              onClick={handleAgree}
              style={{ width: "100%" }}
            >
              I agree to the Terms and Conditions and Privacy Policy
            </Button>
            <Button onClick={handleClose} style={{ width: "100%" }}>
              Go back
            </Button>
          </div>
        </div>
      </BottomModal>
      <ConfirmGCashPayment
        open={openModal.confirmPayment}
        onClose={() => setOpenModal({ confirmPayment: false })}
      />
    </>
  );
};

export default PrivacyNote;
