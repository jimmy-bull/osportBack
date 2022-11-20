import React, { useEffect, useState, useLayoutEffect } from 'react';
import Header from "./header";
import Divider from '@mui/material/Divider';
import { IonIcon } from "react-ion-icon";
import Radio from '@mui/material/Radio';
import RadioGroup from '@mui/material/RadioGroup';
import FormControlLabel from '@mui/material/FormControlLabel';
import FormControl from '@mui/material/FormControl';
import FormLabel from '@mui/material/FormLabel';
import axios from 'axios';
import _GLobal_Link from './global';
import ImageUploading from 'react-images-uploading';
import Accordion from '@mui/material/Accordion';
import AccordionSummary from '@mui/material/AccordionSummary';
import AccordionDetails from '@mui/material/AccordionDetails';
import Typography from '@mui/material/Typography';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import Autocomplete from '@mui/material/Autocomplete';
import AppBar from '@mui/material/AppBar';
import CssBaseline from '@mui/material/CssBaseline';
import Toolbar from '@mui/material/Toolbar';
import TextField from '@mui/material/TextField';
import OutlinedInput from '@mui/material/OutlinedInput';
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import ListItemText from '@mui/material/ListItemText';
import Select from '@mui/material/Select';
import Checkbox from '@mui/material/Checkbox';
import DateTimePicker from 'react-datetime-picker';
import Backdrop from '@mui/material/Backdrop';
import Popover from '@mui/material/Popover';

import {
    Link,
    useParams
} from "react-router-dom";
import Button from '@mui/material/Button';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import useMediaQuery from '@mui/material/useMediaQuery';
import { useTheme } from '@mui/material/styles';
import CircularProgress from '@mui/material/CircularProgress';

import {
    useNavigate
} from "react-router-dom";
function Upload() {
    const [wichOn, setwichON] = useState('category');
    const [category, setcategory] = useState([]);
    const { categoryLabel, categoryID } = useParams();
    const [categoryValue, setcategoryValue] = useState(categoryLabel);
    const [detailData, setdetailData] = useState({});
    const [dateValue, dateOnChange] = useState(new Date());
    const [images, setImages] = React.useState([]);
    const [detailsId, setdetailsId] = useState(categoryID);
    const [formValidationErrorMEssage, setformValidationErrorMEssage] = useState('');
    const [description, setdescription] = useState('');
    const [created, setcreated] = useState(false);
    const [urlChange, seturlChange] = React.useState(false);

    const maxNumber = 30;
    const onChange = (imageList, addUpdateIndex) => {
        ///  console.log(imageList[0]['file']);
        setImages(imageList);
    };
    const navigate = useNavigate();
    const ITEM_HEIGHT = 48;
    const ITEM_PADDING_TOP = 8;
    const MenuProps = {
        PaperProps: {
            style: {
                maxHeight: ITEM_HEIGHT * 4.5 + ITEM_PADDING_TOP,
                width: 250,
            },
        },
    };

    const [anchorEl, setAnchorEl] = React.useState(null);

    const handlePopoverOpen = (event) => {
        setAnchorEl(event.currentTarget);
    };

    const handlePopoverClose = () => {
        setAnchorEl(null);
    };

    const openP = Boolean(anchorEl);


    const [open, setOpen] = React.useState(false);
    const theme = useTheme();
    const fullScreen = useMediaQuery(theme.breakpoints.down('md'));
    const [detailGlobalError, setdetailGlobalError] = React.useState({});
    const [estimatinGlobalValidation, setestimatinGlobalValidation] = React.useState({ etsimation: null, minimumPRice: null });
    const [bigI, setbigI] = useState(0);
    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const goBack = () => {
        document.querySelector('.sideBAr').style.display = 'block'
        document.querySelector('.sideBarBody').style.display = 'none'
        document.querySelector('.sideBarBody').style.width = '70%'
    }


    if (window.matchMedia("(min-width: 992px)").matches) {
        if (created) {
            document.querySelector('.sideBAr').style.display = 'block'
            document.querySelector('.sideBarBody').style.display = 'block'
            document.querySelector('.sideBarBody').style.width = '70%'
            document.querySelector('.sideBarBody').style.position = 'relative'
            document.querySelector('.sideBarBody').style.height = 'none'
            document.querySelector('.sideBarBody').style.top = 'none'
            // document.querySelector('.sideSection').style.display = 'flex'
            //console.log('created')
        }

    }


    const switched = (onWich, e, bigNumber) => {
        if (window.matchMedia("(max-width: 992px)").matches) {
            document.querySelector('.sideBarBody').style.transition = 'display 1s linear'
            document.querySelector('.sideBAr').style.display = 'none'
            document.querySelector('.sideBarBody').style.display = 'block'
            document.querySelector('.sideBarBody').style.position = 'absolute'
            document.querySelector('.sideBarBody').style.zIndex = '1000'
            document.querySelector('.sideBarBody').style.top = '0'
            document.querySelector('.sideBarBody').style.height = '100vh'
            document.querySelector('.sideBarBody').style.background = 'white'
            document.querySelector('.sideBarBody').style.width = '100%'
            document.querySelector('.sideBarBody').style.left = '0'
        }
        setcreated(true)

        setwichON(onWich)
        for (let index = 0; index < document.querySelectorAll('.sideBArkids').length; index++) {
            document.querySelectorAll('.sideBArkids')[index].style.background = 'white'
        }
        e.currentTarget.style.background = '#f0f1f5';
        setbigI(bigNumber)
    }

    const switched_2 = (onWich, e) => {
        if (window.matchMedia("(max-width: 992px)").matches) {
            document.querySelector('.sideBarBody').style.transition = 'display 1s linear'
            document.querySelector('.sideBAr').style.display = 'none'
            document.querySelector('.sideBarBody').style.display = 'block'
            document.querySelector('.sideBarBody').style.position = 'absolute'
            document.querySelector('.sideBarBody').style.zIndex = '1000'
            document.querySelector('.sideBarBody').style.top = '0'
            document.querySelector('.sideBarBody').style.height = '100vh'
            document.querySelector('.sideBarBody').style.background = 'white'
            document.querySelector('.sideBarBody').style.width = '100%'
            document.querySelector('.sideBarBody').style.left = '0'
        }
        setcreated(true)

        setwichON(onWich)
        for (let index = 0; index < document.querySelectorAll('.sideBArkids').length; index++) {
            document.querySelectorAll('.sideBArkids')[index].style.background = 'white'
        }
        e.style.background = '#f0f1f5';

    }
    // const PayPalButton = paypal.Buttons.driver("react", { React, });

    useEffect(() => {
        // document.querySelectorAll('.sideBArkids')[0].style.background = '#f0f1f5';
    }, [])

    useEffect(() => {
        axios.get(_GLobal_Link._link_simple + 'api/getATTR_CAT', {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true
            },
        }).then((res) => {
            setcategory(res.data[0])
        })
        setisloading(true)
        axios.get(_GLobal_Link._link_simple + 'api/getATTR_WAYS/' + detailsId, {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true
            },
        }).then((res) => {
            console.log(res.data)
            let result = res.data.reduce(function (r, a) {
                r[a.attribute_type] = r[a.attribute_type] || [];
                r[a.attribute_type].push(a);
                return r;
            }, Object.create(null));
            setdetailData(result)

            let resultempty = res.data.reduce(function (r, a) {
                r[a.attribute_type] = r[a.attribute_type] || [];
                r[a.attribute_type] = null;
                return r;
            }, Object.create(null));
            setdetailGlobalError(resultempty)
            setisloading(false)
        })
    }, [detailsId])

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
                        navigate("/")
                    }
                });
        } else {
            navigate("/")
        }
    }, []);

    const [manyData, setmanyData] = React.useState([]);
    const handleChange = (event) => {
        const {
            target: { value, name },
        } = event;
        setmanyData(prev => {
            return { ...prev, [name]: value }
        })
        setdetailGlobalError(prev => {
            return { ...prev, [name]: value }
        })
    };
    useEffect(() => {
        if (new Date(dateValue).toLocaleDateString("en-US") != '1/1/1970') {
            setdetailGlobalError(prev => {
                return { ...prev, 'Date until valid MOT': new Date(dateValue).toLocaleDateString("en-US") }
            })
        } else {
            setdetailGlobalError(prev => {
                return { ...prev, 'Date until valid MOT': null }
            })
        }
    }, [dateValue])
    const [detailValidationSuccess, setdetailValidationSuccess] = useState(false)
    useEffect(() => {
        let nulledPresent = false;
        Object.values(detailGlobalError).map((data, key) => {
            if (data == null || data.length == 0) {
                nulledPresent = true;
            }
        })
        if (nulledPresent == true) {
            setdetailValidationSuccess(false)
        } else {
            setdetailValidationSuccess(true)
        }
    }, [detailGlobalError])

    const [finalValidation, setfinalValidation] = useState('not good')
    useEffect(() => {
        let nulledPresent = false;
        Object.values(detailGlobalError).map((data, key) => {
            if (data == null || data.length == 0) {
                nulledPresent = true;
            }
        })
        if (images.length < 3) {
            nulledPresent = true;
        }
        if (categoryValue == '') {
            nulledPresent = true;
        }
        Object.values(estimatinGlobalValidation).map((data, key) => {
            if (data == null || data.length == 0) {
                nulledPresent = true;
            }
        })
        if (description == '') {
            nulledPresent = true;
        }
        if (nulledPresent == true) {
            setfinalValidation('not good')
        } else {
            setfinalValidation('good')
        }

    }, [estimatinGlobalValidation, detailGlobalError, images, categoryValue, description])


    useEffect(() => {
        if (bigI === 0) {
            switched_2("category", document.querySelectorAll('.sideBArkids')[0])
        } else if (bigI === 1) {
            switched_2("photo", document.querySelectorAll('.sideBArkids')[1])
        } else if (bigI === 2) {
            switched_2("detail", document.querySelectorAll('.sideBArkids')[2])
        }
        else if (bigI === 3) {
            switched_2("estimated", document.querySelectorAll('.sideBArkids')[3])
        }
        else if (bigI === 4) {
            setbigI(0);
        }

    }, [bigI])
    const next = () => {
        setbigI(prev => prev + 1);

        // // if (detailValidationSuccess === true) {
        // //     i = 3;
        // // }
        // if (detailValidationSuccess === true) {
        //     setwichON("estimated")
        //     for (let index = 0; index < document.querySelectorAll('.sideBArkids').length; index++) {
        //         document.querySelectorAll('.sideBArkids')[index].style.background = 'white'
        //     }
        //     document.querySelectorAll('.sideBArkids')[3].style.background = '#f0f1f5'

        // } 

        // else {
        //     setformValidationErrorMEssage('To add estimated values ​to your lot, you must complete all detail fields correctly!!')
        //     handleClickOpen();
        // }
        // detailValidationSuccess == true
    }
    const [isloading, setisloading] = useState(false);
    const sendUpload = (e) => {
        if (finalValidation == 'good') {
            //  for (let index = 0; index < 1000; index++) {
            setisloading(true)
            const formData = new FormData();
            for (let index = 0; index < images.length; index++) {
                formData.append("image[]", images[index].file);
            }
            formData.append("category", categoryValue);
            formData.append("attributes", JSON.stringify(detailGlobalError));
            formData.append("estimation", JSON.stringify(estimatinGlobalValidation));
            formData.append("token", JSON.stringify(localStorage.getItem("session_token")));
            formData.append("description", description);

            try {
                axios.post(_GLobal_Link._link_simple + "api/store", formData, {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true,
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((res) => {
                    if (res.data === 'added') {
                        alert('Your product has been added. this product is pending review')
                    } else {
                        alert('errors:please contact site owner for more info.')
                    }
                    setisloading(false)
                }).catch(function (error) {
                    console.log(error)
                });
            } catch (error) {
                console.log(error)
            }
            // }
        } else {
            setformValidationErrorMEssage('Make sure you fill all the required filled')
            handleClickOpen();
        }
    }



    return (
        <div>
            <Header />
            <Backdrop
                sx={{ color: 'var(--base-color)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={isloading}>
                <CircularProgress color="inherit" />
            </Backdrop>
            <Dialog
                // fullScreen={fullScreen}
                open={open}
                onClose={handleClose}
                aria-labelledby="responsive-dialog-title"
            >
                <DialogTitle id="responsive-dialog-title">
                    {"Validation error"}
                </DialogTitle>
                <DialogContent>
                    <DialogContentText>
                        {formValidationErrorMEssage}
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose}>
                        Close
                    </Button>
                </DialogActions>
            </Dialog>
            <React.Fragment>
                <CssBaseline />
                <div className='uploadBody'>
                    <Typography variant="h4">
                        Describe your lot
                    </Typography>
                    <Typography variant="subtitle1">Tell us everything about your lot by filling in the details below. If you're unsure of something,
                        don't worry! An expert will review your submission. </Typography>
                    <div style={{ marginBottom: '20px' }}>
                        <Accordion>
                            <AccordionSummary
                                expandIcon={<ExpandMoreIcon />}
                                aria-controls="panel1a-content"
                                id="panel1a-header"
                            >
                                <Typography>Image tips</Typography>
                            </AccordionSummary>
                            <AccordionDetails>
                                <ul>
                                    <li>Minimum of 30 photos</li>
                                    <li>Successful sellers upload at least 37 photos</li>
                                    <li>Leave nothing out</li>
                                    <li>Steady your camera</li>
                                    <li>Use proper lighting</li>
                                    <li>Use a neutral background</li>
                                    <li>Your best picture is your calling card</li>
                                </ul>
                            </AccordionDetails>
                        </Accordion>
                    </div>
                    <Divider />
                    <section className='sideSection'>
                        <div className='sideBAr'>
                            <div className='categrysideBArBody sideBArkids' onClick={(e) => switched('category', e, 0)}>
                                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                                    <div style={{ display: 'flex', alignItems: 'center' }}>
                                        <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="checkmark-circle-outline"></IonIcon>
                                        <div style={{ textIndent: "5px", }}>
                                            <div className='link_header_special'>Category</div>
                                            <div>
                                                <span style={{ color: 'gray' }} className='link_header_special_simple'>{categoryValue}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <IonIcon style={{ fontSize: '22px', color: 'gray' }} name="chevron-forward-outline"></IonIcon>
                                </div>
                            </div>
                            <Divider />
                            <div className='photoideBArBody sideBArkids' onClick={(e) => switched('photo', e, 1)} >
                                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                                    <div style={{ display: 'flex', alignItems: 'center' }}>
                                        <IonIcon style={{ fontSize: '25px', color: images.length > 2 ? 'var(--base-color)' : 'gray' }} name="checkmark-circle-outline"></IonIcon>
                                        <div style={{ textIndent: "5px", }}>
                                            <div className='link_header_special'>Photos</div>
                                            <div>
                                                <span style={{ color: 'gray' }} className='link_header_special_simple'>{images.length} photo uploaded</span>
                                            </div>
                                        </div>
                                    </div>
                                    <IonIcon style={{ fontSize: '22px', color: 'gray' }} name="chevron-forward-outline"></IonIcon>
                                </div>
                            </div>
                            <Divider />
                            <Divider />
                            <div className='photoideBArBody sideBArkids' onClick={(e) => switched('detail', e, 2)} >
                                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                                    <div style={{ display: 'flex', alignItems: 'center' }}>
                                        <IonIcon style={{ fontSize: '25px', color: detailValidationSuccess == true && description != '' ? 'var(--base-color)' : 'gray' }} name="checkmark-circle-outline"></IonIcon>
                                        <div style={{ textIndent: "5px", }}>
                                            <div className='link_header_special'>Details</div>
                                            <div>
                                                <span style={{ color: 'gray' }} className='link_header_special_simple'>Add details of your lots</span>
                                            </div>
                                        </div>
                                    </div>
                                    <IonIcon style={{ fontSize: '22px', color: 'gray' }} name="chevron-forward-outline"></IonIcon>
                                </div>
                            </div>
                            <Divider />
                            <Divider />
                            <div className='photoideBArBody sideBArkids' onClick={(e) => switched('estimated', e, 3)}>
                                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                                    <div style={{ display: 'flex', alignItems: 'center' }}>
                                        {/* <IonIcon style={{ fontSize: '25px' }} name="checkmark-circle-outline"></IonIcon>  */}
                                        <IonIcon style={{ fontSize: '25px', color: finalValidation == 'good' ? 'var(--base-color)' : 'gray' }} name="checkmark-circle-outline"></IonIcon>
                                        <div style={{ textIndent: "5px", }}>
                                            <div className='link_header_special'>Estimated</div>
                                            <div>
                                                <span style={{ color: 'gray' }} className='link_header_special_simple'>Estimated value: 0€</span>
                                            </div>
                                        </div>
                                    </div>
                                    <IonIcon style={{ fontSize: '22px', color: 'gray' }} name="chevron-forward-outline"></IonIcon>
                                </div>
                            </div>
                            <Divider />
                        </div>
                        <div className='sideBarBody'>
                            <>
                                <div className='goBAckCSs' onClick={goBack}>
                                    <IonIcon style={{ fontSize: '35px', color: 'gray' }} name="arrow-back-circle-outline"></IonIcon>
                                </div>
                                {
                                    wichOn == 'category' ?
                                        <div className='categryBody'>
                                            {/* <h3>Category</h3> */}
                                            <Typography variant="h5">
                                                Category
                                            </Typography>
                                            <Typography variant="subtitle1">Select a category that fits your lot.
                                                Unsure what to choose? Pick the best option and our expert will ensure it’s correct. </Typography>
                                            <FormControl>
                                                <FormLabel id="demo-controlled-radio-buttons-group">Choose between this </FormLabel>
                                                <RadioGroup
                                                    aria-labelledby="demo-controlled-radio-buttons-group"
                                                    name="controlled-radio-buttons-group"
                                                    defaultValue={categoryValue}
                                                    onChange={(event, newValue) => {
                                                        setcategoryValue(newValue)
                                                        window.history.pushState(window.location.href.split('/upload-dashboard')[0],
                                                            "new url", "/upload-dashboard/" + event.target.name + '-' + newValue)
                                                        seturlChange(true)
                                                        setdetailsId(event.target.name)
                                                    }}
                                                >
                                                    {
                                                        category.map((data, key) => (
                                                            <FormControlLabel name={data.id.toString()} key={key} value={data.Label} control={<Radio />} label={data.Label} />)
                                                        )
                                                    }
                                                </RadioGroup>
                                            </FormControl>
                                        </div>
                                        : wichOn == 'photo' ?
                                            <div className='photoBody'>
                                                <h3>Photos</h3>
                                                <p style={{ color: 'gray' }}>Upload photos that showcase your lot in the best way. Remember
                                                    to include different angles and to put your best photo first.</p>
                                                {
                                                    images.length < 3 ? <p style={{ color: 'red', fontSize: '14px' }}>Add more photos. You need a minimum of 3 photos to submit.</p> : <></>
                                                }
                                                <ImageUploading
                                                    multiple
                                                    value={images}
                                                    onChange={onChange}
                                                    maxNumber={maxNumber}
                                                    dataURLKey="data_url"
                                                >
                                                    {({
                                                        imageList,
                                                        onImageUpload,
                                                        onImageRemoveAll,
                                                        onImageUpdate,
                                                        onImageRemove,
                                                        isDragging,
                                                        dragProps
                                                    }) => (
                                                        <div className="upload__image-wrapper">
                                                            {
                                                                images.length == 0 ? <div
                                                                    style={isDragging ? { color: "red" } : null}
                                                                    onClick={onImageUpload}
                                                                    {...dragProps}
                                                                    className='dropBox'
                                                                >

                                                                    <IonIcon style={{ fontSize: '100px', color: 'gray' }} name="cloud-upload-outline"></IonIcon>
                                                                    <p style={{ fontSize: '18px', color: 'var(--base-color)' }}>No file choosed yet</p>

                                                                    <div className='buttonGlobal'>
                                                                        <span>Upload File</span>
                                                                    </div>

                                                                </div> : <></>
                                                            }
                                                            <div className="image-item">
                                                                {imageList.map((image, index) => (
                                                                    <div key={index} >
                                                                        <img className='imagesUploaded' src={image.data_url} alt="" width="100" />
                                                                        <div className="image-item__btn-wrapper">
                                                                            <div style={{
                                                                                display: 'flex', alignItems: 'center',
                                                                                justifyContent: 'center', marginTop: "10px", cursor: 'pointer'
                                                                            }}>
                                                                                <div onClick={() => onImageUpdate(index)} className=''>
                                                                                    <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="create-outline"></IonIcon>
                                                                                </div>
                                                                                <div onClick={() => onImageRemove(index)}>
                                                                                    <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="trash-outline"></IonIcon>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                ))}
                                                            </div>
                                                            {
                                                                images.length > 0 ?
                                                                    <div className='imageBoxFooter'>
                                                                        <div className='buttonGlobal'
                                                                            style={isDragging ? { color: "red" } : null}
                                                                            onClick={onImageUpload}
                                                                            {...dragProps}>
                                                                            <span>Upload new File again</span>
                                                                        </div>

                                                                        <div className='buttonGlobal' onClick={onImageRemoveAll}>Remove all images</div>
                                                                    </div>
                                                                    : <></>
                                                            }
                                                        </div>
                                                    )}
                                                </ImageUploading>
                                            </div>
                                            : wichOn == 'detail' ?
                                                <div className='detailBody'>
                                                    <h3>Details</h3>
                                                    <p style={{ color: 'gray' }}>To give us the best overview of your lot, please enter all of the required details as accurately as possible.
                                                        This way you’ll speed up the expert's review and increase your lot's findability, meaning it will attract more bidders.</p>
                                                    <div>
                                                        {
                                                            Object.keys(detailData).length > 0 ?
                                                                Object.keys(detailData).map((data, key) => {
                                                                    console.log(data)
                                                                    if (detailData[data][0]["ways"].split('|')[0] == 'let user enter data') {
                                                                        if (detailData[data][0]["ways"].split('|')[1] == 'date') {
                                                                            return (
                                                                                <div key={key} style={{ marginBottom: '20px' }}>
                                                                                    <div style={{ marginBottom: '10px' }}>
                                                                                        <span style={{ color: 'rgba(0, 0, 0, 0.87)' }}>{detailData[data][0]["attribute_type"]}</span>
                                                                                    </div>
                                                                                    <DateTimePicker
                                                                                        format='y-MM-dd'
                                                                                        disableClock={true}
                                                                                        onChange={
                                                                                            dateOnChange
                                                                                        }
                                                                                        value={dateValue}
                                                                                        calendarIcon={<IonIcon style={{ fontSize: '17px', color: 'gray' }} name="calendar-sharp"></IonIcon>}
                                                                                        // style={{ width: '300px' }}
                                                                                        className='fieldDetail'
                                                                                    />
                                                                                    <div className='fieldDetail' style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                                                                        <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                                                            {
                                                                                                Object.keys(detailGlobalError).length > 0 ?
                                                                                                    detailGlobalError[detailData[data][0]["attribute_type"]] == null ||
                                                                                                        detailGlobalError[detailData[data][0]["attribute_type"]].length == 0 ?
                                                                                                        'Required field*' : ''
                                                                                                    : ''
                                                                                            }
                                                                                        </div>

                                                                                        <div class="dropdown">
                                                                                            <span>
                                                                                                <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="alert-circle"></IonIcon>
                                                                                            </span>
                                                                                            <div class="dropdown-content">
                                                                                                {detailData[data][0]["attribute_desc"]}
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            )
                                                                        } else if (detailData[data][0]["ways"].split('|')[1] == 'number') {
                                                                            return (
                                                                                <>
                                                                                    <div key={key} style={{ marginBottom: '20px' }}>
                                                                                        <TextField value={
                                                                                            Object.keys(detailGlobalError).length > 0 ?
                                                                                                detailGlobalError[detailData[data][0]["attribute_type"]] !== null
                                                                                                    ? detailGlobalError[detailData[data][0]["attribute_type"]] : '' : ''
                                                                                        } onInput={(e) => setdetailGlobalError(prev => {
                                                                                            return { ...prev, [detailData[data][0]["attribute_type"]]: e.target.value }
                                                                                        })} type={'number'} className='fieldDetail'
                                                                                            id="standard-basic" label={detailData[data][0]["attribute_type"] + "*"}
                                                                                            variant="outlined" />

                                                                                        <div className='fieldDetail' style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                                                                            <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                                                                {
                                                                                                    Object.keys(detailGlobalError).length > 0 ?
                                                                                                        detailGlobalError[detailData[data][0]["attribute_type"]] == null ||
                                                                                                            detailGlobalError[detailData[data][0]["attribute_type"]].length == 0 ?
                                                                                                            'Required field*' : ''
                                                                                                        : ''
                                                                                                }
                                                                                            </div>

                                                                                            <div class="dropdown">
                                                                                                <span>
                                                                                                    <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="alert-circle"></IonIcon>
                                                                                                </span>
                                                                                                <div class="dropdown-content">
                                                                                                    {detailData[data][0]["attribute_desc"]}
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </>
                                                                            )
                                                                        }
                                                                        else {
                                                                            return (
                                                                                <>
                                                                                    <div key={key} style={{ marginBottom: '20px' }}>
                                                                                        <TextField value={
                                                                                            Object.keys(detailGlobalError).length > 0 ?
                                                                                                detailGlobalError[detailData[data][0]["attribute_type"]] !== null
                                                                                                    ? detailGlobalError[detailData[data][0]["attribute_type"]] : '' : ''
                                                                                        } onInput={(e) => setdetailGlobalError(prev => {
                                                                                            return { ...prev, [detailData[data][0]["attribute_type"]]: e.target.value }

                                                                                        })} className='fieldDetail'
                                                                                            id="standard-basic" label={detailData[data][0]["attribute_type"] + "*"}
                                                                                            variant="outlined" />

                                                                                        <div className='fieldDetail' style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                                                                            <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                                                                {
                                                                                                    Object.keys(detailGlobalError).length > 0 ?
                                                                                                        detailGlobalError[detailData[data][0]["attribute_type"]] == null ||
                                                                                                            detailGlobalError[detailData[data][0]["attribute_type"]].length == 0 ?
                                                                                                            'Required field*' : ''
                                                                                                        : ''
                                                                                                }
                                                                                            </div>

                                                                                            <div class="dropdown">
                                                                                                <span>
                                                                                                    <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="alert-circle"></IonIcon>
                                                                                                </span>
                                                                                                <div class="dropdown-content">
                                                                                                    {detailData[data][0]["attribute_desc"]}
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </>
                                                                            )
                                                                        }
                                                                    } else if (detailData[data][0]["ways"] == 'unique data') {
                                                                        return (
                                                                            <div key={key} sx={{ marginBottom: '20px' }}>
                                                                                <FormControl className='fieldDetail'>
                                                                                    <InputLabel id="demo-simple-select-label">{detailData[data][0]["attribute_type"]}</InputLabel>
                                                                                    <Select
                                                                                        labelId="demo-simple-select-label"
                                                                                        id="demo-simple-select"
                                                                                        value={detailGlobalError[detailData[data][0]["attribute_type"]]}
                                                                                        label={detailData[data][0]["attribute_type"]}
                                                                                        onChange={(event) =>
                                                                                            setdetailGlobalError(prev => {
                                                                                                return { ...prev, [detailData[data][0]["attribute_type"]]: event.target.value }
                                                                                            })
                                                                                        }
                                                                                    >
                                                                                        {detailData[data].map((data2, key) => (
                                                                                            <MenuItem key={key} value={data2.values}>
                                                                                                <ListItemText primary={data2.values} />
                                                                                            </MenuItem>
                                                                                        ))}
                                                                                    </Select>
                                                                                </FormControl>
                                                                                <div className='fieldDetail' style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                                                                    <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                                                        {
                                                                                            Object.keys(detailGlobalError).length > 0 ?
                                                                                                detailGlobalError[detailData[data][0]["attribute_type"]] == null ||
                                                                                                    detailGlobalError[detailData[data][0]["attribute_type"]].length == 0 ?
                                                                                                    'Required field*' : ''
                                                                                                : ''
                                                                                        }
                                                                                    </div>

                                                                                    <div class="dropdown">
                                                                                        <span>
                                                                                            <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="alert-circle"></IonIcon>
                                                                                        </span>
                                                                                        <div class="dropdown-content">
                                                                                            {detailData[data][0]["attribute_desc"]}
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        )
                                                                    }
                                                                    else if (detailData[data][0]["ways"] == 'many data') {
                                                                        return (
                                                                            <div key={key}>
                                                                                <FormControl className='fieldDetail' sx={{ marginBottom: '20px', }}>
                                                                                    <InputLabel id="demo-multiple-checkbox-label">{detailData[data][0]["attribute_type"]}</InputLabel>
                                                                                    <Select
                                                                                        labelId="demo-multiple-checkbox-label"
                                                                                        id="demo-multiple-checkbox"
                                                                                        multiple
                                                                                        value={manyData[detailData[data][0]["attribute_type"]] !== undefined ? manyData[detailData[data][0]["attribute_type"]] : []}
                                                                                        onChange={handleChange}
                                                                                        input={<OutlinedInput label={detailData[data][0]["attribute_type"]} />}
                                                                                        renderValue={(selected) => detailData[data][0]["attribute_type"] + ' ' + selected.length}
                                                                                        MenuProps={MenuProps}
                                                                                        name={detailData[data][0]["attribute_type"]}
                                                                                    >
                                                                                        {detailData[data].map((data2, key) => (
                                                                                            <MenuItem key={key} value={data2.values}>
                                                                                                <Checkbox checked={manyData[detailData[data][0]["attribute_type"]] !== undefined ?
                                                                                                    manyData[detailData[data][0]["attribute_type"]].indexOf(data2.values) > -1 : false} />
                                                                                                {/*  */}
                                                                                                <ListItemText primary={data2.values} />
                                                                                            </MenuItem>
                                                                                        ))}
                                                                                    </Select>
                                                                                    <div className='fieldDetail' style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                                                                                        <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                                                            {
                                                                                                Object.keys(detailGlobalError).length > 0 ?
                                                                                                    detailGlobalError[detailData[data][0]["attribute_type"]] == null ||
                                                                                                        detailGlobalError[detailData[data][0]["attribute_type"]].length == 0 ?
                                                                                                        'Required field*' : ''
                                                                                                    : ''
                                                                                            }
                                                                                        </div>

                                                                                        <div class="dropdown">
                                                                                            <span>
                                                                                                <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)' }} name="alert-circle"></IonIcon>
                                                                                            </span>
                                                                                            <div class="dropdown-content">
                                                                                                {detailData[data][0]["attribute_desc"]}
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                </FormControl>


                                                                            </div>
                                                                        )
                                                                    }
                                                                })
                                                                : <></>
                                                        }
                                                        <FormControl fullWidth sx={{ m: 1 }}>
                                                            <TextField
                                                                id="outlined-multiline-static"
                                                                label="Description"
                                                                multiline
                                                                value={description}
                                                                rows={4}
                                                                placeholder="Use this section to add any extra information"
                                                                onInput={(e) => setdescription(e.target.value)}
                                                            />
                                                            <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                                {

                                                                    description == '' ?
                                                                        'Required field*' : ''
                                                                }
                                                            </div>
                                                        </FormControl>
                                                    </div>
                                                </div>
                                                :
                                                wichOn == 'estimated' ?
                                                    <div className='estimatedBody'>
                                                        <h3>Estimated value</h3>
                                                        <p style={{ color: 'gray' }}>
                                                            Bidders won't see this, only our experts. They will let you know if they agree with your estimate.
                                                        </p>
                                                        <h3>How much do you think your object is worth?</h3>
                                                        <div>
                                                            <TextField
                                                                onInput={(e) => setestimatinGlobalValidation(prev => {
                                                                    return { ...prev, etsimation: e.target.value }

                                                                })}
                                                                value={estimatinGlobalValidation.etsimation}
                                                                type='number' id="filled-basic" label="Enter estimation" variant="filled" />
                                                            <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                                {
                                                                    estimatinGlobalValidation.etsimation == '' ? 'Required field*' : ''
                                                                }
                                                            </div>
                                                        </div>

                                                        <Divider style={{ marginTop: "20px" }} />
                                                        <h3>What's the minimum price you'll accept</h3>
                                                        <TextField
                                                            onInput={(e) => setestimatinGlobalValidation(prev => {
                                                                return { ...prev, minimumPRice: e.target.value }
                                                            })}
                                                            value={estimatinGlobalValidation.minimumPRice}
                                                            type='number' id="filled-basic" label="Enter price" variant="filled" />
                                                        <div style={{ marginTop: '10px', fontSize: '12px', color: 'red' }}>
                                                            {
                                                                estimatinGlobalValidation.minimumPRice == '' ? 'Required field*' : ''
                                                            }
                                                        </div>
                                                        <Divider style={{ marginTop: "20px" }} />
                                                    </div>
                                                    :
                                                    <></>
                                }
                            </>

                        </div>
                    </section>
                    <Divider />

                </div>
                <AppBar position="fixed" color="primary" sx={{ top: 'auto', bottom: 0, background: 'white', boxShadow: 'none' }}>
                    <div className='uploadbtnBlock'>
                        {finalValidation !== 'good' ?
                            <div onClick={next} className='buttonGlobal' style={{ color: "white", background: 'var(--base-color)' }}>
                                <span>Next</span>
                            </div>
                            : <></>
                        }

                        <div onClick={sendUpload} className='buttonGlobal' style={{ background: finalValidation == 'good' ? 'var(--base-color)' : '#f0f1f5', color: finalValidation == 'good' ? 'white' : 'gray' }}>
                            <span>Confirm & sumbit</span>
                        </div>

                    </div>
                </AppBar>
            </React.Fragment>
        </div>
    );
}

export default Upload;
