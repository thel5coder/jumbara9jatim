import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.participantTasks = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.participantTask = data
        }else{
            state.participantTask = state.participantTasks[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.participantTasks[index] = data
    },
    [types.ADD](state,{data}){
        state.participantTasks = data
    },
    [types.DELETE](state,{index}){
        state.participantTasks.splice(index,1)
    }
};
