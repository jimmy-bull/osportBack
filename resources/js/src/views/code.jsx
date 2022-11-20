import React, { useState, useEffect, } from 'react';

import {
    useParams
} from "react-router-dom";
import Header from "./header";
import _GLobal_Link from './global';
import ReactCodeInput from 'react-verification-code-input';
import axios from 'axios';
import Alert from '@mui/material/Alert';
import {
    useNavigate
} from "react-router-dom";
import Backdrop from '@mui/material/Backdrop';
import CircularProgress from '@mui/material/CircularProgress';
const Remembercode = () => {
    const navigate = useNavigate();
    const [isloading, setisloading] = useState(false);

    const { email } = useParams();
    const [ErrorText, setErrorText] = useState('');
    const [bidValueFieldError, setbidValueFieldError] = useState(false);

    const send = (e) => {
        setisloading(true)
        axios.get(_GLobal_Link._link_simple + 'api/confirmemail/' + e, {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true,
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
            },
        }).then((res) => {
            if (res.data === 'updated') {
                setisloading(false)
                navigate("/front-login?message=Your code is good, you can now log in");
            } else {
                setisloading(false)
                setbidValueFieldError(true)
                setErrorText("this code is expire or it invalid")
            }
        })
    }
    return (
        <div>
            <Header />
            <Backdrop
                sx={{ color: 'var(--base-color)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={isloading}>
                <CircularProgress color="inherit" />
            </Backdrop>
            <div className="carouselBody confirmcodeBody">
                <div>
                    {
                        bidValueFieldError === true ? <Alert severity="error">{ErrorText}</Alert> : ''
                    }
                    <h1 style={{ textAlign: 'center' }}>Check the code contained in your e-mail</h1>
                    <h4 style={{ color: '#454245', textAlign: 'center' }}>
                        We sent a 6-digit code to {email}. Please enter the code quickly, as it will expire in 30 minutes.
                    </h4>
                    <div className='confirmcodeBody'>
                        <ReactCodeInput fields={6} onComplete={(e) => { send(e) }} />
                    </div>
                    {/* <div className='confirmcodeBody' style={{ marginTop: "15px" }}>
                        <div className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)' }}>
                            <span>Resend code</span>
                        </div>
                    </div> */}
                </div>
            </div>
        </div>
    );
}

export default Remembercode;
