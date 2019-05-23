import * as types from '../mutation-types';
import UserHelper from '../../helpers/UserHelper';
import Vue from 'vue';

export function browse({dispatch, commit, rootGetters}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data pengguna'
    let url = '/user'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    UserHelper.browse(url).then((response) => {
        dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
        let results = [];
        results = response.data.result
        commit(types.BROWSE, {data: results})
    }).catch((error) => {
        console.log(error.response)
    })
}

export function read({dispatch, commit, rootGetters}, {id, index}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data pengguna'

    if (index == null) {
        let url = 'user/' + id
        dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
        UserHelper.read(url).then((response) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            commit(types.READ, {index: null, data: response.data.result})
        }).catch((error) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            Vue.toasted.error(error.response.data.errorMessage, {duration: 5000})
        })
    } else {
        commit(types.READ, {index})
    }
}

export function edit({dispatch, commit, rootGetters}, {index, input}) {
    let isLoading = true
    let loadingMessage = 'Sedang menyimpan data, tunggu...'
    let url = 'user/update'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        UserHelper.edit(url, input).then(() => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            commit(types.ADD, {data: input})
            resolve('Data berhasil di simpan')
        }).catch((error) => {
            console.log(error)
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            reject(error)
        })
    })
}

export function add({dispatch, commit, rootGetters}, {input}) {
    let isLoading = true
    let loadingMessage = 'Sedang menyimpan data, tunggu...'
    let url = 'user/create'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        UserHelper.add(url, input).then((response) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            commit(types.ADD, {data: input})
            resolve('Data berhasil di simpan')
        }).catch((error) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            reject(error)
        })
    })
}

export async function del({dispatch, commit, rootGetters}, {id, index}) {
    let isLoading = true
    let loadingMessage = 'Sedang menghapus data, tunggu...'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})

    let url = 'user/' + id + '/delete'
    return new Promise((resolve, reject) => {
        UserHelper.delete(url)
            .then((response) => {
                dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
                commit(types.DELETE, {index: index})

                resolve('Data berhasil di hapus')
            }).catch((error) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})

            reject(error.response.data.errorMessage)
        })
    })
}

export function changePassword({dispatch,commit,rootGetters},{input}) {
    let url = 'user/change-password'
    let isLoading = true
    let loadingMessage = 'Sedang mengubah kata sandi, tunggu...'

    dispatch('BaseStore/changeLoadingState',{isLoading:isLoading,labelLoading:loadingMessage},{root:true})

    return new Promise((resolve,reject)=>{
        UserHelper.edit(url,input).then(()=>{
            dispatch('BaseStore/changeLoadingState',{isLoading:false,labelLoading:''},{root:true})
            resolve('Kata sandi berhasil di ubah')
        }).catch((error)=>{
            reject(error.response)
        })
    })
}
