{NotconnectdError === true ?
    <div style={{ marginTop: "20px", marginBottom: "20px" }}>
        <Alert severity="error">{NotconnectdErrorText}</Alert>
    </div> : <></>
}
<ScrollToTop smooth />
<Swiper
    slidesPerView={1}
    spaceBetween={30}
    navigation={true}
    loop={true}
    pagination={{
        clickable: true,
    }}
    autoplay={{
        delay: 2500,
        disableOnInteraction: false,
    }}
    grabCursor={true}
    effect={"creative"}
    creativeEffect={{
        prev: {
            shadow: true,
            translate: [0, 0, -400],
        },
        next: {
            translate: ["100%", 0, 0],
        },
    }}
    modules={[Navigation, Pagination, EffectCreative]}
    className="mySwiper"
    style={{ maxHeight: '500px', background: '#f0f1f5', minHeight: '500px' }}
>
    {
        [...new Set(FinalCarsouelData)].map((data, key) => (
            <SwiperSlide key={key}>
                <img id={key} alt="" src={_GLobal_Link._link_simple + "aimeos/" + data} />
            </SwiperSlide>
        ))
    }
</Swiper>
<div className="catagoriesBlock">
    <h4 style={{ color: "gray" }}>Categories</h4>
    <div>
        <span style={{ color: 'var(--base-color)' }}>View all</span>
    </div>
</div>
<div className="categorieBlockelement">
    {
        [...new Set(categorieFinalData)].map((data, key) => (
            <Link key={key} to={"/product/" + [...new Set(categorieFinalDataID)][key] + '-' + [...new Set(categorieFinalDataLAbel)][key]} className='elementCategorie'>
                <img alt='' src={_GLobal_Link._link_simple + "aimeos/" + data} />
                <div style={{ marginTop: "10px" }}>
                    {
                        <span style={{ textDecoration: "none" }}>{[...new Set(categorieFinalDataLAbel)][key]}</span>
                    }
                </div>
            </Link>
        ))
    }
</div>
<div className="catagoriesBlock">
    <h4 style={{ color: "gray" }}>Most liked</h4>
</div>
<Swiper
    slidesPerView={3}
    spaceBetween={30}
    navigation={true}
    effect={'cards'}
    pagination={{
        clickable: true,
    }}
    modules={[Navigation]}
    className="mySwiper2"
    breakpoints={{
        "@0.00": {
            slidesPerView: 2,
            spaceBetween: 5,
        },
        "@0.75": {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        "@1.00": {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        "@1.50": {
            slidesPerView: 4,
            spaceBetween: 50,
        },
    }}
>


    {[...new Set(getProductImage)].length > 0 ?
        [...new Set(getProductImage)].map((data, key) => (
            <SwiperSlide key={key} style={{ position: 'relative' }}>

                <div className="heartBlock" onClick={(e) => { _AddLike([...new Set(getProductsid)][key], e); }} >
                    <IonIcon
                        style={
                            {
                                color: color[key] !== undefined ? color[key] : ''
                            }
                        }
                        name="heart-circle-outline"></IonIcon>
                    {/* {[...new Set(getProductsid)][key]} */}
                    {/* {console.log(color[key])} */}
                </div>
                <Link to={
                    '/detail/' + [...new Set(getProductsid)][key] + '-' + getCatalog[key] + '-' +
                    getCatalogId[key] + "/" + [...new Set(getfinishdate)][key]
                } className="bigBox" style={{ textDecoration: 'none' }}>
                    <div className="gridFlex">
                        <img src={_GLobal_Link._link_simple + "aimeos/" + data} alt="" />
                    </div>
                    <div>
                        <span style={{ color: "black", }}>{getProductsName[key]}</span>
                    </div>
                    <div>
                        <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                        <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                        <span id={key + data} style={{ color: "gray", fontSize: "15px", }}>
                            {
                                setInterval(() => {
                                    counterDate([...new Set(getfinishdate)][key], key + data)
                                }, 1000)
                            }
                        </span>
                    </div>
                </Link>
            </SwiperSlide>
        )) : <></>
    }
</Swiper>



        {/* <div className="catagoriesBlock">
                <h4 style={{ color: "gray" }}>Auctions ending soon</h4>
            </div>
            <Swiper
                slidesPerView={3}
                spaceBetween={30}
                navigation={true}
                effect={'cards'}
                pagination={{
                    clickable: true,
                }}
                modules={[Navigation]}
                className="mySwiper2"
                breakpoints={{
                    "@0.00": {
                        slidesPerView: 2,
                        spaceBetween: 5,
                    },
                    "@0.75": {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    "@1.00": {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    "@1.50": {
                        slidesPerView: 4,
                        spaceBetween: 50,
                    },
                }}
            >
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/ed8c79d4-8529-4bbe-bf91-9d5a5e97e7c1-3-1626364671.jpeg?crop=1.00xw:0.788xh;0,0.113xh&resize=640:*" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://picolio.auto123.com/auto123-media/mercedes-benz_100786706_h.jpg" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/ed8c79d4-8529-4bbe-bf91-9d5a5e97e7c1-3-1626364671.jpeg?crop=1.00xw:0.788xh;0,0.113xh&resize=640:*" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://picolio.auto123.com/auto123-media/mercedes-benz_100786706_h.jpg" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/ed8c79d4-8529-4bbe-bf91-9d5a5e97e7c1-3-1626364671.jpeg?crop=1.00xw:0.788xh;0,0.113xh&resize=640:*" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://picolio.auto123.com/auto123-media/mercedes-benz_100786706_h.jpg" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/ed8c79d4-8529-4bbe-bf91-9d5a5e97e7c1-3-1626364671.jpeg?crop=1.00xw:0.788xh;0,0.113xh&resize=640:*" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>
                <SwiperSlide style={{ position: 'relative' }}>
                    <div className="heartBlock" >
                        <IonIcon name="heart-circle-outline"></IonIcon>
                    </div>
                    <Link className="bigBox" to='/' style={{ textDecoration: 'none' }}>
                        <div className="gridFlex">
                            <img src="https://picolio.auto123.com/auto123-media/mercedes-benz_100786706_h.jpg" alt="" />
                        </div>
                        <div>
                            <span style={{ color: "black", }}>Ferrari - Formula One - Rear wing</span>
                        </div>
                        <div>
                            <span style={{ color: "gray", fontSize: "16px", }}>Current Bid</span> -
                            <span style={{ fontSize: "16px", color: "gray", marginLeft: "5px" }}>€ 2,200</span><br />
                            <span style={{ color: "gray", fontSize: "15px", }}>1d 4h 58m 47s</span>
                        </div>
                    </Link>

                </SwiperSlide>



            </Swiper> */}

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
                            if (res.data.included[index].attributes['catalog.label'] === 'Carousel') {
                                if (res.data.included[index].links.self.href !== undefined) {
                                    axios.get(res.data.included[index].links.self.href + "&include=catalog,media", {
                                        headers: {
                                            "content-type": "application/json",
                                            'Access-Control-Allow-Credentials': true,
                                            'Access-Control-Allow-Origin': true
                                        },
                                    }).then((res2) => {
                                        for (let index2 = 0; index2 < res2.data.included.length; index2++) {
                                            if (res2.data.included[index2].relationships !== undefined) {
                                                for (let index3 = 0; index3 < res2.data.included[index2].relationships.media.data.length; index3++) {
                                                    relationShipid.push(res2.data.included[index2].relationships.media.data[index3].id)
                                                }
                                            }
                                            if (typeof relationShipid === 'object') {
                                                for (let index4 = 0; index4 < relationShipid.length; index4++) {
                                                    if (res2.data.included[index2].id === relationShipid[index4]) {
                                                        setFinalCarsouelData((prev) => [...prev, res2.data.included[index2].attributes["media.url"]])
                                                    }
                                                }
                                            }
                                        }
                                    })
                                }
                            } else {
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
                                                    setcategorieFinalData((prev) => [...prev, res.data.included[index4].attributes["media.url"]])
                                                } else if (res.data.included[index4].id !== relationShipidCat[index6]) {
                                                    if (res.data.included[index4].attributes["catalog.label"] !== undefined &&
                                                        res.data.included[index4].attributes["catalog.label"] !== 'Carousel') {
                                                        setcategorieFinalDataLAbel((prev) => [...prev, res.data.included[index4].attributes["catalog.label"]])
                                                        setcategorieFinalDataID((prev) => [...prev, res.data.included[index4].id])
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    });
            }, []);
        

            useLayoutEffect(() => {
                let newTable = []
                axios.get(_GLobal_Link._link_simple + 'api/mostLiked/', {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true
                    },
                }).then((res) => {
                    res.data.forEach(element => {
                        element.forEach(element2 => {
                            // 
                            newTable.push(element2.article_id)
                        });
                    });
                    //console.log(newTable)
                    axios.get(_GLobal_Link.link + "product?include=media", {
                        headers: {
                            "content-type": "application/json",
                            'Access-Control-Allow-Credentials': true,
                            'Access-Control-Allow-Origin': true
                        },
                    }).then((res) => {
        
                        let finalLiked = []
                        for (let index = 0; index < res.data.data.length; index++) {
                            newTable.forEach(element => {
                                if (element == res.data.data[index].attributes['product.id']) {
                                    finalLiked.push(element)
                                }
                            });
                        }
                        let temporyTable = [...new Set(finalLiked)]
                        // console.log(temporyTable)
        
                        if (localStorage.getItem("session_token")) {
                            // console.log(getProductsid)
                            axios.get(_GLobal_Link._link_simple + 'api/seeIfLIked/' + localStorage.getItem("session_token"), {
                                headers: {
                                    "content-type": "application/json",
                                    'Access-Control-Allow-Credentials': true,
                                    'Access-Control-Allow-Origin': true
                                },
                            }).then((res2) => {
                                // console.log(res2.data)
                                // setColor(res2.data);
                                if (temporyTable.length > 0 && res2.data != 'not connected') {
                                    let ai = []
                                    temporyTable.forEach(element => {
                                        let present = false
                                        res2.data.forEach(element2 => {
                                            if (element == element2) {
                                                present = true
                                            }
                                        });
                                        if (present) {
                                            ai.push('#007aff')
                                        } else {
                                            ai.push('white')
                                        }
                                    });
                                    setColor(ai)
                                    console.log(ai)
                                    ai = []
                                }
                            })
                        }
        
        
        
        
                        temporyTable.forEach(element => {
                            axios.get(_GLobal_Link.link + "product?id=" + element + "&include=media,catalog", {
                                headers: {
                                    "content-type": "application/json",
                                    'Access-Control-Allow-Credentials': true,
                                    'Access-Control-Allow-Origin': true
                                },
                            }).then((res) => {
                                setProductsid((prev) => [...prev, res.data.data.attributes['product.id']])
                                setProductsName((prev) => [...prev, res.data.data.attributes['product.label']])
                                setfinishdate((prev) => [...prev, res.data.data.attributes['product.dateend']])
                                setProductImage((prev) => [...prev, res.data.included[0].attributes['media.url']])
                                res.data.included.forEach(element2 => {
                                    if (element2.type === 'catalog') {
                                        setCatalog((prev) => [...prev, element2.attributes['catalog.label']])
                                        setCatalogId((prev) => [...prev, element2.id])
                                    }
                                });
                            })
                        });
                    })
                })
            }, [])
        