import React, { useState, useEffect } from 'react';
import '../style/login.css';
import axios from 'axios';
import { useForm } from "react-hook-form";
import CircularProgress from '@mui/material/CircularProgress';
import Alert from '@mui/material/Alert';
import { useDispatch } from 'react-redux';
import loginAction from '../app/actions/loginAction';
import Header from "./header";
import { useSearchParams, } from "react-router-dom";
import PropTypes from 'prop-types';
import Button from '@mui/material/Button';
import { styled } from '@mui/material/styles';
import Dialog from '@mui/material/Dialog';
import DialogTitle from '@mui/material/DialogTitle';
import DialogContent from '@mui/material/DialogContent';
import DialogActions from '@mui/material/DialogActions';
import IconButton from '@mui/material/IconButton';
import CloseIcon from '@mui/icons-material/Close';
import Typography from '@mui/material/Typography';
import TextField from '@mui/material/TextField';

import Backdrop from '@mui/material/Backdrop';

import {
    useNavigate
} from "react-router-dom";
import _GLobal_Link from './global';
function Login() {

    const BootstrapDialog = styled(Dialog)(({ theme }) => ({
        '& .MuiDialogContent-root': {
            padding: theme.spacing(2),
        },
        '& .MuiDialogActions-root': {
            padding: theme.spacing(1),
        },
    }));

    let [searchParams, setSearchParams] = useSearchParams();
    const [showALert, setshowALert] = React.useState(false);
    const [showALertNewpass, setshowALertNewpass] = React.useState(false);

    const dispatch = useDispatch();
    const { register, handleSubmit, formState: { errors } } = useForm();
    const [isloading, setisloading] = useState(false);
    const [registeringError, setregisteringError] = useState(false);
    const [registeringErrorText, setregisteringErrorText] = useState('');
    const [emailErrorText, setremailErrorText] = useState('');

    const [isloadingNew, setisloadingNew] = useState(false);

    const [resetSEntText, setresetSEntText] = useState('');

    const BootstrapDialogTitle = (props) => {
        const { children, onClose, ...other } = props;

        return (
            <DialogTitle sx={{ m: 0, p: 2 }} {...other}>
                {children}
                {onClose ? (
                    <IconButton
                        aria-label="close"
                        onClick={onClose}
                        sx={{
                            position: 'absolute',
                            right: 8,
                            top: 8,
                            color: (theme) => theme.palette.grey[500],
                        }}
                    >
                        <CloseIcon />
                    </IconButton>
                ) : null}
            </DialogTitle>
        );
    };

    BootstrapDialogTitle.propTypes = {
        children: PropTypes.node,
        onClose: PropTypes.func.isRequired,
    };

    const [open, setOpen] = React.useState(false);
    const handleClickOpen = () => {
        setOpen(true);
    };
    const sendNewpass = () => {
        setisloadingNew(true)
        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (document.getElementById('emailReset').value.match(regexEmail)) {
            let email = document.getElementById('emailReset').value;
            setOpen(false);
            axios.get(_GLobal_Link._link_simple + 'api/changepass/' +
                document.getElementById('emailReset').value, {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            }).then((res) => {
                if (res.data === "mail have been sent") {
                    setisloadingNew(false)
                    setresetSEntText("We have sent an e-mail to the address: " + email + ' click on the link in the email to change your password');
                    setshowALertNewpass(true)
                }

            })
        } else {
            setremailErrorText("Please enter a valid email")
        }

    };

    const handleClose = () => {
        setOpen(false);
    }



    const onSubmit = data => {
        setisloading(true)
        axios.get(_GLobal_Link._link_simple + 'api/login/' +
            data.email + '/' + data.password, {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true,
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
            },
        })
            .then((res) => {
                if (res.data !== undefined) {
                    setisloading(false);
                    if (res.data[0] === "Cannot login, check your password or email.") {
                        setregisteringError(true);
                        setregisteringErrorText(res.data)
                    } else if (res.data[0] === 'send to confirmmail') {
                        navigate("/confirmemail/" + res.data[1]);
                    }
                    else {
                        setregisteringError(false)
                        setregisteringErrorText("")
                        localStorage.setItem("session_token", res.data[0])
                        localStorage.setItem("user_name", res.data[1])
                        dispatch(loginAction(true, res.data[1]));
                        navigate("/");
                    }
                }
            });
    }
    const navigate = useNavigate();
    useEffect(() => {
        if (searchParams.get('message') !== null) {
            setshowALert(true)
        }
        if (localStorage.getItem("session_token")) {
            axios.get(_GLobal_Link._link_simple + 'api/connected/' +
                localStorage.getItem("session_token"), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            })
                .then((res) => {
                    console.log(res.data)
                    if (res.data === 'Already connected') {
                        navigate("/")
                    }
                });
        }
    }, []);
    return (
        <div>
            <Header />
            <Backdrop
                sx={{ color: 'var(--base-color)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={isloadingNew}>
                <CircularProgress color="inherit" />
            </Backdrop>
            <div className="carouselBody confirmcodeBody">
                {
                    showALert === true ? <Alert severity="info">{searchParams.get('message')}</Alert> : ''
                }


            </div>
            <div className="carouselBody confirmcodeBody">
                {
                    showALertNewpass === true ? <Alert severity="success">{resetSEntText}</Alert> : ''
                }
            </div>
            <div className="formBodyLogin">
                <form className="form" onSubmit={handleSubmit(onSubmit)}>
                    {registeringError === true ?
                        <div style={{ marginTop: "20px" }}>
                            <Alert severity="error">{registeringErrorText}</Alert>
                        </div> : <></>
                    }
                    <div className="title">Welcome back !</div>
                    <div className="subtitle">Connection</div>

                    {isloading === true ?
                        <div style={{ marginTop: "20px" }}>
                            <CircularProgress />
                        </div> : <></>
                    }
                    <div className='inputBoxBlockLogin'>
                        <div className="input-container ic2">
                            <input {...register("email", { required: true, pattern: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/ })}
                                id="email" className="input" type="email" placeholder=" " />
                            <div className='errors'>
                                {errors.email && "Enter a valid email"}
                            </div>
                            <div className="cut"></div>
                            <label htmlFor={"email"} className="placeholder">E-mail</label>
                        </div>
                        <div className="input-container ic2">
                            <input {...register("password", { required: true, pattern: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/ })}
                                id="password" className="input" type="password" placeholder=" " />
                            <div className='errors'>
                                {errors.password && "Minimum eight characters, at least one letter, one number and one special character"}
                            </div>
                            <div className="cut"></div>
                            <label htmlFor={"password"} className="placeholder">Password</label>
                        </div>
                    </div>
                    <div className='inputBoxBlock'>
                        <div style={{ width: '100%', position: 'relative' }}>
                            <input type='submit' className="submit" value={"Sign in"} />
                        </div>
                    </div>
                    <div>
                        <p style={{ marginLeft: '20px', marginRight: '20px', color: 'gray' }}>By Signing in , you agree to our terms of use. Please read our privacy policy.</p>
                    </div>
                    <div>
                        <Button variant="outlined" style={{ margin: "10px" }} onClick={handleClickOpen}>
                            Forgot your password ?
                        </Button>
                        <BootstrapDialog
                            onClose={handleClose}
                            aria-labelledby="customized-dialog-title"
                            open={open}
                        >

                            <BootstrapDialogTitle id="customized-dialog-title" onClose={handleClose}>
                                Reset my password
                            </BootstrapDialogTitle>
                            <DialogContent dividers>
                                <Typography gutterBottom>
                                    Enter your email and receive a link to reset your password.
                                </Typography>
                                <div>
                                    <TextField id='emailReset' style={{ width: '100%' }}
                                        type='email'
                                        label="Enter your email to receive new password" variant="standard" />
                                </div>
                                <Typography gutterBottom style={{ color: 'red' }}>
                                    {emailErrorText}
                                </Typography>
                            </DialogContent>
                            <DialogActions>
                                <Button autoFocus onClick={sendNewpass}>
                                    Send
                                </Button>
                            </DialogActions>
                        </BootstrapDialog>
                    </div>

                </form>
            </div>
        </div>

    );
}

export default Login;
