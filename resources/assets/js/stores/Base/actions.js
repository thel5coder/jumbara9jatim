import * as types from '../mutation-types';

export function changeLoadingState({ commit }, { isLoading,loadingMessage }) {
    commit(types.SET_SHOW_LOADING, { isLoading });
    commit(types.SET_LOADING_MESSAGE,{loadingMessage: loadingMessage})
}
