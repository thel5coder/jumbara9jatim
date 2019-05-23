import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.participants = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.participant = data
        }else{
            state.participant = state.participants[index]
        }
    },
    [types.EDIT](state,{index,data}) {
        state.participants[index] = data
    },
    [types.ADD](state,{data}){
        state.participants.push(data)
    },
    [types.DELETE](state,{index}){
        state.participants.splice(index,1)
    }
};
