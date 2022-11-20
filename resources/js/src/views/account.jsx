import React, { useLayoutEffect, useState, useEffect, useMemo } from "react";
import Header from "./header";
import ScrollToTop from "react-scroll-to-top";
import PropTypes from 'prop-types';
import Tabs from '@mui/material/Tabs';
import Tab from '@mui/material/Tab';
import Typography from '@mui/material/Typography';
import Box from '@mui/material/Box';
import { styled } from '@mui/material/styles';
import ArrowForwardIosSharpIcon from '@mui/icons-material/ArrowForwardIosSharp';
import MuiAccordion from '@mui/material/Accordion';
import MuiAccordionSummary from '@mui/material/AccordionSummary';
import MuiAccordionDetails from '@mui/material/AccordionDetails';
import _GLobal_Link from './global';
import axios from 'axios';
import { Link } from "react-router-dom";
import Skeleton from '@mui/material/Skeleton';
import Alert from '@mui/material/Alert';
import '../style/personnal.css'

import Dialog from '@mui/material/Dialog';
import DialogTitle from '@mui/material/DialogTitle';
import DialogContent from '@mui/material/DialogContent';
import DialogActions from '@mui/material/DialogActions';
import IconButton from '@mui/material/IconButton';
import CloseIcon from '@mui/icons-material/Close';
import Divider from '@mui/material/Divider';

import TextField from '@mui/material/TextField';
import CircularProgress from '@mui/material/CircularProgress';
import Backdrop from '@mui/material/Backdrop';
import { IonIcon } from "react-ion-icon";
import { useDispatch } from 'react-redux';
import loginAction from '../app/actions/loginAction';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';

import Userspace from '../components/userspace'
import {
    useNavigate
} from "react-router-dom";
function TabPanel(props) {
    const { children, value, index, ...other } = props;
    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`vertical-tabpanel-${index}`}
            aria-labelledby={`vertical-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box sx={{ p: 3 }}>
                    <Typography>{children}</Typography>
                </Box>
            )}
        </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.number.isRequired,
    value: PropTypes.number.isRequired,
};

function a11yProps(index) {
    return {
        id: `vertical-tab-${index}`,
        'aria-controls': `vertical-tabpanel-${index}`,
    };
}

const Accordion = styled((props) => (
    <MuiAccordion disableGutters elevation={0} square {...props} />
))(({ theme }) => ({
    border: `1px solid ${theme.palette.divider}`,
    '&:not(:last-child)': {
        borderBottom: 0,
    },
    '&:before': {
        display: 'none',
    },
}));

const AccordionSummary = styled((props) => (
    <MuiAccordionSummary
        expandIcon={<ArrowForwardIosSharpIcon sx={{ fontSize: '0.9rem' }} />}
        {...props}
    />
))(({ theme }) => ({
    backgroundColor:
        theme.palette.mode === 'dark'
            ? 'rgba(255, 255, 255, .05)'
            : 'rgba(0, 0, 0, .03)',
    flexDirection: 'row-reverse',
    '& .MuiAccordionSummary-expandIconWrapper.Mui-expanded': {
        transform: 'rotate(90deg)',
    },
    '& .MuiAccordionSummary-content': {
        marginLeft: theme.spacing(1),
    },
}));

const AccordionDetails = styled(MuiAccordionDetails)(({ theme }) => ({
    padding: theme.spacing(2),
    borderTop: '1px solid rgba(0, 0, 0, .125)',
}));

function Account() {
    const navigate = useNavigate();

    useEffect(() => {
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
                    console.log(localStorage.getItem("session_token"))
                    if (res.data !== 'Already connected') {
                        navigate("/")
                    }
                });
        } else {
            navigate("/")
        }
    }, []);

    const [userData, setuserData] = useState([]);
    useEffect(() => {
        if (localStorage.getItem("session_token")) {
            axios.get(_GLobal_Link._link_simple + 'api/userinfo/' +
                localStorage.getItem("session_token"), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            })
                .then((res) => {
                    setuserData(res.data)
                });
        }
    }, []);

    const [mybids, setmybids] = useState([]);
    const [isloading, setisloading] = useState(true);
    useEffect(() => {
        if (localStorage.getItem("session_token")) {
            axios.get(_GLobal_Link._link_simple + 'api/getbidsonspace/' + localStorage.getItem("session_token"), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            }).then((res) => {
                setisloading(false)
                console.log(res.data)
                setmybids(res.data);

            });
        }
    }, [])

    const [value, setValue] = React.useState(0);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    const [expanded, setExpanded] = React.useState('panel1');

    const handleChange_accordion = (panel) => (event, newExpanded) => {
        setExpanded(newExpanded ? panel : false);
    };
    // Update the count down every 1 second
    const counterDate = (countDownDate, id) => {
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = new Date(countDownDate).getTime() - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if (document.getElementById(id) !== null) {
            document.getElementById(id).innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        }
    }

    const BootstrapDialog = styled(Dialog)(({ theme }) => ({
        '& .MuiDialogContent-root': {
            padding: theme.spacing(2),
        },
        '& .MuiDialogActions-root': {
            padding: theme.spacing(1),
        },
    }));

    const [open, setOpen] = React.useState(false);
    const [open2, setOpen2] = React.useState(false);
    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClickOpen2 = () => {
        setOpen2(true);
    };

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


    const handleClose = () => {
        setOpen(false);
    }
    const dispatch = useDispatch();


    const handleClose2 = () => {
        setOpen2(false);
    }
    const [isloadingNew, setisloadingNew] = useState(false);

    const [namemanagement, setnamemanagement] = useState({
        first: false,
        second: false,
        message1: "",
        message2: ""
    });
    const updateName = () => {
        let regName = /^[a-zA-Z-0-9]{2,}$/;

        if (document.getElementById('firstname').value.trim() === "") {

            setnamemanagement(prev => {
                return {
                    ...prev, first: true, message1: "This field is required."
                }
            })
        } else if (!document.getElementById('firstname').value.match(regName)) {
            setnamemanagement(prev => {
                return {
                    ...prev, first: true, message1: "please enter a text with at least two characters ."
                }
            })
        } else {
            setnamemanagement(prev => {
                return {
                    ...prev, first: false, message1: ""
                }
            })
        }



        if (document.getElementById('lastname').value.trim() === "") {

            setnamemanagement(prev => {
                return {
                    ...prev, second: true, message2: "This field is required."
                }
            })
        } else if (!document.getElementById('lastname').value.match(regName)) {
            setnamemanagement(prev => {
                return {
                    ...prev, second: true, message2: "please enter a text with at least two characters ."
                }
            })
        } else {
            setnamemanagement(prev => {
                return {
                    ...prev, second: false, message2: ""
                }
            })
        }


        if (localStorage.getItem("session_token") && document.getElementById('firstname').value.match(regName)
            && document.getElementById('lastname').value.match(regName)) {
            setisloadingNew(true)
            axios.get(_GLobal_Link._link_simple + 'api/updatename/' + document.getElementById('firstname').value + '/'
                + document.getElementById('lastname').value + "/" + localStorage.getItem("session_token"), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            }).then((res) => {
                setisloadingNew(false)
                alert(res.data)
                window.location.reload();
                // setmybids(res.data);
            });
        }

    }


    const checkfieldoninpout_3 = (e) => {
        setnamemanagement(prev => {
            return {
                ...prev, first: false, message1: ""
            }
        })
    }

    const checkfieldoninpout_4 = (e) => {
        setnamemanagement(prev => {
            return {
                ...prev, second: false, message2: ""
            }
        })
    }

    const [emailmanagement, setemailmanagement] = useState({
        first: false,
        second: false,
        third: false,
        message1: "",
        message2: "",
        message3: ""
    })


    const updateEmail = () => {
        let regexEmail = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        let regexPass = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

        if (document.getElementById('email_account_1').value.trim() === "") {

            setemailmanagement(prev => {
                return {
                    ...prev, first: true, message1: "This field is required."
                }
            })
        } else if (!document.getElementById('email_account_1').value.match(regexEmail)) {
            setemailmanagement(prev => {
                return {
                    ...prev, first: true, message1: "please enter a correct email address."
                }
            })
        } else {
            setemailmanagement(prev => {
                return {
                    ...prev, first: false, message1: ""
                }
            })
        }


        if (document.getElementById('email_account_2').value.trim() === "") {

            setemailmanagement(prev => {
                return {
                    ...prev, second: true, message2: "This field is required."
                }
            })
        } else if (!document.getElementById('email_account_2').value.match(regexEmail)) {
            setemailmanagement(prev => {
                return {
                    ...prev, second: true, message2: "please enter a correct email address."
                }
            })
        } else {
            setemailmanagement(prev => {
                return {
                    ...prev, second: false, message2: ""
                }
            })
        }


        if (document.getElementById('password_account_1').value.trim() === "") {

            setemailmanagement(prev => {
                return {
                    ...prev, third: true, message3: "This field is required."
                }
            })
        } else if (!document.getElementById('password_account_1').value.match(regexPass)) {
            setemailmanagement(prev => {
                return {
                    ...prev, third: true, message3: "Minimum eight characters, at least one letter, one number and one special character."
                }
            })
        } else {
            setemailmanagement(prev => {
                return {
                    ...prev, third: false, message3: ""
                }
            })
        }

        if (document.getElementById('password_account_1').value.match(regexPass)
            && document.getElementById('email_account_1').value.match(regexEmail) && document.getElementById('email_account_2').value.match(regexEmail)) {
            setisloadingNew(true)
            axios.get(_GLobal_Link._link_simple + 'api/updateemail/' + document.getElementById('email_account_2').value
                + "/" + document.getElementById('password_account_1').value + "/" + document.getElementById('email_account_1').value, {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            }).then((res) => {
                if (res.data.trim() !== 'This email already exist, please try to enter a different email or login.' && res.data.trim() !== 'Cannot login, check your password or email.') {
                    localStorage.removeItem("session_token");
                    localStorage.removeItem("user_name");
                    dispatch(loginAction(false, ""));
                    //setisloadingNew(false)
                    navigate("/confirmemail/" + res.data);
                } else {
                    alert(res.data)
                    setisloadingNew(false)
                }
                // setmybids(res.data);
            });
        }

    } // bulljimmypro@gmail.com  


    const checkfieldoninpout_5 = (e) => {
        setemailmanagement(prev => {
            return {
                ...prev, first: false, message1: ""
            }
        })
    }
    const checkfieldoninpout_6 = (e) => {
        setemailmanagement(prev => {
            return {
                ...prev, second: false, message2: ""
            }
        })
    }

    const checkfieldoninpout_7 = (e) => {
        setemailmanagement(prev => {
            return {
                ...prev, third: false, message3: ""
            }
        })
    }


    const [passwordmanagement, setpasswordmanagement] = useState({
        first: false,
        second: false,
        message1: "",
        message2: ""
    });

    const checkfieldoninpout_1 = (e) => {
        setpasswordmanagement(prev => {
            return {
                ...prev, first: false, message1: ""
            }
        })
    }
    const checkfieldoninpout_2 = (e) => {
        setpasswordmanagement(prev => {
            return {
                ...prev, second: false, message2: ""
            }
        })
    }




    const updatepass = () => {


        let regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/

        if (document.getElementById('oldpass').value.trim() === "") {

            setpasswordmanagement(prev => {
                return {
                    ...prev, first: true, message1: "This field is required."
                }
            })
        } else if (!document.getElementById('oldpass').value.match(regex)) {
            setpasswordmanagement(prev => {
                return {
                    ...prev, first: true, message1: "Minimum eight characters, at least one letter, one number and one special character."
                }
            })
        } else {
            setpasswordmanagement(prev => {
                return {
                    ...prev, first: false, message1: ""
                }
            })
        }

        if (document.getElementById('newpass').value.trim() === "") {
            setpasswordmanagement(prev => {
                return {
                    ...prev, second: true, message2: "This field is required."
                }
            })
        }
        else if (!document.getElementById('newpass').value.match(regex)) {
            setpasswordmanagement(prev => {
                return {
                    ...prev, second: true, message2: "Minimum eight characters, at least one letter, one number and one special character."
                }
            })
        }
        else {
            setpasswordmanagement(prev => {
                return {
                    ...prev, second: false, message2: ""
                }
            })
        }

        if (localStorage.getItem("session_token") && document.getElementById('newpass').value.match(regex)
            && document.getElementById('oldpass').value.match(regex)) {
            if (passwordmanagement.first === false && passwordmanagement.second === false) {
                axios.get(_GLobal_Link._link_simple + 'api/updatepass/' + document.getElementById('oldpass').value
                    + "/" + document.getElementById('newpass').value + "/" + localStorage.getItem("session_token"), {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true,
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                    },
                }).then((res) => {

                    if (res.data !== 'Cannot login, check your current password.') {
                        // localStorage.removeItem("session_token");
                        // localStorage.removeItem("user_name");
                        // dispatch(loginAction(false, ""));
                        setisloadingNew(false)
                        // navigate("/confirmemail/" + res.data);

                        alert(res.data)
                    } else {
                        alert(res.data)
                    }
                    // setmybids(res.data);
                });
            }
        }


    }

    const memoNameBody = (open) => {
        return (
            <BootstrapDialog
                onClose={handleClose}
                aria-labelledby="customized-dialog-title"
                open={open}
            >
                <BootstrapDialogTitle id="customized-dialog-title" onClose={handleClose}>
                    Update my informations
                </BootstrapDialogTitle>
                <DialogContent dividers style={{ flex: 1 }}>
                    <Typography gutterBottom>
                        Fill in these fields to edit your information
                    </Typography>
                    <div>
                        <TextField id='firstname' style={{ width: '100%' }}
                            type='text' error={namemanagement.first} helperText={namemanagement.message1}
                            label="Enter new first name" variant="standard" />
                    </div>
                    <div>
                        <TextField id='lastname' style={{ width: '100%' }}
                            type='text' error={namemanagement.second} helperText={namemanagement.message2}
                            label="Enter new Last name" variant="standard" />
                    </div>

                    <div onClick={updateName} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)', width: "100%", marginTop: "10px" }}>
                        <span>Update</span>
                    </div>

                </DialogContent>
                <DialogActions>
                    {/* <Button autoFocus onClick={sendNewpass}>
                    Send
                </Button> */}
                </DialogActions>
            </BootstrapDialog>
        )
    }
    const memoName = useMemo(() => memoNameBody(open), [open, namemanagement]);


    return (
        <div style={{ width: '100%' }}>
            <Header />
            <ScrollToTop smooth />
            <Backdrop
                sx={{ color: 'var(--base-color)', zIndex: (theme) => theme.zIndex.drawer + 1000 }}
                open={isloadingNew}>
                <CircularProgress color="inherit" />
            </Backdrop>
            <Box
                className="accountTAb"
                sx={{ bgcolor: 'background.paper', }}
            >
                <Tabs
                    // orientation="vertical"
                    //  variant="scrollable"
                    // allowScrollButtonsMobile
                    value={value}
                    onChange={handleChange}
                    centered
                    aria-label="Vertical tabs example"
                    sx={{ borderRight: 1, borderColor: 'divider', }}
                // scrollButtons="auto"

                >
                    <Tab label="My bids" {...a11yProps(0)} />
                    <Tab label="My sell Space" {...a11yProps(1)} />
                    <Tab label="Personal data" {...a11yProps(2)} />
                    <Tab label="Billing" {...a11yProps(3)} />
                </Tabs>
                <TabPanel value={value} index={0}>
                    <div>
                        <Accordion expanded={expanded === 'panel1'} onChange={handleChange_accordion('panel1')}>
                            <AccordionSummary aria-controls="panel1d-content" id="panel1d-header">
                                <Typography>Auction live ({
                                    Object.keys(mybids).length > 0 ? Object.keys(mybids[0]).length : <></>
                                })</Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <div className='gridBody'>
                                    {isloading === false ?
                                        Object.keys(mybids).length > 0 ?
                                            Object.keys(mybids[0]).length > 0 ?
                                                Object.values(mybids[0]).map((data, key) => (
                                                    <div key={data[0].id}>
                                                        <Link className="bigBox" to={'/detail/' + data[0].article_id + '-' + data[0].category_name + '-' +
                                                            data[0].category_id + "/" + data[0].end
                                                        } style={{ textDecoration: 'none' }}>
                                                            <div className="gridFlex">
                                                                <img src={_GLobal_Link._link_simple + data[0].image_link.replace("public", "storage")} alt="" />
                                                            </div>
                                                            <div>
                                                                <span className="link_header_special_simple" style={{ color: "black", }}>{data[0].name}</span>
                                                            </div>
                                                            <div>
                                                                <span className="link_header_special_simple" style={{ color: "black", }}>Current Bid</span> -
                                                                {
                                                                    data[0].bidDirectly !== undefined && data[0].bidDirectly !== null ?
                                                                        <>
                                                                            <span style={{ color: "black", marginLeft: "5px" }}>€ {data[0].bidDirectly.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span><br />
                                                                        </>
                                                                        : <><span style={{ color: "black", marginLeft: "5px" }}> 0 </span>  <br /></>
                                                                }


                                                                <span className="link_header_special_simple" id={data[0].id + 'account'}>
                                                                    {
                                                                        setInterval(() => {
                                                                            counterDate(data[0].end, data[0].id + 'account')
                                                                        }, 1000)
                                                                    }
                                                                </span>
                                                            </div>
                                                        </Link>
                                                    </div>
                                                ))
                                                :
                                                <div style={{ display: 'flex', justifyContent: 'center', marginTop: '20px', marginBottom: '20px', flex: 1 }}>
                                                    <div>
                                                        <Alert severity="info">You haven't add a bid yet </Alert>
                                                    </div>
                                                </div>
                                            :
                                            <div style={{ display: 'flex', justifyContent: 'center', marginTop: '20px', marginBottom: '20px', flex: 1 }}>
                                                <div>
                                                    <Alert severity="info">You haven't add a bid yet</Alert>
                                                </div>
                                            </div>
                                        :
                                        <>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                        </>

                                    }
                                </div>
                            </AccordionDetails>
                        </Accordion>
                        <Accordion expanded={expanded === 'panel2'} onChange={handleChange_accordion('panel2')}>
                            <AccordionSummary aria-controls="panel2d-content" id="panel2d-header">
                                <Typography>Auction Won ({
                                    Object.keys(mybids).length > 0 ? Object.keys(mybids[1]).length : <></>
                                })</Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <div className='gridBody'>
                                    {isloading === false ?
                                        Object.keys(mybids).length > 0 ?
                                            Object.keys(mybids[1]).length > 0 ?
                                                Object.values(mybids[1]).map((data, key) => (
                                                    <div key={data[0].id}>
                                                        <Link className="bigBox" to={'/detail/' + data[0].article_id + '-' + data[0].category_name + '-' +
                                                            data[0].category_id + "/" + data[0].end
                                                        } style={{ textDecoration: 'none' }}>
                                                            <div className="gridFlex">
                                                                <img src={_GLobal_Link._link_simple + data[0].image_link.replace("public", "storage")} alt="" />
                                                            </div>
                                                            <div>
                                                                <span className="link_header_special_simple" style={{ color: "black", }}>{data[0].name}</span>
                                                            </div>
                                                            <div>
                                                                <span className="link_header_special_simple" style={{ color: "black", }}>Winning Bid</span> -
                                                                {
                                                                    data[0].bidDirectly !== undefined && data[0].bidDirectly !== null ?
                                                                        <>
                                                                            <span style={{ color: "black", marginLeft: "5px" }}>€ {data[0].bidDirectly.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span><br />
                                                                        </>
                                                                        : <><span style={{ color: "black", marginLeft: "5px" }}> 0 </span>  <br /></>
                                                                }


                                                                {/* <span className="link_header_special_simple" id={data[0].id + 'home'}>
                                                {
                                                    setInterval(() => {
                                                        counterDate(data[0].end, data[0].id + 'home')
                                                    }, 1000)
                                                }
                                            </span> */}
                                                            </div>
                                                        </Link>
                                                    </div>
                                                ))
                                                :
                                                <div style={{ display: 'flex', justifyContent: 'center', marginTop: '20px', marginBottom: '20px', flex: 1 }}>
                                                    <div>
                                                        <Alert severity="info">You haven't add a bid yet </Alert>
                                                    </div>
                                                </div>
                                            :
                                            <div style={{ display: 'flex', justifyContent: 'center', marginTop: '20px', marginBottom: '20px', flex: 1 }}>
                                                <div>
                                                    <Alert severity="info">You haven't add a bid yet</Alert>
                                                </div>
                                            </div>
                                        :
                                        <>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                        </>

                                    }
                                </div>
                            </AccordionDetails>
                        </Accordion>
                        <Accordion expanded={expanded === 'panel3'} onChange={handleChange_accordion('panel3')}>
                            <AccordionSummary aria-controls="panel3d-content" id="panel3d-header">
                                <Typography>Auction lost ({
                                    Object.keys(mybids).length > 0 ? Object.keys(mybids[2]).length : <></>
                                })</Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <div className='gridBody'>
                                    {isloading === false ?
                                        Object.keys(mybids).length > 0 ?
                                            Object.keys(mybids[2]).length > 0 ?
                                                Object.values(mybids[2]).map((data, key) => (
                                                    <div key={data[0].id}>
                                                        <Link className="bigBox" to={'/detail/' + data[0].article_id + '-' + data[0].category_name + '-' +
                                                            data[0].category_id + "/" + data[0].end
                                                        } style={{ textDecoration: 'none' }}>
                                                            <div className="gridFlex">
                                                                <img src={_GLobal_Link._link_simple + data[0].image_link.replace("public", "storage")} alt="" />
                                                            </div>
                                                            <div>
                                                                <span className="link_header_special_simple" style={{ color: "black", }}>{data[0].name}</span>
                                                            </div>
                                                            <div>
                                                                <span className="link_header_special_simple" style={{ color: "black", }}>Winning Bid</span> -
                                                                {
                                                                    data[0].bidDirectly !== undefined && data[0].bidDirectly !== null ?
                                                                        <>
                                                                            <span style={{ color: "black", marginLeft: "5px" }}>€ {data[0].bidDirectly.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</span><br />
                                                                        </>
                                                                        : <><span style={{ color: "black", marginLeft: "5px" }}> 0 </span>  <br /></>
                                                                }


                                                                {/* <span className="link_header_special_simple" id={data[0].id + 'home'}>
                                                {
                                                    setInterval(() => {
                                                        counterDate(data[0].end, data[0].id + 'home')
                                                    }, 1000)
                                                }
                                            </span> */}
                                                            </div>
                                                        </Link>
                                                    </div>
                                                ))
                                                :
                                                <div style={{ display: 'flex', justifyContent: 'center', marginTop: '20px', marginBottom: '20px', flex: 1 }}>
                                                    <div>
                                                        <Alert severity="info">You haven't lost a bid yet </Alert>
                                                    </div>
                                                </div>
                                            :
                                            <div style={{ display: 'flex', justifyContent: 'center', marginTop: '20px', marginBottom: '20px', flex: 1 }}>
                                                <div>
                                                    <Alert severity="info">You haven't lost a bid yet</Alert>
                                                </div>
                                            </div>
                                        :
                                        <>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                            <div>
                                                <div className="gridFlex">
                                                    <Skeleton variant="rectangular" animation="wave" width="100%" height="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="100%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="65%" />
                                                </div>
                                                <div >
                                                    <Skeleton width="60%" />
                                                </div>
                                            </div>
                                        </>

                                    }
                                </div>
                            </AccordionDetails>
                        </Accordion>
                    </div>
                </TabPanel>
                <TabPanel value={value} index={1}>
                    <Userspace/>
                </TabPanel>
                <TabPanel value={value} index={2}>
                    <div className="main_box_personnal_data">
                        <div>
                            <div style={{ marginBottom: "15px" }}>
                                <div className="my_h1">
                                    Personal data
                                </div>
                                <span className="my_sub">
                                    View and update your information here. Manage your usernames and passwords here.
                                </span>
                                <div className="account_box" style={{ marginTop: "50px" }}>
                                    <div>
                                        <div style={{ display: 'flex', alignItems: "center" }}>
                                            <IonIcon style={{ fontSize: "25px" }} name="person-outline"></IonIcon>
                                            <div style={{ marginLeft: "10px" }}>
                                                <span className="small_title">
                                                    Name
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <Typography style={{ marginLeft: "30px", marginTop: "5px" }}>
                                                {
                                                    Object.keys(userData).length > 0 ? userData[0].name : <></>
                                                }
                                            </Typography>
                                        </div>
                                    </div>
                                    {/* <div style={{ marginTop: "10px" }}>
                                        <div onClick={handleClickOpen} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)' }}>
                                            <span>Update</span>
                                        </div>
                                    </div> */}
                                </div>
                            </div>
                            <Accordion>
                                <AccordionSummary
                                    expandIcon={<ExpandMoreIcon />}
                                    aria-controls="panel1a-content"
                                    id="panel1a-header"
                                >
                                    <Typography>Fill in these fields to edit your information</Typography>
                                </AccordionSummary>
                                <AccordionDetails>
                                    <div>
                                        <Typography gutterBottom>

                                        </Typography>
                                        <div>
                                            <TextField onInput={checkfieldoninpout_3} id='firstname' style={{ width: '100%' }}
                                                type='text' error={namemanagement.first} helperText={namemanagement.message1}
                                                label="Enter new first name" variant="standard" />
                                        </div>
                                        <div>
                                            <TextField onInput={checkfieldoninpout_4} id='lastname' style={{ width: '100%' }}
                                                type='text' error={namemanagement.second} helperText={namemanagement.message2}
                                                label="Enter new Last name" variant="standard" />
                                        </div>

                                        <div onClick={updateName} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)', width: "100%", marginTop: "10px" }}>
                                            <span>Update</span>
                                        </div>
                                    </div>
                                </AccordionDetails>
                            </Accordion>

                            <Divider />
                            <div style={{ marginBottom: "15px" }}>
                                <div className="account_box" style={{ marginTop: "50px" }}>
                                    <div>
                                        <div style={{ display: 'flex', alignItems: "center" }}>
                                            <IonIcon style={{ fontSize: "25px" }} name="mail-outline"></IonIcon>
                                            <div style={{ marginLeft: "10px" }}>
                                                <span className="small_title">
                                                    Your e-mail adresse
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <Typography style={{ marginLeft: "30px", marginTop: "5px" }}>
                                                {
                                                    Object.keys(userData).length > 0 ? userData[0].email : <></>
                                                }
                                            </Typography>
                                        </div>
                                    </div>
                                    {/* <div style={{ marginTop: "10px" }}>
                                        <div onClick={handleClickOpen2} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)' }}>
                                            <span>Update</span>
                                        </div>
                                    </div> */}
                                </div>
                                <div style={{ marginTop: "20px" }}>
                                    <Accordion>
                                        <AccordionSummary
                                            expandIcon={<ExpandMoreIcon />}
                                            aria-controls="panel1a-content"
                                            id="panel1a-header"
                                        >
                                            <Typography>Change email address</Typography>
                                        </AccordionSummary>
                                        <AccordionDetails>
                                            <Typography gutterBottom>
                                                We will ensure that all important emails from our site are sent to your new email address.
                                            </Typography>
                                            <div>
                                                <TextField id='email_account_1' style={{ width: '100%' }}
                                                    type='email'
                                                    label="New email address" variant="standard"
                                                    error={emailmanagement.first} helperText={emailmanagement.message1}
                                                    onInput={checkfieldoninpout_5}
                                                />
                                            </div>
                                            <div>
                                                <TextField id='email_account_2' style={{ width: '100%' }}
                                                    type='email'
                                                    label="Old email address" variant="standard"
                                                    error={emailmanagement.second} helperText={emailmanagement.message2}
                                                    onInput={checkfieldoninpout_6}
                                                />
                                            </div>

                                            <div>
                                                <TextField id='password_account_1' style={{ width: '100%' }}
                                                    type='password'
                                                    label="Enter your current password" variant="standard"
                                                    error={emailmanagement.third} helperText={emailmanagement.message3}
                                                    onInput={checkfieldoninpout_7}
                                                />
                                            </div>

                                            <div onClick={updateEmail} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)', width: "100%", marginTop: "10px" }}>
                                                <span>Update</span>
                                            </div>
                                        </AccordionDetails>
                                    </Accordion>
                                </div>
                            </div>
                            <Divider />
                            <div>
                                <div className="my_h1" style={{ marginTop: "50px" }}>
                                    Update Password
                                </div>
                                <div>
                                    <TextField
                                        error={passwordmanagement.first}
                                        onInput={(e) => { checkfieldoninpout_1(e) }}
                                        id='oldpass' style={{ width: '100%' }}
                                        type='password'
                                        label="Enter your current password" variant="standard" helperText={passwordmanagement.message1} />
                                </div>
                                <div>
                                    <TextField id='newpass' onInput={(e) => { checkfieldoninpout_2(e) }} error={passwordmanagement.second} style={{ width: '100%' }}
                                        type='password'
                                        label="Enter your new password" variant="standard" helperText={passwordmanagement.message2} />
                                </div>
                                <div onClick={updatepass} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)', width: "100%", marginTop: "10px" }}>
                                    <span>Update</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </TabPanel>
                <TabPanel value={value} index={3}>
                    Billing
                </TabPanel>

            </Box>
            {memoName}
            {/* <BootstrapDialog
                onClose={handleClose2}
                aria-labelledby="customized-dialog-title-2"
                open={open2}
            >
                <BootstrapDialogTitle id="customized-dialog-title-2" onClose={handleClose2}>
                    Change email address
                </BootstrapDialogTitle>
                <DialogContent dividers style={{ flex: 1 }}>
                    <Typography gutterBottom>
                        We will ensure that all important emails from our site are sent to your new email address.
                    </Typography>
                    <div>
                        <TextField id='email_account_1' style={{ width: '100%' }}
                            type='email'
                            label="New email address" variant="standard" />
                    </div>
                    <div>
                        <TextField id='email_account_2' style={{ width: '100%' }}
                            type='email'
                            label="Old email address" variant="standard" />
                    </div>

                    <div>
                        <TextField id='password_account_1' style={{ width: '100%' }}
                            type='password'
                            label="Enter your current password" variant="standard" />
                    </div>

                    <div onClick={updateEmail} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)', width: "100%", marginTop: "10px" }}>
                        <span>Update</span>
                    </div>
                  
                </DialogContent>
                <DialogActions>
                   
                </DialogActions>
            </BootstrapDialog> */}
        </div>
    );
}

export default Account;
