import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.tasks = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.task = data
        }else{
            state.task = state.tasks[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.tasks[index] = data
    },
    [types.ADD](state,{data}){
        state.tasks.push(data)
    },
    [types.DELETE](state,{index}){
        state.tasks.splice(index,1)
    }
};
