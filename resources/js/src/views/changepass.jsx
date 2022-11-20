import React, { useState, useEffect, } from 'react';
import axios from 'axios';
import Header from "./header";
import Typography from '@mui/material/Typography';
import TextField from '@mui/material/TextField';
import Backdrop from '@mui/material/Backdrop';
import CircularProgress from '@mui/material/CircularProgress';
import {
    Link,
    useParams
} from "react-router-dom"
import {
    useNavigate
} from "react-router-dom";
import _GLobal_Link from './global';
function ChangePass() {
    const [isloading, setisloading] = useState(false);
    const [errors, seterrors] = useState({
        newPAss: null,
        confirmPass: null
    })
    const { request } = useParams();

    let regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/
    const navigate = useNavigate();
    const send = () => {
        if (errors.newPAss === "" && errors.confirmPass === "") {
            setisloading(true)
            axios.get(_GLobal_Link._link_simple + 'api/updatepass/' +
                document.getElementById('standard-basic').value + "/" + request.trim(), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            }).then((res) => {
                console.log(res)
                if (res.data === "code updated") {
                    navigate("/front-login?message=Your password has been changed. You can now connect!")
                } else {
                    navigate("/")
                }
            })
        } else {
            seterrors(prev => {
                return { ...prev, newPAss: "Minimum eight characters, at least one letter, one number and one special character" }
            })
        }

    }

    const checkAgain = () => {
        if (document.getElementById('standard-basic').value.match(regex)) {
            seterrors(prev => {
                return { ...prev, newPAss: "" }
            })
        } else {
            seterrors(prev => {
                return { ...prev, newPAss: "Minimum eight characters, at least one letter, one number and one special character" }
            })
        }
        if (document.getElementById('standard-basic').value === document.getElementById('standard-basic__').value) {
            seterrors(prev => {
                return { ...prev, confirmPass: "" }
            })
        } else {
            seterrors(prev => {
                return { ...prev, confirmPass: "Password not corresponding" }
            })
        }
    }
    useEffect(() => {
        axios.get(_GLobal_Link._link_simple + 'api/testIfrequestExpire/' + request.trim(), {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true,
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
            },
        }).then((res) => {
           // alert(res.data)
            if (res.data === "code expire") {
                navigate("/front-login?message=The link you tried to access has expired. please request a new link to change your password.")
            }
        })
    })
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
                    <h2>
                        <Typography gutterBottom>
                            New password
                        </Typography>
                    </h2>
                    <div>
                        <div>
                            <TextField onInput={checkAgain} style={{ width: '500px' }} type='password' id="standard-basic" label="New password" variant="standard" />
                        </div>
                        <p style={{ color: 'red' }}>{errors.newPAss}</p>
                        <div>
                            <TextField onInput={checkAgain} style={{ width: '500px' }} type='password' id="standard-basic__" label="Confirm password" variant="standard" />
                        </div>
                        <p style={{ color: 'red' }}>{errors.confirmPass}</p>
                        <div className='confirmcodeBody' onClick={send} style={{ marginTop: "15px" }}>
                            <div className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)' }}>
                                <span> Change password</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ChangePass;
