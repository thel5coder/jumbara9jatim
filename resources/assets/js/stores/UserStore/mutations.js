import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.users = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.user = data
        }else{
            state.user = state.users[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.users[index] = data
    },
    [types.ADD](state,{data}){
        state.users.push(data)
    },
    [types.DELETE](state,{index}){
        state.users.splice(index,1)
    }
};
