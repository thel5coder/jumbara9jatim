import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.schedules = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.schedule = data
        }else{
            state.schedule = state.schedules[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.schedules[index] = data
    },
    [types.ADD](state,{data}){
        state.schedules.push(data)
    },
    [types.DELETE](state,{index}){
        state.schedules.splice(index,1)
    }
};
