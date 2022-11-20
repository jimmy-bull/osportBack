import React, { useLayoutEffect, useState, useEffect, useMemo } from "react";
// import Button from "@mui/material/Button";
// import Echo from "laravel-echo";
// import { Swiper, SwiperSlide } from "swiper/react";
// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import Echo from "laravel-echo";
import Skeleton from '@mui/material/Skeleton';

// import { Navigation, Pagination } from "swiper";
import '../style/swipeHome.css'
// import { EffectCreative } from "swiper";
import { Link } from "react-router-dom";
import _GLobal_Link from './global';
import axios from 'axios';
import { IonIcon } from "react-ion-icon";
import ScrollToTop from "react-scroll-to-top";
import Alert from '@mui/material/Alert';
import Header from "./header";
import Paper from '@mui/material/Paper';
import InputBase from '@mui/material/InputBase';
import IconButton from '@mui/material/IconButton';
import SearchIcon from '@mui/icons-material/Search';
import { useSearchParams, } from "react-router-dom";
import Box from '@mui/material/Box';
import Drawer from '@mui/material/Drawer';
import List from '@mui/material/List';
import Backdrop from '@mui/material/Backdrop';
import CircularProgress from '@mui/material/CircularProgress';
import FormControl from '@mui/material/FormControl';
import OutlinedInput from '@mui/material/OutlinedInput';
import InputLabel from '@mui/material/InputLabel';
import Select from '@mui/material/Select';
import Checkbox from '@mui/material/Checkbox';
import MenuItem from '@mui/material/MenuItem';
import ListItemText from '@mui/material/ListItemText';
import { useDispatch } from 'react-redux';
import AllActions from "../app/actions";
import { useSelector } from 'react-redux';
function Home() {

    const [category, setcategory] = useState([]);
    const [getProductsid, setProductsid] = useState([])
    const [NotconnectdError, setNotconnectdError] = useState(false);
    const [NotconnectdErrorText, setNotconnectdErrorText] = useState('');
    const [allProducts, setallProducts] = useState([]);
    // const [categoryFromLink, setcategoryFromLink] = useState('');
    const [categoryState, setcategoryState] = useState('');
    let [searchParams, setSearchParams] = useSearchParams();
    const [isloading, setisloading] = useState(true);
    const [color, setColor] = useState([]);
    const [productState, setproductState] = useState('');
    const [detailData, setdetailData] = useState([]);
    const [manyData, setmanyData] = React.useState([]);
    const [bigLInk, setbigLInk] = React.useState(null);
    const [bigLInk_2, setbigLInk_2] = React.useState(null);
    const [expanded, setExpanded] = React.useState(false);

    const [allProductCount, setallProductCount] = useState(0);

    const handleExpandClick = () => {
        setExpanded(!expanded);
    };
    useEffect(() => {
        for (const [key, value] of searchParams.entries()) {
            if (key === "category") {
                setbigLInk(prev => {
                    return { ...prev, 'category': value, }
                })
            }
        }
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

    useEffect(() => {
        if (getProductsid.length > 0) {
            if (localStorage.getItem("session_token")) {
                axios.get(_GLobal_Link._link_simple + 'api/seeIfLIked/' + localStorage.getItem("session_token"), {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true
                    },
                }).then((res2) => {
                    let ai = {}
                    if (getProductsid.length >= res2.data.length) {
                        getProductsid.forEach(element => {
                            let present = false
                            res2.data.forEach(element2 => {
                                if (element == parseInt(element2)) {
                                    present = true
                                }
                            });
                            if (present) {
                                ai[element] = '#007aff';
                            } else {
                                ai[element] = 'white';
                            }
                        });
                        setColor(ai)
                        ai = []
                    } else if (res2.data.length >= getProductsid.length) {
                        res2.data.forEach(element => {
                            let present = false
                            getProductsid.forEach(element2 => {
                                if (element == parseInt(element2)) {
                                    present = true
                                }
                            });
                            if (present) {
                                ai[element] = '#007aff';
                            } else {
                                ai[element] = 'white';
                            }
                        });
                        setColor(ai)
                        ai = []
                    }
                })
            }
        }

    }, [getProductsid])
    const dispatch = useDispatch();

    const _AddLike = (article_id, e) => {

        if (localStorage.getItem("session_token")) {

            axios.get(_GLobal_Link._link_simple + 'api/like/' + localStorage.getItem("session_token") + '/' + article_id, {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            }).then((res2) => {
                axios.get(_GLobal_Link._link_simple + 'api/seeIfLIked_GET/' + localStorage.getItem("session_token"), {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true
                    },
                }).then((res2) => {
                    dispatch(
                        // {
                        //     type: 'LIKE',
                        //     payload: { data: Object.keys(res2.data).length }
                        // }
                        // AllActions.loginAction("yes", "JImmy"),
                        AllActions.LikeAction(Object.keys(res2.data).length),

                    );

                })
            })
            if (e.target.style.color == 'rgb(0, 122, 255)') {
                e.target.style.color = 'white'
            } else {
                e.target.style.color = '#007aff'
            }
        } else {
            setNotconnectdError(true)
            setNotconnectdErrorText("In order to save your favourite item, you just need to sign in or create a free account.")
            window.scrollTo(0, 0)
        }
    }

    let name = useSelector((state) => state.loginReducer._user_name)



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
    useEffect(() => {
        let obj = {}
        let _obj_set = {}
        for (const [key, value] of searchParams.entries()) {
            if (key !== "query" && key !== "category" && key !== "state") {
                if (obj[key] === undefined) {
                    obj[key] = [];
                    _obj_set[key] = [];
                    obj[key].push(value);
                    _obj_set[key].push(value);
                } else {
                    obj[key].push(value);
                    _obj_set[key].push(value);
                }
            } else if (key === "query") {
                _obj_set[key] = value;
            } else if (key === "category") {
                _obj_set[key] = value;
            } else if (key === "state") {
                _obj_set[key] = value;
            }
        }
        Object.keys(obj).map((data, key) => {
            setmanyData(prev => {
                return { ...prev, [data]: obj[data] }
            })
        })
        setbigLInk(_obj_set)
        setbigLInk_2(_obj_set)
        // console.log(_obj_set)
    }, [])



    useEffect(() => {
        window.onpopstate = function () {
            setmanyData([])
            setbigLInk_2([])
            function searchToObject() {
                var pairs = window.location.search.substring(1).split("&"),
                    obj = {},
                    pair,
                    i;

                for (i in pairs) {
                    if (pairs[i] === "") continue;

                    pair = pairs[i].split("=");
                    if (obj[decodeURIComponent(pair[0])] === undefined) {
                        obj[decodeURIComponent(pair[0])] = [];
                        obj[decodeURIComponent(pair[0])].push(decodeURIComponent(pair[1]).toString());
                    } else {
                        obj[decodeURIComponent(pair[0])].push(decodeURIComponent(pair[1]).toString());
                    }

                }

                return obj;
            }
            let obj = {}
            let _obj_set = {}

            Object.keys(searchToObject()).map((value, key) => {
                if (value !== "query" && value !== "category" && value !== "state") {
                    obj[value] = searchToObject()[value]
                    _obj_set[value] = searchToObject()[value];
                } else if (value === "query") {
                    _obj_set[value] = searchToObject()[value].toString();
                } else if (value === "category") {
                    _obj_set[value] = searchToObject()[value].toString();
                } else if (value === "state") {
                    _obj_set[value] = searchToObject()[value].toString();
                }
            })
            Object.keys(obj).map((data, key) => {
                return setmanyData(prev => {
                    return { ...prev, [data]: obj[data] }
                })

            })

            setbigLInk_2(_obj_set)
        };
    }, [])


    useEffect(() => {
        if (bigLInk_2 !== null) {
            // alert('ok')
            // setbigLInk_2([])
            // setmanyData([])
            function clean(obj) {
                for (var propName in obj) {
                    if (obj[propName].length === 0 || obj[propName] === undefined) {
                        delete obj[propName];
                    }
                }
                return obj
            }
            setisloading(true)
            axios.get(_GLobal_Link._link_simple + 'api/getATTR_CAT', {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            }).then((res) => {
                axios.get(_GLobal_Link._link_simple + 'api/getGBlobalProduct/' + res.data[0][0].id + "/" + JSON.stringify(clean(bigLInk_2)), {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true
                    },
                }).then((res) => {
                    console.log(res.data[1])
                    setallProductCount(res.data[1])
                    setallProducts([]);
                    setallProducts(res.data[0]);
                    setProductsid(Object.keys(res.data[0]))
                    setisloading(false)
                })
            })
        }
    }, [bigLInk_2])

    const changeFocusCategory = (e) => {
        setmanyData([])
        setbigLInk([])
        for (let index = 0; index < document.querySelector('.catElementBlockFIrst').children.length; index++) {
            document.querySelector('.catElementBlockFIrst').children[index].classList.remove('catElementFIrst');
            document.querySelector('.catElementBlockFIrst').children[index].classList.add('catElement');
        }
        e.currentTarget.classList.add('catElementFIrst');
        setcategoryState(e.currentTarget.innerHTML)
        if (document.getElementById('home_search').value.trim() === "") {
            sendQueryFromSearchBAr(e.currentTarget.innerHTML, e.currentTarget.innerHTML, productState)
        } else {
            sendQueryFromSearchBAr(document.getElementById('home_search').value, e.currentTarget.innerHTML, productState)
        }
    }

    const changeFocusState = (e, productState) => {
        for (let index = 0; index < document.querySelector('.catElementBlockunder').children.length; index++) {
            document.querySelector('.catElementBlockunder').children[index].classList.remove('catElementFIrst');
            document.querySelector('.catElementBlockunder').children[index].classList.add('catElement');
        }
        e.currentTarget.classList.add('catElementFIrst');

        if (categoryState.trim() === "") {
            if (document.getElementById('home_search').value.trim() === "") {

                sendQueryFromSearchBAr(category[0].Label, category[0].Label, productState)
            } else {

                sendQueryFromSearchBAr(document.getElementById('home_search').value, category[0].Label, productState)
            }
        } else {
            if (document.getElementById('home_search').value.trim() === "") {
                sendQueryFromSearchBAr(categoryState, categoryState, productState)
            } else {
                sendQueryFromSearchBAr(document.getElementById('home_search').value, categoryState, productState)
            }
        }

    }

    const sendQueryFromSearchBAr = (query, categories, state) => {
        if (state.trim() === "") {
            setbigLInk(prev => {
                return { ...prev, 'query': query, 'category': categories, 'state': 'live' }
            })
        } else {
            setbigLInk(prev => {
                return { ...prev, 'query': query, 'category': categories, 'state': state }
            })
        }
    }

    const [state, setState] = React.useState({
        right: false,
    });
    const toggleDrawer = (anchor, open) => (event) => {
        if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
            return;
        }
        setState({ ...state, [anchor]: open });
        axios.get(_GLobal_Link._link_simple + 'api/getATTR_CAT', {
            headers: {
                "content-type": "application/json",
                'Access-Control-Allow-Credentials': true,
                'Access-Control-Allow-Origin': true
            },
        }).then((res) => {
            if (searchParams.get('category') !== null) {
                axios.get(_GLobal_Link._link_simple + 'api/getALLYATTR/' + searchParams.get('category'), {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true
                    },
                }).then((res) => {
                    let result = res.data.reduce(function (r, a) {
                        r[a.attr_type] = r[a.attr_type] || [];
                        r[a.attr_type].push(a);
                        return r;
                    }, Object.create(null));
                    setdetailData(result)
                })
            } else {
                axios.get(_GLobal_Link._link_simple + 'api/getATTR_CAT', {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true
                    },
                }).then((res) => {
                    axios.get(_GLobal_Link._link_simple + 'api/getALLYATTR/' + res.data[0][0].Label, {
                        headers: {
                            "content-type": "application/json",
                            'Access-Control-Allow-Credentials': true,
                            'Access-Control-Allow-Origin': true
                        },
                    }).then((res) => {
                        let result = res.data.reduce(function (r, a) {
                            r[a.attr_type] = r[a.attr_type] || [];
                            r[a.attr_type].push(a);
                            return r;
                        }, Object.create(null));
                        setdetailData(result)
                    })
                })
            }
        })
    };

    const handleChange = (event) => {
        const {
            target: { value, name },
        } = event;
        setmanyData(prev => {
            return { ...prev, [name]: value }
        })

        setbigLInk(prev => {
            return { ...prev, [name]: value }
        })
        if (searchParams.getAll('page').length > 0) {
            setcurrentPage(1)
            if (searchParams.getAll('query').length === 0) {
                setbigLInk(prev => {
                    return { ...prev, 'query': category[0].Label, 'category': category[0].Label, 'state': 'live', 'page': [1] }
                })
            } else {
                setcurrentPage(1)
                setbigLInk(prev => {
                    return {
                        ...prev, 'query': searchParams.getAll('query')[0],
                        'category': searchParams.getAll('category')[0],
                        'state': searchParams.getAll('state')[0], [name]: value,
                        'page': [1]
                    }
                })
            }
        } else {
            if (searchParams.getAll('query').length === 0) {
                setbigLInk(prev => {
                    return { ...prev, 'query': category[0].Label, 'category': category[0].Label, 'state': 'live', }
                })
            } else {
                setbigLInk(prev => {
                    return {
                        ...prev, 'query': searchParams.getAll('query')[0],
                        'category': searchParams.getAll('category')[0],
                        'state': searchParams.getAll('state')[0], [name]: value,
                    }
                })
            }
        }
    };
    useLayoutEffect(() => {
        if (bigLInk !== null) {
            function clean(obj) {
                for (var propName in obj) {
                    if (obj[propName].length === 0 || obj[propName] === undefined) {
                        delete obj[propName];
                    }
                }
                return obj
            }
            setisloading(true)
            axios.get(_GLobal_Link._link_simple + 'api/getATTR_CAT', {
                headers: {
                    "content-type": "application/json",
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': true
                },
            }).then((res) => {
                console.log(_GLobal_Link._link_simple + 'api/getGBlobalProduct/' + res.data[0][0].id + "/" + JSON.stringify(clean(bigLInk)))
                axios.get(_GLobal_Link._link_simple + 'api/getGBlobalProduct/' + res.data[0][0].id + "/" + JSON.stringify(clean(bigLInk)), {
                    headers: {
                        "content-type": "application/json",
                        'Access-Control-Allow-Credentials': true,
                        'Access-Control-Allow-Origin': true
                    },
                }).then((res) => {

                    console.log(res.data[1])
                    setallProductCount(res.data[1])
                    setallProducts([]);
                    setSearchParams(bigLInk)
                    setallProducts(res.data[0]);
                    setProductsid(Object.keys(res.data[0]))
                    setisloading(false)
                })
            })
        }
        // axios.get(_GLobal_Link._link_simple + 'api/getATTR_CAT', {
        //     headers: {
        //         "content-type": "application/json",
        //         'Access-Control-Allow-Credentials': true,
        //         'Access-Control-Allow-Origin': true
        //     },
        // }).then((res) => {
        //     if (Object.keys(clean(bigLInk)).length === 0) {
        //         setallProducts([]);
        //         axios.get(_GLobal_Link._link_simple + 'api/getALLproduct/' + res.data[0][0].id, {
        //             headers: {
        //                 "content-type": "application/json",
        //                 'Access-Control-Allow-Credentials': true,
        //                 'Access-Control-Allow-Origin': true
        //             },
        //         }).then((res) => {
        //             setallProducts(res.data);
        //             setProductsid(Object.keys(res.data))
        //             setisloading(false)
        //             setready(true)
        //         })
        //     }
        //     else if (Object.keys(clean(bigLInk)).length > 0) {
        //         setallProducts([]);
        //         setSearchParams(bigLInk)
        //         if (Object.keys(clean(bigLInk)).length > 3) {
        //             setallProducts([]);
        //             setProductsid([])
        //             axios.get(_GLobal_Link._link_simple + 'api/bigsearch/' + JSON.stringify(clean(bigLInk)), {
        //                 headers: {
        //                     "content-type": "application/json",
        //                     'Access-Control-Allow-Credentials': true,
        //                     'Access-Control-Allow-Origin': true
        //                 },
        //             }).then((res) => {
        //                 setallProducts(res.data);
        //                 setProductsid(Object.keys(res.data))
        //                 setisloading(false)
        //             })
        //         } else if (Object.keys(clean(bigLInk)).length === 3) {
        //             setProductsid([])
        //             setallProducts([]);
        //             axios.get(_GLobal_Link._link_simple + 'api/search/' + JSON.stringify(clean(bigLInk)), {
        //                 headers: {
        //                     "content-type": "application/json",
        //                     'Access-Control-Allow-Credentials': true,
        //                     'Access-Control-Allow-Origin': true
        //                 },
        //             }).then((res) => {
        //                 setallProducts(res.data);
        //                 setProductsid(Object.keys(res.data))
        //                 setisloading(false)
        //             })
        //         }

        //     }
        // })

    }, [bigLInk]);

    const ITEM_HEIGHT = 48;
    const ITEM_PADDING_TOP = 8;
    const MenuProps = {
        PaperProps: {
            style: {
                maxHeight: ITEM_HEIGHT * 4.5 + ITEM_PADDING_TOP,
                width: "100%",
            },
        },
    };


    const list = () => (
        <Box
            style={{ width: '350px', padding: '20px' }}
            role="presentation"
        // onClick={toggleDrawer(anchor, false)}
        // onKeyDown={toggleDrawer(anchor, false)}
        //className='fieldDetail'
        >


            <div className="headerFilter">
                <div onClick={toggleDrawer("right", false)}> <IonIcon style={{ fontSize: '25px', color: 'var(--base-color)', cursor: 'pointer' }} name="close-outline"></IonIcon></div>

                <div>Filters</div>
            </div>

            {
                Object.keys(detailData).length > 0 ?
                    Object.keys(detailData).map((data, key) => {
                        return (
                            <List key={key}>
                                <FormControl style={{ marginBottom: '20px', width: "100%" }}>
                                    <InputLabel id="demo-multiple-checkbox-label">{detailData[data][0]["attr_type"]}</InputLabel>
                                    <Select
                                        labelId="demo-multiple-checkbox-label"
                                        id="demo-multiple-checkbox"
                                        multiple
                                        value={manyData[detailData[data][0]["attr_type"]] !== undefined ? manyData[detailData[data][0]["attr_type"]] : []}
                                        onChange={handleChange}
                                        input={<OutlinedInput label={detailData[data][0]["attr_type"]} />}
                                        renderValue={(selected) => detailData[data][0]["attr_type"] + ' ' + selected.length}

                                        name={detailData[data][0]["attr_type"]}
                                    >
                                        {detailData[data].map((data2, key2) => (
                                            <MenuItem key={key2} value={data2.attr_values}>
                                                <Checkbox checked={manyData[detailData[data][0]["attr_type"]] !== undefined ?
                                                    manyData[detailData[data][0]["attr_type"]].indexOf(data2.attr_values) > -1 : false} />
                                                {/*  */}
                                                <ListItemText primary={data2.attr_values} />
                                            </MenuItem>
                                        ))}
                                    </Select>
                                </FormControl>
                            </List>
                        )

                    })
                    : <></>
            }
        </Box>
    );
    // const ShowList = useMemo(() => list(), [state, manyData]);
    const [currentPage, setcurrentPage] = useState(1);
    useEffect(() => {
        if (searchParams.getAll('page').length > 0) {
            setcurrentPage(parseInt(searchParams.getAll('page')[0]))
        }
    }, [])
    const changePage = (increment) => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        if (currentPage < Math.ceil(allProductCount / 25)) {
            setcurrentPage(prev => prev + increment);
            setmanyData(prev => {
                return { ...prev, page: [currentPage + increment] }
            })

            setbigLInk(prev => {
                return { ...prev, page: [currentPage + increment] }
            })
            if (searchParams.getAll('query').length === 0) {
                setbigLInk(prev => {
                    return { ...prev, 'query': category[0].Label, 'category': category[0].Label, 'state': 'live' }
                })
            } else {
                setbigLInk(prev => {
                    return {
                        ...prev, 'query': searchParams.getAll('query')[0],
                        'category': searchParams.getAll('category')[0],
                        'state': searchParams.getAll('state')[0], page: [currentPage + increment],
                    }
                })
            }
        } else if (currentPage === Math.ceil(allProductCount / 25)) {
            setcurrentPage(1);
            setmanyData(prev => {
                return { ...prev, page: [1] }
            })

            setbigLInk(prev => {
                return { ...prev, page: [1] }
            })
            if (searchParams.getAll('query').length === 0) {
                setbigLInk(prev => {
                    return { ...prev, 'query': category[0].Label, 'category': category[0].Label, 'state': 'live' }
                })
            } else {
                setbigLInk(prev => {
                    return {
                        ...prev, 'query': searchParams.getAll('query')[0],
                        'category': searchParams.getAll('category')[0],
                        'state': searchParams.getAll('state')[0], page: [1],
                    }
                })
            }
        }
    }


    // categoryState
    /**
     * query for bar de recherche, 
     * obligatoire: category et state
     * quick query = select 
     * si y'a recherche dans la bar: 
     * on fais d'bord recherche dans la tables categorie:
     * si on trouve des resultat avec le champs categori_name:
     * on recupère touts les articles_id dans la tables categorie et on fais la recherche comme d'habitude
     * et apres on part dans la tables details on recupère attr_types et attr_values en fonction du article_id
     * 
     * Qand on ne trouve pas de resultat dans la table categorie:
     *  on part fait la recherche dans la table attr_types:
     * on fait la recherche precisement sur le champs attr_values 
     * si on trouve un resultat ou plusieur resultat on recupère les article_id et on fais la recherche comme d'habitude
     * et apres on part dans la tables details on recupère attr_types et attr_values en fonction du article_id
     * 
     * Si y'a pas de resultat apres tout on sort no result
     */
    return (
        <div>
            <Header />
            {/* {name} satta */}
            <ScrollToTop smooth />
            {/* <Backdrop
                sx={{ color: 'var(--base-color)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={isloading}>
                <CircularProgress color="inherit" />
            </Backdrop> */}
            {NotconnectdError === true ?
                <div style={{ marginTop: "20px", marginBottom: "20px" }}>
                    <Alert severity="error">{NotconnectdErrorText}</Alert>
                </div> : <></>
            }
            <div className="carouselBody">
                <div className="catElementBlock catElementBlockFIrst">
                    {category.map((data, key) => (
                        <div onClick={(e) => changeFocusCategory(e)} key={key}
                            className={
                                searchParams.get('category') !== null
                                    ? data.Label === searchParams.get('category') ?
                                        "catElementFIrst" : "catElement" :
                                    key === 0 ? "catElementFIrst" : "catElement"
                            }
                        >{data.Label}</div>
                    ))}
                </div>
                <div style={{ alignItems: 'center', flex: 1, display: 'flex', justifyContent: "space-between", marginBlock: "20px" }}>
                    <Paper onSubmit={(e) => {
                        e.preventDefault()
                    }} component="form" className="searchBlockP" sx={{ p: '5px 4px', display: 'flex', alignItems: 'center', background: '#f0f1f5', color: 'gray', boxShadow: 'none', }}>
                        <InputBase
                            sx={{ width: '100%', fontFamily: "'Oswald', sans-serif" }}
                            placeholder="Search for model,brand .."
                            inputProps={{ 'aria-label': 'search google maps' }}
                            id='home_search'
                            onKeyDown={(e) => {

                                if (e.keyCode !== undefined) {
                                    if (e.keyCode === 13) {
                                        setmanyData([])
                                        setbigLInk([])
                                        if (categoryState.trim() === "") {
                                            if (document.getElementById('home_search').value.trim() === "") {

                                                sendQueryFromSearchBAr(category[0].Label, category[0].Label, productState)
                                            } else {

                                                sendQueryFromSearchBAr(document.getElementById('home_search').value, category[0].Label, productState)
                                            }
                                        } else {
                                            if (document.getElementById('home_search').value.trim() === "") {
                                                sendQueryFromSearchBAr(categoryState, categoryState, productState)
                                            } else {
                                                sendQueryFromSearchBAr(document.getElementById('home_search').value, categoryState, productState)
                                            }
                                        }
                                    }
                                }
                                else if (e.keyIdentifier !== undefined) {
                                    if (e.keyIdentifier === 13) {
                                        setmanyData([])
                                        setbigLInk([])
                                        if (categoryState.trim() === "") {
                                            if (document.getElementById('home_search').value.trim() === "") {

                                                sendQueryFromSearchBAr(category[0].Label, category[0].Label, productState)
                                            } else {

                                                sendQueryFromSearchBAr(document.getElementById('home_search').value, category[0].Label, productState)
                                            }
                                        } else {
                                            if (document.getElementById('home_search').value.trim() === "") {
                                                sendQueryFromSearchBAr(categoryState, categoryState, productState)
                                            } else {
                                                sendQueryFromSearchBAr(document.getElementById('home_search').value, categoryState, productState)
                                            }
                                        }
                                    }
                                }
                                else if (e.key !== undefined) {
                                    if (e.key === 13) {
                                        setmanyData([])
                                        setbigLInk([])
                                        if (categoryState.trim() === "") {
                                            if (document.getElementById('home_search').value.trim() === "") {

                                                sendQueryFromSearchBAr(category[0].Label, category[0].Label, productState)
                                            } else {

                                                sendQueryFromSearchBAr(document.getElementById('home_search').value, category[0].Label, productState)
                                            }
                                        } else {
                                            if (document.getElementById('home_search').value.trim() === "") {
                                                sendQueryFromSearchBAr(categoryState, categoryState, productState)
                                            } else {
                                                sendQueryFromSearchBAr(document.getElementById('home_search').value, categoryState, productState)
                                            }
                                        }
                                    }
                                }
                            }}
                        />
                        <IconButton type="submit" sx={{ p: '10px' }} aria-label="search">
                            <SearchIcon />
                        </IconButton>

                    </Paper>
                    <div>
                        <span className="link_header_special_simple">{allProductCount} articles</span>
                    </div>
                    <React.Fragment>
                        <div style={{ alignItems: 'center', justifyContent: 'center', cursor: 'pointer' }} onClick={toggleDrawer("right", true)}>
                            <div style={{ alignItems: 'center', display: "flex" }}>
                                <img style={{ height: "24px", width: 'auto', cursor: 'poiner' }} src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iYmxhY2siIHdpZHRoPSIxOHB4IiBoZWlnaHQ9IjE4cHgiPjxwYXRoIGQ9Ik0wIDBoMjR2MjRIMHoiIGZpbGw9Im5vbmUiLz48cGF0aCBkPSJNMyAxN3YyaDZ2LTJIM3pNMyA1djJoMTBWNUgzem0xMCAxNnYtMmg4di0yaC04di0yaC0ydjZoMnpNNyA5djJIM3YyaDR2MmgyVjlIN3ptMTQgNHYtMkgxMXYyaDEwem0tNi00aDJWN2g0VjVoLTRWM2gtMnY2eiIvPjwvc3ZnPg==" alt="filters" />
                                <div style={{ marginLeft: "10px", textTransform: 'uppercase', }}>
                                    <span className="link_header_special_simple">Filter</span>
                                </div>
                            </div>
                        </div>
                        <Drawer
                            anchor={'right'}
                            open={state.right}
                            onClose={toggleDrawer('right', false)}
                        >
                            {list()}
                        </Drawer>
                    </React.Fragment>
                </div>
                <div className="catElementBlock catElementBlockunder">
                    <div className={
                        searchParams.get('state') !== null
                            ? 'live' === searchParams.get('state') ?
                                "catElementFIrst" : "catElement" : "catElementFIrst"
                    } onClick={(e) => {
                        setproductState('live')
                        changeFocusState(e, 'live')
                    }}>Live </div>

                    <div className={
                        searchParams.get('state') !== null
                            ? 'comming' === searchParams.get('state') ?
                                "catElementFIrst" : "catElement" : "catElement"
                    } style={{ marginLeft: '20px' }}
                        onClick={(e) => {
                            setproductState('comming')
                            changeFocusState(e, 'comming')
                        }}>
                        Comming soon</div>
                    <div className={
                        searchParams.get('state') !== null
                            ? 'sold' === searchParams.get('state') ?
                                "catElementFIrst" : "catElement" : "catElement"
                    } style={{ marginLeft: '20px' }}
                        onClick={(e) => {
                            setproductState('sold')
                            changeFocusState(e, 'sold')
                        }}
                    >Sold</div>
                </div>
                <div className='gridBody'>
                    {isloading === false ?
                        Object.keys(allProducts).length > 0 ?
                            Object.values(allProducts).map((data, key) => (
                                <div key={data[0].id}>
                                    <div className="heartBlock" onClick={(e) => { _AddLike(data[0].id, e); }}  >
                                        <IonIcon
                                            style={
                                                {
                                                    color: color[data[0].id] !== undefined ? color[data[0].id] : ''
                                                }
                                            }
                                            name="heart-circle-outline"></IonIcon>
                                    </div>
                                    <Link className="bigBox" to={'/detail/' + data[0].id + '-' + data[0].category_name + '-' +
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


                                            <span className="link_header_special_simple" id={data[0].id + 'home'}>
                                                {
                                                    setInterval(() => {
                                                        counterDate(data[0].end, data[0].id + 'home')
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
                                    <Alert severity="info">Sorry but no result found ! </Alert>
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
                {/* {console.log(allProducts)} */}
                {isloading === false ? Object.keys(allProducts).length > 0 ?
                    <div className='pagination'>
                        <div style={{ cursor: 'pointer' }} onClick={(e) => {
                            if (currentPage > 1) {
                                changePage(-1)
                            }
                        }}>
                            <IonIcon style={{ fontSize: "25px" }} name="chevron-back-outline"></IonIcon>
                        </div>
                        <div>
                            <span>Page {currentPage} sur {Math.ceil(allProductCount / 25)} </span>
                        </div>
                        <div style={{ cursor: 'pointer' }} onClick={(e) => { changePage(+1) }}>
                            <IonIcon style={{ fontSize: "25px" }} name="chevron-forward-outline"></IonIcon>
                        </div>

                    </div> : <></>
                    : <></>
                }
                {/* 
         
                 */}
                <div className="allCategorieBlock">
                    <div>
                        <p><Link to='/'>Archaeology & Natural History</Link> </p>
                        <p><Link to='/'>Cameras & Computers</Link></p>
                        <p><Link to='/'>Fashion</Link></p>
                        <p><Link to='/'>Music</Link></p>
                    </div>
                    <div>
                        <p><Link to='/'>Art</Link></p>
                        <p><Link to='/'>Classic Cars, Motorcycles & Automobilia</Link></p>
                        <p><Link to='/'>Interiors & Decorations</Link></p>
                        <p><Link to='/'>Sports & Events</Link></p>
                    </div>
                    <div>
                        <p><Link to='/'>Asian & Tribal Art</Link></p>
                        <p><Link to='/'>Coins & Stamps</Link></p>
                        <p><Link to='/'>Jewellery & Watches</Link></p>
                        <p><Link to='/'>Toys & Models</Link></p>
                    </div>
                    <div>
                        <p><Link to='/'>Books & Comics</Link></p>
                        <p><Link to='/'>Diamonds & Gemstones</Link></p>
                        <p><Link to='/'>Militaria & Weaponry</Link></p>
                        <p><Link to='/'>Wine & Whisky</Link></p>
                    </div>
                </div>
            </div>
        </div >

    );
}
export default Home;
