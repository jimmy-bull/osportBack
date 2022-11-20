import React, { useState, useEffect } from 'react';
import '../style/login.css';
import axios from 'axios';
import { useForm } from "react-hook-form";
import CircularProgress from '@mui/material/CircularProgress';
import Alert from '@mui/material/Alert';
import { useDispatch } from 'react-redux';
import Header from "./header";
import _GLobal_Link from './global';
import { Link } from "react-router-dom";
import { IonIcon } from "react-ion-icon";
import Skeleton from '@mui/material/Skeleton';


function Favourite() {
    const [allProducts, setallProducts] = useState([]);
    const [connected, setConnected] = useState(false);
    const [addLike, setaddLike] = useState(false);
    const _AddLike = (article_id, e) => {
        if (localStorage.getItem("session_token")) {
            axios.get(_GLobal_Link._link_simple + 'api/like/' + localStorage.getItem("session_token") + '/' + article_id, {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            }).then((res2) => {
                setaddLike(true)
            })
            e.currentTarget.parentNode.style.display = 'none'
        }
        //console.log()
    }
    const [isloading, setisloading] = useState(true);

    useEffect(() => {
        if (localStorage.getItem("session_token")) {
            axios.get(_GLobal_Link._link_simple + 'api/seeIfLIked_GET/' + localStorage.getItem("session_token"), {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            }).then((res2) => {
                setisloading(false)
                console.log(res2.data)
                //   console.log(Object.keys(res2.data).length)
                if (res2.data !== "not connected") {
                    setallProducts(res2.data)
                    setConnected(true)
                    console.log(res2.data)
                } else {
                    setConnected(false)

                }
            })
        }
    }, [])

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
            if (days >= 0) {
                document.getElementById(id).innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            } else {
                document.getElementById(id).innerHTML = 'Closed for bidding'
            }
        }
    }

    return (
        <>
            <Header />
            <div className="carouselBody">
                <div className='gridBody'>
                    {isloading === false ?
                        connected === true ?
                            Object.keys(allProducts).length > 0 ?
                                Object.values(allProducts).map((data, key) => (
                                    <div key={data[0].id}>
                                        <div className="heartBlock" onClick={(e) => { _AddLike(data[0].id, e); }}  >
                                            <IonIcon
                                                style={{ color: "var(--base-color)" }}
                                                name="close-outline"></IonIcon>
                                        </div>
                                        <Link className="bigBox" to={'/detail/' + data[0].id + '-' + data[0].category_name + '-' +
                                            data[0].category_id + "/" + data[0].end
                                        } style={{ textDecoration: 'none' }}>
                                            <div className="gridFlex">
                                                <img src={_GLobal_Link._link_simple + data[0].image_link.replace("public", "storage")} alt="" />
                                            </div>
                                            <div>
                                                <span style={{ color: "black", }}>{data[0].name}</span>
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

                                                <span id={data[0].id + 'fave'} style={{ color: "gray", fontSize: "15px", }}>
                                                    {
                                                        setInterval(() => {
                                                            counterDate(data[0].end, data[0].id + 'fave')
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
                                        <Alert severity="info">No product have been liked</Alert>
                                    </div>
                                </div>


                            : <div style={{ display: 'flex', justifyContent: 'center', marginTop: '20px', marginBottom: '20px', flex: 1 }}>
                                <div>
                                    <Alert severity="info">PLease login to see your liked product !</Alert>
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
            </div>
        </>
    );
}

export default Favourite;
