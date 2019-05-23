import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.taskCategories = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.taskCategory = data
        }else{
            state.taskCategory = state.taskCategories[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.taskCategories[index] = data
    },
    [types.ADD](state,{data}){
        state.taskCategories.push(data)
    },
    [types.DELETE](state,{index}){
        state.taskCategories.splice(index,1)
    }
};
