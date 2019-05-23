import * as types from '../mutation-types';
import PositionHelper from "../../helpers/PositionHelper";
import Vue from 'vue'

export function browse({dispatch,commit,rootGetters}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data jabatan'
    let url ='position'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
    PositionHelper.browse(url)
        .then((response)=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            let results =[];
            results = response.data.result
            commit(types.BROWSE,{data:results})
        })
        .catch((error)=>{
            Vue.toasted.error(error.response.data.errorMessage,{duration:5000})
        })
}

export function read({dispatch,commit,rootGetters},{id,index}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data jabatan'

    if(index == null){
        let url = 'position/'+id
        dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
        PositionHelper.read(url)
            .then((response)=>{
                dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
                commit(types.READ,{index:null,data:response.data.result})
            })
            .catch((error)=>{
                dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
                Vue.toasted.error(error.response.data.errorMessage,{duration:5000})
            })
    }else{
        commit(types.READ,{index})
    }
}

export function edit({dispatch,commit,rootGetters},{index,input}) {
    let isLoading = true
    let loadingMessage = 'Sedang menyimpan data, tunggu...'
    let url = 'position/update'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
    return PositionHelper.edit(url,input)
        .then((response)=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            commit(types.ADD,{index:index,data:input})
            Vue.toasted.success('Data jabatan berhasil di ubah')
            return true
        })
        .catch((error)=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            Vue.toasted.error(error.response.data.errorMessage)
            return false
        })
}

export function add({dispatch,commit,rootGetters},{input}) {
    let isLoading = true
    let loadingMessage = 'Sedang menyimpan data, tunggu...'
    let url = 'position/create'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
    return PositionHelper.add(url,input)
        .then((response)=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            commit(types.ADD,{data:input})
            Vue.toasted.success('Data jabatan berhasil di simpan')
            return true
        })
        .catch((error)=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            Vue.toasted.error(error.response.data.errorMessage)
            return false
        })
}

export async function del({dispatch,commit,rootGetters},{id,index}) {
    let isLoading = true
    let loadingMessage = 'Sedang menghapus data, tunggu...'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})

    if(id == null){
        commit(types.DELETE,{index:index})
        dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
        Vue.toasted.success('Data jabatan berhasil di hapus',{duration:5000})
    }else{
        let url = 'position/'+id+'/delete'
        PositionHelper.delete(url)
            .then((response)=>{
                dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
                commit(types.DELETE,{index:index})
                dispatch('browse')
            })
            .catch((error)=>{
                dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
                Vue.toasted.error(error.response.data.errorMessage,{duration:5000})
            })
    }
}
