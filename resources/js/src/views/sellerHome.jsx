import React, { useState, useEffect, useLayoutEffect } from 'react';
import '../style/global.css';
import Paper from '@mui/material/Paper';
import InputBase from '@mui/material/InputBase';
import IconButton from '@mui/material/IconButton';
import SearchIcon from '@mui/icons-material/Search';
import { Link } from "react-router-dom";
import { IonIcon } from "react-ion-icon";
import _GLobal_Link from './global';
import Button from '@mui/material/Button';
import { useSelector } from 'react-redux';
import { useDispatch } from 'react-redux';
import loginAction from '../app/actions/loginAction';
import axios from 'axios';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import useMediaQuery from '@mui/material/useMediaQuery';
import {
    useNavigate
} from "react-router-dom";

import TextField from '@mui/material/TextField';
import Autocomplete from '@mui/material/Autocomplete';
import Header from "./header";
import Alert from '@mui/material/Alert';
import { useTheme } from '@mui/material/styles';

// Top 100 films as rated by IMDb users. http://www.imdb.com/chart/top
const top100Films = [
    { title: 'The Shawshank Redemption', year: 1994 },
    { title: 'The Godfather', year: 1972 },
    { title: 'The Godfather: Part II', year: 1974 },
    { title: 'The Dark Knight', year: 2008 },
    { title: '12 Angry Men', year: 1957 },
    { title: "Schindler's List", year: 1993 },
    { title: 'Pulp Fiction', year: 1994 },
    {
        title: 'The Lord of the Rings: The Return of the King',
        year: 2003,
    },
    { title: 'The Good, the Bad and the Ugly', year: 1966 },
    { title: 'Fight Club', year: 1999 },
    {
        title: 'The Lord of the Rings: The Fellowship of the Ring',
        year: 2001,
    },
    {
        title: 'Star Wars: Episode V - The Empire Strikes Back',
        year: 1980,
    },
    { title: 'Forrest Gump', year: 1994 },
    { title: 'Inception', year: 2010 },
    {
        title: 'The Lord of the Rings: The Two Towers',
        year: 2002,
    },
    { title: "One Flew Over the Cuckoo's Nest", year: 1975 },
    { title: 'Goodfellas', year: 1990 },
    { title: 'The Matrix', year: 1999 },
    { title: 'Seven Samurai', year: 1954 },
    {
        title: 'Star Wars: Episode IV - A New Hope',
        year: 1977,
    },
    { title: 'City of God', year: 2002 },
    { title: 'Se7en', year: 1995 },
    { title: 'The Silence of the Lambs', year: 1991 },
    { title: "It's a Wonderful Life", year: 1946 },
    { title: 'Life Is Beautiful', year: 1997 },
    { title: 'The Usual Suspects', year: 1995 },
    { title: 'Léon: The Professional', year: 1994 },
    { title: 'Spirited Away', year: 2001 },
    { title: 'Saving Private Ryan', year: 1998 },
    { title: 'Once Upon a Time in the West', year: 1968 },
    { title: 'American History X', year: 1998 },
    { title: 'Interstellar', year: 2014 },
    { title: 'Casablanca', year: 1942 },
    { title: 'City Lights', year: 1931 },
    { title: 'Psycho', year: 1960 },
    { title: 'The Green Mile', year: 1999 },
    { title: 'The Intouchables', year: 2011 },
    { title: 'Modern Times', year: 1936 },
    { title: 'Raiders of the Lost Ark', year: 1981 },
    { title: 'Rear Window', year: 1954 },
    { title: 'The Pianist', year: 2002 },
    { title: 'The Departed', year: 2006 },
    { title: 'Terminator 2: Judgment Day', year: 1991 },
    { title: 'Back to the Future', year: 1985 },
    { title: 'Whiplash', year: 2014 },
    { title: 'Gladiator', year: 2000 },
    { title: 'Memento', year: 2000 },
    { title: 'The Prestige', year: 2006 },
    { title: 'The Lion King', year: 1994 },
    { title: 'Apocalypse Now', year: 1979 },
    { title: 'Alien', year: 1979 },
    { title: 'Sunset Boulevard', year: 1950 },
    {
        title: 'Dr. Strangelove or: How I Learned to Stop Worrying and Love the Bomb',
        year: 1964,
    },
    { title: 'The Great Dictator', year: 1940 },
    { title: 'Cinema Paradiso', year: 1988 },
    { title: 'The Lives of Others', year: 2006 },
    { title: 'Grave of the Fireflies', year: 1988 },
    { title: 'Paths of Glory', year: 1957 },
    { title: 'Django Unchained', year: 2012 },
    { title: 'The Shining', year: 1980 },
    { title: 'WALL·E', year: 2008 },
    { title: 'American Beauty', year: 1999 },
    { title: 'The Dark Knight Rises', year: 2012 },
    { title: 'Princess Mononoke', year: 1997 },
    { title: 'Aliens', year: 1986 },
    { title: 'Oldboy', year: 2003 },
    { title: 'Once Upon a Time in America', year: 1984 },
    { title: 'Witness for the Prosecution', year: 1957 },
    { title: 'Das Boot', year: 1981 },
    { title: 'Citizen Kane', year: 1941 },
    { title: 'North by Northwest', year: 1959 },
    { title: 'Vertigo', year: 1958 },
    {
        title: 'Star Wars: Episode VI - Return of the Jedi',
        year: 1983,
    },
    { title: 'Reservoir Dogs', year: 1992 },
    { title: 'Braveheart', year: 1995 },
    { title: 'M', year: 1931 },
    { title: 'Requiem for a Dream', year: 2000 },
    { title: 'Amélie', year: 2001 },
    { title: 'A Clockwork Orange', year: 1971 },
    { title: 'Like Stars on Earth', year: 2007 },
    { title: 'Taxi Driver', year: 1976 },
    { title: 'Lawrence of Arabia', year: 1962 },
    { title: 'Double Indemnity', year: 1944 },
    {
        title: 'Eternal Sunshine of the Spotless Mind',
        year: 2004,
    },
    { title: 'Amadeus', year: 1984 },
    { title: 'To Kill a Mockingbird', year: 1962 },
    { title: 'Toy Story 3', year: 2010 },
    { title: 'Logan', year: 2017 },
    { title: 'Full Metal Jacket', year: 1987 },
    { title: 'Dangal', year: 2016 },
    { title: 'The Sting', year: 1973 },
    { title: '2001: A Space Odyssey', year: 1968 },
    { title: "Singin' in the Rain", year: 1952 },
    { title: 'Toy Story', year: 1995 },
    { title: 'Bicycle Thieves', year: 1948 },
    { title: 'The Kid', year: 1921 },
    { title: 'Inglourious Basterds', year: 2009 },
    { title: 'Snatch', year: 2000 },
    { title: '3 Idiots', year: 2009 },
    { title: 'Monty Python and the Holy Grail', year: 1975 },
];
function SellerHome() {
    const [category, setcategory] = useState([]);
    const [expanded, setExpanded] = React.useState(false);
    const [dashbordLink, setdashbordLink] = useState([]);
    const [registeringErrorText, setregisteringErrorText] = useState('');
    const [registeringError, setregisteringError] = useState(false);

    const navigate = useNavigate();
    // const handleChange = (panel) => (event, isExpanded) => {
    //     setExpanded(isExpanded ? panel : false);
    // };
    const dispatch = useDispatch();
    const userName = useSelector((state) => state.loginReducer._user_name);
    useEffect(() => {
        // if (localStorage.getItem("session_token")) {
        //     dispatch(loginAction(true, localStorage.getItem("user_name")));
        // }
    })

    const defaultProps = {
        options: category,
        getOptionLabel: (option) => option.Label,
    };

    useLayoutEffect(() => {
        axios.get(_GLobal_Link._link_simple + 'api/getATTR_CAT', {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true
            },
        }).then((res) => {
            setcategory(res.data[0])
        })
    }, [])

    useLayoutEffect(() => {
        let relationShipid = [];
        let relationShipidCat = [];
        axios
            .get(_GLobal_Link.link + "catalog?include=catalog,media", {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            })
            .then((res) => {
                for (let index = 0; index < res.data.included.length; index++) {
                    // if (res.data.included[index].attributes['catalog.label'] === 'Carousel') {
                    //     if (res.data.included[index].links.self.href !== undefined) {
                    //         axios.get(res.data.included[index].links.self.href + "&include=catalog,media", {
                    //             headers: {
                    //                 "content-type": "application/json",
                    //                 'Access-Control-Allow-Credentials': true,
                    //                 'Access-Control-Allow-Origin': true
                    //             },
                    //         }).then((res2) => {
                    //             for (let index2 = 0; index2 < res2.data.included.length; index2++) {
                    //                 if (res2.data.included[index2].relationships !== undefined) {
                    //                     for (let index3 = 0; index3 < res2.data.included[index2].relationships.media.data.length; index3++) {
                    //                         relationShipid.push(res2.data.included[index2].relationships.media.data[index3].id)
                    //                     }
                    //                 }
                    //                 if (typeof relationShipid === 'object') {
                    //                     for (let index4 = 0; index4 < relationShipid.length; index4++) {
                    //                         if (res2.data.included[index2].id === relationShipid[index4]) {
                    //                             setFinalCarsouelData((prev) => [...prev, res2.data.included[index2].attributes["media.url"]])
                    //                         }
                    //                     }
                    //                 }
                    //             }
                    //         })
                    //     }
                    // } else {
                    if (res.data.included[index].type === 'catalog' && res.data.included[index].attributes['catalog.label'] !== 'Carousel') {
                        for (let index4 = 0; index4 < res.data.included.length; index4++) {
                            if (res.data.included[index4].relationships !== undefined) {
                                for (let index5 = 0; index5 < res.data.included[index4].relationships.media.data.length; index5++) {
                                    relationShipidCat.push(res.data.included[index4].relationships.media.data[index5].id)
                                }
                            }
                            if (typeof relationShipidCat === 'object') {
                                for (let index6 = 0; index6 < relationShipidCat.length; index6++) {
                                    if (res.data.included[index4].id === relationShipidCat[index6]) {
                                        //  setcategorieFinalData((prev) => [...prev, res.data.included[index4].attributes["media.url"]])
                                    } else if (res.data.included[index4].id !== relationShipidCat[index6]) {
                                        if (res.data.included[index4].attributes["catalog.label"] !== undefined &&
                                            res.data.included[index4].attributes["catalog.label"] !== 'Carousel') {
                                            // setcategorieFinalDataLAbel((prev) => [...prev, res.data.included[index4].attributes["catalog.label"]])
                                            // setcategorieFinalDataID((prev) => [...prev, res.data.included[index4].id])
                                            console.log(res.data.included[index4].id)
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //}
                }
            });
    }, []);

    const send = () => {
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
                    if (res.data !== 'Already connected') {
                        // navigate("/")
                        setformValidationErrorMEssage('To add Product you will need to login Correctly!')
                        handleClickOpen();
                    } else if(res.data === 'Already connected'){
                        if (dashbordLink.length != 0) {
                            navigate("/upload-dashboard/" + dashbordLink.id + "-" + dashbordLink.Label)
                            setregisteringErrorText("")
                            setregisteringError(false)
                        } else {
                            setregisteringError(true)
                            setregisteringErrorText("Please Select a category !")

                        }
                    }
                });
        } else {
            setformValidationErrorMEssage('To add Product you will need to login!')
            handleClickOpen();
        }
    }
    const [open, setOpen] = React.useState(false);
    const theme = useTheme();
    const fullScreen = useMediaQuery(theme.breakpoints.down('md'));
    const [formValidationErrorMEssage, setformValidationErrorMEssage] = useState('');
    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };
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
                    console.log(res.data)
                    if (res.data !== 'Already connected') {
                        // navigate("/")
                        setformValidationErrorMEssage('To add Product you will need to login Correctly!')
                        handleClickOpen();
                    }
                });
        } else {
            setformValidationErrorMEssage('To add Product you will need to login!')
            handleClickOpen();
        }
    }, []);
    return (
        <div className='selleHomeBody'>
            <Header />
            <Dialog
                // fullScreen={fullScreen}
                open={open}
                onClose={handleClose}
                aria-labelledby="responsive-dialog-title"
            >
                <DialogTitle id="responsive-dialog-title">
                    {"Login error"}
                </DialogTitle>
                <DialogContent>
                    <DialogContentText>
                        {formValidationErrorMEssage}
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose}>
                        <Link to='/login' > Login</Link>
                    </Button>
                </DialogActions>
            </Dialog>
            {registeringError === true ?
                <div style={{ marginTop: "20px", marginLeft: '30%', marginRight: '30%' }}>
                    <Alert style={{ textAlign: 'center' }} severity="error">{registeringErrorText}</Alert>
                </div> : <></>
            }
            <div className='centerTextBlockSELLer'>
                <div style={{
                    display: 'flex', flexDirection: 'column', justifyContent: 'center',
                    alignItems: 'center', flex: 1, width: '100%',
                }}>
                    <h1>Find the perfect buyer for your special object </h1>
                    <h2>What can we help you sell?</h2>
                    <section style={{ width: '300px' }}>

                        <Autocomplete
                            {...defaultProps}
                            id="disable-close-on-select"
                            disableCloseOnSelect
                            onChange={(event, newValue) => {
                                setdashbordLink(newValue)
                            }}
                            renderInput={(params) => (
                                <TextField  {...params} label="Category" variant="standard" />
                            )}
                        />
                    </section>
                </div>
                <div style={{ alignItems: 'center', display: 'flex', justifyContent: 'flex-end', width: "100%", paddingBottom: "10px", paddingRight: '20px' }}>
                    <div className='buttonGlobal' onClick={send}>
                        <span>Continue</span>
                    </div>
                </div>
            </div>
            <div style={{ background: 'black', width: "100%", display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                <div>
                    <h2 style={{ color: 'white' }}>How selling with us works</h2>
                </div>
                <div>
                    <h5 style={{ color: 'white', cursor: 'pointer' }}>Learn More   <IonIcon style={{ fontSize: "20px", }} name="caret-down-outline"></IonIcon></h5>
                </div>
            </div>
        </div>
    );

}

export default SellerHome;

// 