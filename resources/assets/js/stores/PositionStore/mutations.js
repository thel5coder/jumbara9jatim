import * as types from '../mutation-types';

export default {
    [types.BROWSE](state, { data }) {
        state.positions = data;
    },
    [types.READ](state,{index,data}){
        if(index == null){
            state.position = data
        }else{
            state.position = state.positions[index]
        }
    },
    [types.EDIT](state,{index,data}){
        state.positions[index].positionId = data.positionId
        state.positions[index].positionName = data.positionName
        state.positions[index].isActive = data.isActive
    },
    [types.ADD](state,{data}){
        state.positions.push(data)
    },
    [types.DELETE](state,{index}){
        state.positions.splice(index,1)
    }
};
