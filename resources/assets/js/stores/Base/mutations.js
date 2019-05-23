import * as types from '../mutation-types';

export default {
    [types.SET_LOADING_MESSAGE](state, { message }) {
        state.loadingMessage = message;
    },
    [types.SET_SHOW_LOADING](state,{isLoading}){
        state.isLoadingShow = isLoading
    }
};
