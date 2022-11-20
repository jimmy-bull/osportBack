<ScrollToTop smooth />
<Backdrop
    sx={{ color: 'var(--base-color)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
    open={isloading}>
    <CircularProgress color="inherit" />
</Backdrop>
<div className='topLInk'>
    <Link to='/'>home /</Link>
    <Link to={'/product/' + categoryid + "-" + category}>{category} /</Link>
    <Link to='' onClick={(e) => e.preventDefault()}>{getproductName} /</Link>
    <Link style={{ color: '#007aff', fontWeight: 'bold' }} id={'detailDate' + id} to='' onClick={(e) => e.preventDefault()}>
        {
            setInterval(() => {
                counterDate(date, 'detailDate' + id);
            }, 1000)
        }
    </Link>
</div>
{NotconnectdError === true ?
    <div style={{ marginTop: "20px" }}>
        <Alert severity="error">{NotconnectdErrorText}</Alert>
    </div> : <></>
}
<div className='bidBlockItem'>
    <div>
        <div>
            <Swiper
                spaceBetween={10}
                navigation={true}
                thumbs={{ swiper: thumbsSwiper }}
                modules={[FreeMode, Navigation, Thumbs]}
                className="mySwiper2"
            >
                {
                    [...new Set(getProductImage)].map((data, key) => (
                        <SwiperSlide key={key}>
                            <img style={{ height: "80vh", objectFit: 'contain', background: '#f0f1f5' }} src={_GLobal_Link._link_simple + "aimeos/" + data} alt='' />
                        </SwiperSlide>
                    ))
                }
            </Swiper>
            <Swiper
                onSwiper={setThumbsSwiper}
                spaceBetween={10}
                slidesPerView={7}
                freeMode={true}
                watchSlidesProgress={true}
                modules={[FreeMode, Navigation, Thumbs]}
                className="mySwiper"
            >
                {
                    [...new Set(getProductImage)].map((data, key) => (
                        <SwiperSlide key={key}>
                            <img style={{ height: "100px", objectFit: 'contain', }} src={_GLobal_Link._link_simple + "aimeos/" + data} alt='' />
                        </SwiperSlide>
                    ))
                }
            </Swiper>
        </div>
    </div>
   `
</div>