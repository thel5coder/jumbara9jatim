import * as types  from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.informations = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.information = data
        }else{
            state.information = state.informations[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.informations[index] = data
    },
    [types.ADD](state,{data}){
        state.informations.push(data)
    },
    [types.DELETE](state,{index}){
        state.informations.splice(index,1)
    }
};
