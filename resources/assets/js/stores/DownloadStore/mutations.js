import * as types  from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.downloads = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.download = data
        }else{
            state.download = state.downloads[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.downloads[index] = data
    },
    [types.ADD](state,{data}){
        state.downloads.push(data)
    },
    [types.DELETE](state,{index}){
        state.downloads.splice(index,1)
    }
};
