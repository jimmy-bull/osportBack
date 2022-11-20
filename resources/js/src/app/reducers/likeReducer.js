let initialState = {
    data: 0
}
const LikeReducer = (state = initialState, action) => {
    let nextState;
    switch (action.type) {
        case "LIKE":
            nextState = {
                ...state,
                data: action.payload.data
            }
            return nextState
        default:
            return initialState
    }
}
export default LikeReducer