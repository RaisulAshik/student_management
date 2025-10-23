import React, { Component } from "react";

import "./Footer.css";
class Footer extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }
    render() {
        return (
            <div id="contact" className="">
                <footer>
                    <div className="container-fluid">
                        <div className="container">
                            <div
                                className="row justify-content-center pt-4 pb-4"
                                style={{ borderBottom: "1px solid #fff" }}
                            >
                                <div className="col-md-4">
                                    <img
                                        src={require("../../../assests/images/logo.png")}
                                        width="200px"
                                        height="250px"
                                        style={{ marginTop: ".5rem" ,height:'6rem'}}
                                    />
                                    <p style={{fontSize:'20px'}}>
                                        A journey to excellence
                                    </p>
                                </div>
                                <div className="col-md-8 p-0">
                                    <div className="row justify-content-center">
                                        <div className="col-md-4">
                                            <h4>Services</h4>
                                            <ul className="footer-list">
                                                <li>SSC</li>
                                                <li>HSC</li>
                                                <li>Engineering Admission</li>
                                                <li>Medical Admission</li>
                                            </ul>
                                        </div>
                                        <div className="col-md-4">
                                            <h4>Support</h4>

                                            <ul className="footer-list">
                                                <li>FAQ</li>
                                                <li>Terms & Conditions</li>
                                            </ul>
                                        </div>
                                        <div className="col-md-4">
                                            <h4>Address</h4>

                                            <ul className="footer-list">
                                                <li>House #7</li>
                                                <li>Road #11</li>
                                                <li>Sector #6</li>
                                                <li>Uttara, Dhaka-1230</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="text-center pt-4">
                                Copyright ©2023 All rights reserved | Powered by Codegigz
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        );
    }
}
export default Footer;
