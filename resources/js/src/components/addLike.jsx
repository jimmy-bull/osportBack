import axios from 'axios';
import { useDispatch } from 'react-redux';
import _GLobal_Link from '../views/global';
import LikeAction from '../app/actions/likeAction';

const _AddLike = (article_id, token) => {
    const dispatch = useDispatch();
    axios.get(_GLobal_Link._link_simple + 'api/like/' + token + '/' + article_id, {
        headers: {
            "content-type": "application/json",
            'Access-Control-Allow-Credentials': true,
            'Access-Control-Allow-Origin': true
        },
    }).then((res) => {
        //return res.data;
        // console.log(res.data)
        dispatch(LikeAction(res.data));
    })
}
export default _AddLike;