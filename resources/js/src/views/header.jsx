import Paper from '@mui/material/Paper';
import InputBase from '@mui/material/InputBase';
import IconButton from '@mui/material/IconButton';
import SearchIcon from '@mui/icons-material/Search';
import React, { useState, useEffect } from 'react';
import '../style/header.css'
import { Link } from "react-router-dom";
import Box from '@mui/material/Box';
import Drawer from '@mui/material/Drawer';
import List from '@mui/material/List';
import Divider from '@mui/material/Divider';
import ListItem from '@mui/material/ListItem';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import InboxIcon from '@mui/icons-material/MoveToInbox';
import MailIcon from '@mui/icons-material/Mail';
import { IonIcon } from "react-ion-icon";
import { useSelector } from 'react-redux';
import { useDispatch } from 'react-redux';
import Button from '@mui/material/Button';
import loginAction from '../app/actions/loginAction';
import Popover from '@mui/material/Popover';
import axios from 'axios';
import { Typography } from '@mui/material';

import LikeAction from '../app/actions/likeAction';
import {
    useNavigate
} from "react-router-dom";
import _GLobal_Link from './global';
function Header(props) {
    const [anchorEl, setAnchorEl] = React.useState(null);
    const handleClick = (event) => {
        setAnchorEl(event.currentTarget);
    };


    const handleClose = () => {
        setAnchorEl(null);
    };
    const navigate = useNavigate();

    const signout = () => {
        localStorage.removeItem("session_token");
        localStorage.removeItem("user_name");
        dispatch(loginAction(false, ""));
        window.location.href = "/"
        // navigate("/");
    }


    const open = Boolean(anchorEl);
    const id = open ? 'simple-popover' : undefined;
    const [state, setState] = React.useState({
        left: false,
    });
    const toggleDrawer = (anchor, open) => (event) => {
        if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
            return;
        }
        setState({ ...state, [anchor]: open });
    };
    const list = (anchor) => (
        <Box
            sx={{ width: anchor === 'top' || anchor === 'bottom' ? 'auto' : 250 }}
            role="presentation"
            onClick={toggleDrawer(anchor, false)}
            onKeyDown={toggleDrawer(anchor, false)}
        >
            <List>

                <ListItem button>
                    <ListItemIcon style={{ fontSize: 25, alignSelf: 'center', color: 'gray' }}>
                        <IonIcon name="apps"></IonIcon>
                    </ListItemIcon>
                    <ListItemText primary={"categories"} />
                </ListItem>

                <ListItem button>
                    <ListItemIcon style={{ fontSize: 25, alignSelf: 'center', color: 'gray' }}>
                        <IonIcon name="card"></IonIcon>
                    </ListItemIcon>
                    <ListItemText primary={"Seller"} />
                </ListItem>

            </List>
            <Divider />
            <List>
                {['All mail', 'Trash', 'Spam'].map((text, index) => (
                    <ListItem button key={text}>
                        <ListItemIcon>
                            {index % 2 === 0 ? <InboxIcon /> : <MailIcon />}
                        </ListItemIcon>
                        <ListItemText primary={text} />
                    </ListItem>
                ))}
            </List>
        </Box>
    );
    const dispatch = useDispatch();



    // console.log(useSelector((state) => state))

    // const loginState = useSelector((state) => state.loginReducer._isLogin);



    const [islogin, setIslogin] = useState(false)
    const [user_name, setUser_name] = useState(false)

    useEffect(() => {
        if (localStorage.getItem("session_token")) {

            setUser_name(localStorage.getItem("user_name"))
            setIslogin(true)
        }

    }, [])
    const userName = useSelector((state) =>
        state.loginReducer._user_name
    );
    useEffect(() => {
        if (localStorage.getItem("session_token")) {
            axios.get(_GLobal_Link._link_simple + 'api/seeIfLIked_GET/' + localStorage.getItem("session_token"), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            }).then((res2) => {
                dispatch(
                    {
                        type: 'LIKE',
                        payload: { data: Object.keys(res2.data).length }
                    }
                );

            })
        }

    }, [])

    // const [liked, setLiked] = useState(0)
    let numberLiked = useSelector((state) => state.LikeReducer.data)

    useEffect(() => {
        if (localStorage.getItem("session_token")) {
            axios.get(_GLobal_Link._link_simple + 'api/seeIfLIked/' + localStorage.getItem("session_token"), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            }).then((res2) => {
                //  setLiked(res2.data.length)
            })
        }
    }, [])

    return (
        <div style={{ position: 'relative', zIndex: 100 }}>
            <Popover
                id={id}
                open={open}
                anchorEl={anchorEl}
                onClose={handleClose}
                anchorOrigin={{
                    vertical: 'bottom',
                    horizontal: 'left',
                }}
                transformOrigin={{
                    vertical: 'top',
                    horizontal: 'center',
                }}
            >
                <div style={{ padding: "10px" }}>
                    <div onClick={signout} style={{ fontSize: 15, alignSelf: 'center', color: 'gray', cursor: 'pointer' }} >
                        <span sx={{ p: 2 }}>Sign out</span>
                    </div>
                </div>
            </Popover>
            <div className='headBody' >
                <div onClick={() => window.location.href = "/"}>
                    {/* <Link to='/'> */}
                    <img alt='' height={100} width={120} src={_GLobal_Link._link_simple + 'aimeos/1.d/logo.png'} />
                    {/* </Link> */}
                </div>
                <div style={{ alignItems: 'center', display: 'flex' }}>

                    <Typography className="link_header_special link" variant='subtitle2' onClick={() => window.location.href = "/"}  >Auctions</Typography>
                    <Link className='link' to='/seller-home'>
                        <Typography className="link_header_special" variant='subtitle2'>
                            Sell
                        </Typography>
                    </Link>

                    <div style={{ alignItems: 'center', display: 'flex' }}>
                        <Link className='link link_header_special' to='/'>Help</Link>
                        <Link style={{ fontSize: 40, alignSelf: 'center', color: 'gray', position: "relative" }} className='link' to='/liked'>
                            <div style={{ position: 'absolute', right: "8px" }}>
                                <span className="link_header_special" style={{ fontSize: '15px' }}>{numberLiked}</span>
                            </div>

                            <IonIcon name="heart-circle-outline"></IonIcon>
                        </Link>
                        {islogin === true ?
                            <div style={{ fontSize: 30, alignSelf: 'center', color: 'gray', display: 'flex', alignItems: 'center' }} className='link'>
                                <div className='dropdownHEader'>
                                    <Button style={{ boxShadow: 'none', fontSize: '17px', color: 'white', background: 'var(--base-color)', display: 'flex', alignItems: 'center' }} aria-describedby={id} variant="contained">
                                        <div>
                                            <span style={{ color: 'white', textTransform: 'lowercase' }} className="link_header_special">{user_name}</span>
                                        </div>
                                        <div style={{ fontSize: 20, color: 'white', marginLeft: "5px", marginTop: "3px" }}>
                                            <IonIcon name="person-circle-outline"></IonIcon>
                                        </div>
                                    </Button>
                                    <div className="dropdown-contentHEader">

                                        <div>
                                            <div className='dropspanDiv link_drop_parent'>
                                                {/* <Link className='link_header_special_drop_kid_' to='/'>Account</Link> */}
                                                <Link className='link link_header_special' to='/home-account' style={{ alignSelf: 'center', }}>
                                                    Account
                                                </Link>
                                            </div>
                                            <div className='dropspanDiv link_drop_parent' onClick={signout}>
                                                <span className='link link_header_special' style={{ alignSelf: 'center', }}>Sign Out</span>
                                            </div>

                                            {/* <div className='link_drop_parent'>
                                                <Link className='link_header_special_drop_kid_' to='/'>Live</Link>
                                            </div>
                                            <div className='link_drop_parent'>
                                                <Link className='link_header_special_drop_kid_' to='/'>Won</Link>
                                            </div>
                                            <div className='link_drop_parent'>
                                                <Link className='link_header_special_drop_kid_' to='/'>Lost</Link>
                                            </div> */}
                                        </div>

                                        {/* <div>
                                            <div className='dropspanDiv'>
                                                <span className='link_header_special_drop_'>Explore</span>
                                            </div>
                                            <div className='link_drop_parent'>
                                                <Link className='link_header_special_drop_kid_' to='/'>
                                                    My favourite lots
                                                </Link>
                                            </div>
                                        </div>
                                        <div>
                                            <div className='dropspanDiv'>
                                                <span className='dropspan'>Sell</span>
                                            </div>
                                            <div className='link_drop_parent'>
                                                <Link className='link_drop' to='/'>Sales overview</Link>
                                            </div>
                                        </div>
                                        <div>
                                            <div className='dropspanDiv'>
                                                <span className='dropspan'>Acount</span>
                                            </div>
                                            <div className='link_drop_parent'>
                                                <Link className='link_drop' to='/'>Settings</Link>
                                            </div>
                                        </div>
                                        <div className='dropspanDiv' onClick={signout}>
                                            <span className='dropspan'>Sign Out</span>
                                        </div> */}
                                    </div>
                                </div>
                            </div> :
                            <>
                                <div >
                                    {/* <Link style={{ alignSelf: 'center', }} className='link' to='/front-login'>
                                        <IonIcon name="person-circle-outline"></IonIcon>
                                        Login
                                    </Link> */}
                                    <Link className='link link_header_special' to='/front-login' style={{ alignSelf: 'center', }}>
                                        {/* <Typography className="link_header_special" variant='subtitle2'> */}
                                        Login
                                        {/* </Typography> */}
                                    </Link>
                                </div>
                                <div className='catElementFIrst'>
                                    {/* <Link style={{ alignSelf: 'center', color: 'white' }} className='link' to='/sign-up'>
                                        <IonIcon name="person-circle-outline"></IonIcon>
                                        Sign up
                                    </Link> */}
                                    <Link className='link link_header_special' to='/sign-up' style={{ alignSelf: 'center', color: 'white' }}>
                                        {/* <Typography className="link_header_special" variant='subtitle2'> */}
                                        Sign up
                                        {/* </Typography> */}
                                    </Link>
                                </div>

                            </>
                        }
                    </div>
                </div>
            </div>

            <div className='mobile-menu'>
                <div className='icon-mobile'>
                    {['left'].map((anchor) => (
                        <React.Fragment key={anchor}>
                            <Link style={{ fontSize: 30, alignSelf: 'center', color: 'gray' }} to='/' onClick={toggleDrawer(anchor, true)}>
                                <IonIcon name="menu-sharp"></IonIcon>
                            </Link>
                            <Drawer
                                anchor={'left'}
                                open={state.left}
                                onClose={toggleDrawer(anchor, false)}
                            >
                                {list(anchor)}
                            </Drawer>
                        </React.Fragment>
                    ))}
                </div>
                <div style={{ flex: 1 }}>
                    <Paper component="form" sx={{ p: '0px 10px', display: 'flex', flex: 1, background: '#f0f1f5', color: 'gray', boxShadow: 'none', }}>
                        <InputBase
                            sx={{ flex: 1, fontFamily: "'Oswald', sans-serif" }}
                            placeholder="Search for model,brand .."
                            inputProps={{ 'aria-label': 'search google maps' }}
                        />
                        <IconButton type="submit" sx={{ p: '5px' }} aria-label="search">
                            <SearchIcon />
                        </IconButton>
                    </Paper>
                </div>
                <div className='icon-mobile'>
                    <Link style={{ fontSize: 25, alignSelf: 'center', color: 'gray' }} to='/'>
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </Link>
                </div>
                <div className='icon-mobile'>
                    <Link style={{ fontSize: 25, alignSelf: 'center', color: 'gray' }} to='/'>
                        <IonIcon name="person-circle-outline"></IonIcon>
                    </Link>
                </div>
            </div>
        </div>

    );
} export default Header;