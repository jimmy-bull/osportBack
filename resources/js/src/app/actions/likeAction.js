const LikeAction = (DATA) => {
    return {
        type: 'LIKE',
        payload: { data: DATA }
    }
}

export default LikeAction;