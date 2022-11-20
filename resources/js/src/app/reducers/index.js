import loginReducer from './loginREducer'
import { configureStore } from '@reduxjs/toolkit';
import LikeReducer from './likeReducer';
export const allMyreducers = configureStore({
    reducer: {
        loginReducer,
        LikeReducer
    },
});
