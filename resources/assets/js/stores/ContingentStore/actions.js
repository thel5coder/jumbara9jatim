import * as types from '../mutation-types';
import ContingentHelper from "../../helpers/ContingentHelper";
import Vue from 'vue'

export function browse({dispatch,commit,rootGetters}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data kontingen'
    let url ='contingent'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
    ContingentHelper.browse(url)
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
    let loadingMessage = 'Mengambil data kontingent'

    if(index == null){
        let url = 'contingent/'+id
        dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
        ContingentHelper.read(url)
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
    let url = 'contingent/update'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
    return ContingentHelper.edit(url,input)
        .then((response)=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            commit(types.ADD,{index:index,data:input})
            Vue.toasted.success('Data kontingen berhasil di ubah')
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
    let url = 'contingent/create'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})
    return ContingentHelper.add(url,input)
        .then((response)=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            commit(types.ADD,{data:input})
            Vue.toasted.success('Data kontingen berhasil di simpan')
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
        Vue.toasted.success('Data kontingen berhasil di hapus',{duration:5000})
    }else{
        let url = 'contingent/'+id+'/delete'
        ContingentHelper.delete(url)
            .then((response)=>{
                dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
                commit(types.DELETE,{index:index})
            })
            .catch((error)=>{
                dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
                Vue.toasted.error(error.response.data.errorMessage,{duration:5000})
            })
    }
}
