import * as types  from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.userLevels = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.userLevel = data
        }else{
            state.userLevel = state.userLevels[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.userLevels[index] = data
    },
    [types.ADD](state,{data}){
        state.userLevels.push(data)
    },
    [types.DELETE](state,{index}){
        state.userLevels.splice(index,1)
    }
};
