import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.contingents = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.contingent = data
        }else{
            state.contingent = state.contingents[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.contingents[index].contingentId = data.contingentId
        state.contingents[index].contingentName = data.contingentName
        state.contingents[index].isActive = data.isActive
    },
    [types.ADD](state,{data}){
        state.contingents.push(data)
    },
    [types.DELETE](state,{index}){
        state.contingents.splice(index,1)
    }
};
