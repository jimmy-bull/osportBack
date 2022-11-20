import React, { useState, useEffect, useLayoutEffect, useMemo } from 'react';
import axios from 'axios';
import '../style/products.css'
import {
    Link,
    useParams
} from "react-router-dom";
import { useForm } from "react-hook-form";
import '../style/detail.css'
import _GLobal_Link from './global';
import { Swiper, SwiperSlide } from "swiper/react";
import Paper from '@mui/material/Paper';
import InputBase from '@mui/material/InputBase';
import Echo from "laravel-echo";
import "swiper/css";
import "swiper/css/free-mode";
import "swiper/css/navigation";
import "swiper/css/thumbs";
import Alert from '@mui/material/Alert';
import Button from '@mui/material/Button';
import Backdrop from '@mui/material/Backdrop';
import CircularProgress from '@mui/material/CircularProgress';
import { FreeMode, Navigation, Thumbs } from "swiper";
import ScrollToTop from "react-scroll-to-top";
import Header from "./header";
import TextField from '@mui/material/TextField';
import NumberFormat from "react-number-format";

// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";



// import "./styles.css";

// import required modules
import { Pagination } from "swiper";
import { TextFields } from '@mui/icons-material';

let Pusher = require("pusher-js");
function Detail() {
    const [getproductName, setproductName] = useState('')
    const { id, category, categoryid, date } = useParams();
    const [thumbsSwiper, setThumbsSwiper] = useState(null);
    const [getProductImage, setProductImage] = useState([])
    const [bidErrorText, setbidErrorText] = useState('');
    const [bidValueFieldError, setbidValueFieldError] = useState(false);
    const [bidValueFieldErrorText, setbidValueFieldErrorText] = useState('');
    const { register, handleSubmit, formState: { errors } } = useForm();
    const [isloading, setisloading] = useState(false);
    const [NotconnectdError, setNotconnectdError] = useState(false);
    const [NotconnectdErrorText, setNotconnectdErrorText] = useState('');
    const [currentBid, setcurrentBid] = useState('');
    const [nextMinimumBid, setnextMinimumBid] = useState(0);
    const [biderrDatta, setbiderrDatta] = useState([]);
    const [mainCArouselImage, setmainCArouselImage] = useState({});
    const [allDataImages, setallDataImages] = useState([]);
    const [allDetails, setallDetails] = useState([]);
    const [reloadBId, setreloadBId] = useState('');
    const [amount, setamount] = useState(0);
    const [baseValue, setbaseValue] = useState(0);

    // const [peakChange, setpeakChange] = useState(0);
    // const [iterate, setIterate] = useState(0);


    // useLayoutEffect(() => {
    //     // setpeakChange([])
    //     axios.get(_GLobal_Link.link + "product?id=" + id + '&include=media', {
    //         headers: {
    //             "content-type": "application/json",
    //             'Access-Control-Allow-Credentials': true,
    //             'Access-Control-Allow-Origin': true
    //         },
    //     }).then((res) => {
    //         setproductName(res.data.data.attributes['product.label'])
    //         for (let index = 0; index < res.data.included.length; index++) {
    //             if (res.data.included[index].type === 'media') {
    //                 setProductImage((prev) => [...prev, [res.data.included[index].attributes['media.url']]]);
    //             }
    //         }
    //     })
    //     axios.get(_GLobal_Link._link_simple + "api/getBid/" + id, {
    //         headers: {
    //             "content-type": "application/json",
    //             'Access-Control-Allow-Credentials': true,
    //             'Access-Control-Allow-Origin': true
    //         },
    //     }).then((res) => {
    //         if (res.data.currentBid === null) {
    //             setcurrentBid(0);
    //         } else {
    //             setcurrentBid(res.data.currentBid);
    //         }
    //         setnextMinimumBid(res.data.nextMinimumBid);

    //         setbiderrDatta(res.data.biderrDatta);
    //     })
    // }, [])

    useLayoutEffect(() => {
        axios.get(_GLobal_Link._link_simple + 'api/getALLproductId/' + id, {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true
            },
        }).then((res) => {
            setmainCArouselImage(res.data[0]);
            setallDataImages(res.data);
        })

        axios.get(_GLobal_Link._link_simple + 'api/getAlldetails/' + id, {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true
            },
        }).then((res) => {
            setallDetails(res.data)
        })

        axios.get(_GLobal_Link._link_simple + 'api/getBid/' + id, {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true,
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
            },
        }).then((res) => {
            if (res.data.currentBid === null) {
                setcurrentBid(0);
            } else {
                setcurrentBid(res.data.currentBid);
            }
            setnextMinimumBid(res.data.nextMinimumBid);
            setbaseValue(res.data.nextMinimumBid);
            setbiderrDatta(res.data.biderrDatta);
        })
        window.scrollTo(0, 0);
        //   console.log(process.env.MIX_PUSHER_APP_KEY)
    }, [id]);
    useEffect(() => {
        //   Pusher.logToConsole = true;
        // var pusher = new Pusher('a43107042413cb1b3ef0', {
        //     cluster: 'eu'
        // });
        // var channel = pusher.subscribe('bid-system-channel');
        // channel.bind('App\\Events\\Bid', function (e) {
        //     if (e.currentBid === null) {
        //         setcurrentBid(0);
        //     } else {
        //         setcurrentBid(e.currentBid);
        //     }
        //     setnextMinimumBid(e.nextMinimumBid);
        //     setbaseValue(e.nextMinimumBid);
        //     setbiderrDatta(e.biderrDatta);
        //     // console.log()
        //     // console.log(e)
        // });


        window.Echo = new Echo({
            broadcaster: "pusher",
            key: process.env.MIX_PUSHER_APP_KEY,
            forceTLS: true,
            cluster: "mt1",
            // wsHost: window.location.hostname,
            // wsPort: 6001,
            // // wssPort: 6001,
            // disableStats: true,
        });
        window.Echo.channel("bid-system-channel").listen(".bidsystem", (e) => {

            // if (e.currentBid === null) {
            //     setcurrentBid(0);
            // } else {
            //     setcurrentBid(e.currentBid);
            // }
            // setnextMinimumBid(e.nextMinimumBid);
            // setbaseValue(e.nextMinimumBid);
            // setbiderrDatta(e.biderrDatta);
            alert(e)
        });
    });


    const onSubmit = data => {
        if (amount > 0) {
            setbidErrorText('')
            setisloading(true)
            let linkFinal = '';
            let linkFinal_under = '';

            if (intervalReady === true) {
                linkFinal = _GLobal_Link._link_simple + 'api/bid/' + id + '/' + localStorage.getItem("session_token") +
                    '/' + amount + "/" + categoryid;
                linkFinal_under = _GLobal_Link._link_simple + 'api/broadcast/' + id + "/" + categoryid;
            } else {
                linkFinal = _GLobal_Link._link_simple + 'api/bid/' + id + '/' + localStorage.getItem("session_token") +
                    '/' + amount + "/" + 0;
                linkFinal_under = _GLobal_Link._link_simple + 'api/broadcast/' + id + "/" + 0;
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
                        if (res.data === 'Already connected') {
                            console.log(linkFinal = _GLobal_Link._link_simple + 'api/bid/' + id + '/' + localStorage.getItem("session_token") +
                                '/' + amount + "/" + categoryid)
                            axios.get(linkFinal, {
                                headers: {
                                    "content-type": "application/json",
                                    'Access-Control-Allow-Credentials': true,
                                    'Access-Control-Allow-Origin': true,
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                                },
                            }).then((res) => {
                                if (res.data !== 'Bid added') {
                                    setbidValueFieldErrorText(res.data);
                                    setbidValueFieldError(true)
                                    setisloading(false);
                                } else {
                                    setbidValueFieldError(false)
                                    setisloading(false);
                                }
                                axios.get(linkFinal_under, {
                                    headers: {
                                        "content-type": "application/json",
                                        'Access-Control-Allow-Credentials': true,
                                        'Access-Control-Allow-Origin': true,
                                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                                    },
                                }).then((res) => {
                                })
                            })
                        }
                    });
            } else {
                setisloading(false)
                setNotconnectdError(true)
                setNotconnectdErrorText("You'll need to Sign in or Create a free account before bidding.")
                window.scrollTo(0, 0)
            }
        } else {
            // 
            setbidErrorText('Please insert a valid bid amount')
        }
    }
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
            document.getElementById(id).innerHTML = 'The auction will end in ' + days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        }
    }


    const counterShow = () => {
        return (
            <div style={{ fontWeight: 'bold', }} id={'detailDate' + id}>
                {
                    setInterval(() => {
                        counterDate(date, 'detailDate' + id);
                    }, 1000)
                }
            </div>
        )
    }
    const countershowomplement = useMemo(() => counterShow(), [date, id]);

    const counterDateMinute = (countDownDate) => {
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = new Date(countDownDate).getTime() - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if (hours == 0) {
            return minutes + (seconds * 0.0166667);
        } else if (hours > 0) {
            return 'still normal'
        } else if (hours < 0) {
            return minutes + (seconds * 0.0166667);
        }

    }
    const [intervalReady, setintervalReady] = useState(false);

    const [augmentationINterval, setaugmentationINterval] = useState(false);

    const [bidOff, setbidOff] = useState(false);
    useEffect(() => {
        setaugmentationINterval(setInterval(() => {
            if (counterDateMinute(date) !== 'still normal') {
                if (counterDateMinute(date) <= 3 && counterDateMinute(date) > 0) {
                    setintervalReady(true)
                } else if (counterDateMinute(date) == 0 || counterDateMinute(date) < 0) {
                    setbidOff(true)
                }
            } else {
                // console.log(counterDateMinute(date))
            }
            // console.log(date)
        }, 1000))

    }, [])
    useEffect(() => {
        if (bidOff === true) {
            clearInterval(augmentationINterval);
            axios.get(_GLobal_Link._link_simple + 'api/sendwinningMail/' + id, {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            }).then((res) => {
                // console.log(res.data);
            })
        }
    }, [bidOff]);

    useEffect(() => {
        if (intervalReady === true) {
            axios.get(_GLobal_Link._link_simple + 'api/broadcast/' + id + "/" + categoryid, {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true,
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                },
            }).then((res) => {
                // clearInterval(augmentationINterval); send message to tell user that current is tel montant and bid time is under 4 minutes
            })
        }
    }, [intervalReady])
    // console.log(new Date(date).getTime() - new Date().getTime())
    return (
        <div>
            <Header />
            <ScrollToTop smooth />
            <Backdrop
                sx={{ color: 'var(--base-color)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={isloading}>
                <CircularProgress color="inherit" />
            </Backdrop>

            <div className='carouselBody'>
                <div className='detailBodyD'>
                    <div className='detailBodyDSec'>
                        {NotconnectdError === true ?
                            <div style={{ marginTop: "20px" }}>
                                <Alert severity="error">{NotconnectdErrorText}</Alert>
                            </div> : <></>
                        }
                        {
                            Object.keys(mainCArouselImage).length > 0 ?
                                <div>
                                    <img className='detailImageB' style={{ width: "100%", }} src={_GLobal_Link._link_simple + mainCArouselImage.image_link.replace("public", "storage")} alt="" />
                                </div> : <></>
                        }
                        <Swiper
                            slidesPerView={6}
                            spaceBetween={30}
                            pagination={{
                                clickable: true,
                            }}
                            modules={[Pagination]}
                            className="mySwiper"
                            style={{ height: '100px', }}>
                            {
                                allDataImages.map((data, key) => (
                                    <SwiperSlide key={key}>
                                        <img onClick={(e) => document.querySelector('.detailImageB').src = e.target.src} style={{ objectFit: 'contain', height: '100px' }}
                                            src={_GLobal_Link._link_simple + data.image_link.replace("public", "storage")}
                                            alt="" />
                                    </SwiperSlide>
                                ))
                            }
                        </Swiper>
                    </div>
                    <div className='titleDetailBlock'>
                        <div style={{ paddingLeft: '20px', paddingRight: '20px', flex: 1, textAlign: 'start' }}>
                            <span className='detailH1'>{mainCArouselImage.name}</span>
                            {
                                bidOff !== true ?
                                    <div>
                                        {countershowomplement}
                                    </div> :
                                    <div style={{ fontWeight: 'bold', }}>

                                        <Alert severity="info"> Bid was closed on this day : {date}</Alert>
                                    </div>
                            }

                            <div className='titleDetail'>
                                <strong >{getproductName}</strong>
                            </div>
                            <div className='biftitleDetail'>
                                {
                                    bidOff !== true ?
                                        <strong>Current bid € {currentBid}</strong>
                                        :
                                        <Alert severity="success"><strong> Winning bid € {currentBid}</strong></Alert>
                                }
                            </div>
                            <div style={{ marginTop: '10px' }}>

                                {
                                    currentBid !== "" ?
                                        bidOff !== true ? mainCArouselImage.minimum_price > 0 ?
                                            parseInt(currentBid.toString().replace(',', "")) < mainCArouselImage.minimum_price ?
                                                <Alert severity="info">The current bid for this lot falls below its reserve price</Alert>
                                                :
                                                <Alert severity="info">The current bid for this lot is higher than its reserve price.</Alert>
                                            : <Alert severity="success" style={{ textTransform: 'uppercase' }}>No reserve price</Alert>
                                            : <></>
                                        : <></>
                                }

                            </div>
                            {/* <div>
                                <span style={{ color: 'gray', fontSize: '18px' }}>It’s a great time to bid!</span>
                            </div> */}
                            <div>
                                {currentBid !== "" ?
                                    bidOff !== true ? parseInt(currentBid.toString().replace(',', "")) < parseInt(mainCArouselImage.price) ?
                                        <Alert severity="info">The current bid is still under the estimate.</Alert>
                                        :
                                        <Alert severity="info">The current bid is higher than the estimate.</Alert>
                                        : <></>
                                    : <></>
                                }
                            </div>
                            {
                                bidOff !== true ? <div className='biftitleDetail'>
                                    <strong >Next minimum bid € {nextMinimumBid}</strong>
                                </div> : <></>
                            }
                            {/* {currentBid !== "" ? typeof parseInt(currentBid.toString().replace(',', "")) : ''}
                            {'-'}
                            {typeof parseInt(' ' + mainCArouselImage.price)} */}
                            <div>
                                <span style={{ color: 'gray', fontSize: '18px' }}>Auction fee: 9% of the winning bid</span>
                            </div>
                            <hr />
                            {bidOff !== true ? <>
                                <div className='biftitleDetail'>
                                    <strong >Bid directly</strong>
                                </div>
                                <Paper onSubmit={handleSubmit(onSubmit)} component="form" sx={{ p: '2px 4px', display: 'flex', alignItems: 'center', background: '#f0f1f5', color: 'gray', boxShadow: 'none', marginLeft: "10px", marginTop: '10px', marginBottom: '20px' }}>
                                    <div style={{ flex: 1 }}>
                                        <NumberFormat
                                            style={{ flex: 1, fontFamily: "'Oswald', sans-serif", lineHeight: '30px', borderWidth: '0px', fontSize: '17px', }}
                                            thousandSeparator={true}
                                            placeholder="Enter your Bid"
                                            className="amount"
                                            inputMode="numeric"
                                            name='amount'
                                            value={baseValue}
                                            onValueChange={(e) => {
                                                setbaseValue(e.value)
                                                setamount(e.value)
                                                if (e.value > 0) {
                                                    setbidErrorText('')
                                                } else {
                                                    setbidErrorText('Please insert a valid bid amount')
                                                }
                                            }
                                            }
                                        />
                                        <strong style={{ color: 'red', marginLeft: '10px' }}>
                                            {bidErrorText}
                                        </strong>
                                    </div>
                                    <Button type='submit' style={{ boxShadow: 'none', fontSize: '17px', color: 'white', background: 'var(--base-color)', display: 'flex', alignItems: 'center', marginLeft: "10px" }} variant="contained" >
                                        <div>
                                            <span style={{ textTransform: 'lowercase' }}>Place Bid</span>
                                        </div>
                                    </Button>
                                </Paper>
                                {bidValueFieldError === true ?
                                    <div style={{ marginTop: "20px" }}>
                                        <Alert severity="error">{bidValueFieldErrorText}</Alert>
                                    </div> : <></>
                                }
                                <hr /></> : ''}


                            <div style={{ height: '195px', overflow: 'scroll' }}>
                                {biderrDatta.map((data, key) => (
                                    <div key={key} style={{ display: 'flex', marginTop: '10px', justifyContent: 'space-between', }}>
                                        <div>
                                            <strong style={{ fontSize: '14px' }}>{data.bider_id}</strong>
                                        </div>
                                        <div style={{ fontSize: '14px' }}>
                                            <strong style={{ color: 'gray', fontSize: '13px' }}>{new Date(data.created_at).toLocaleDateString("en-US") + ' --- ' +
                                                new Date(data.created_at).getHours() + ':' + new Date(data.created_at).getMinutes() + ':' + new Date(data.created_at).getSeconds()}</strong>
                                        </div>
                                        <div style={{ fontSize: '14px' }}>
                                            <strong style={{ fontSize: '14px' }}>  € {(data.bidDirectly).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} </strong>
                                        </div>
                                    </div>
                                ))}
                                {
                                    biderrDatta.length == 0 ? <Alert severity="info">No one bid yet !</Alert> : ''
                                }

                            </div>
                        </div>
                    </div>
                </div>
                <h1>Description</h1>
                <p style={{ fontSize: '22px', color: 'gray' }}>{mainCArouselImage.description}</p>
                <div className='detailsBoxdetails'>
                    {
                        allDetails.map((data, key) => (
                            <div key={key}>
                                <span style={{ textTransform: 'uppercase', color: 'gray', }}>{data.attr_type}</span>
                                <div style={{ fontWeight: 400, lineHeight: 2, fontSize: '20px' }}>
                                    <span>{data.attr_values}</span>
                                </div>
                            </div>
                        ))
                    }
                </div>
            </div>
        </div>
    );
}
export default Detail;
