import * as types from '../mutation-types';
import Vue from 'vue'
import InformationHelper from "../../helpers/InformationHelper";

export function browse({dispatch, commit, rootGetters},{url}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data informasi'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    InformationHelper.browse(url).then((response) => {
        dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
        let results = [];
        results = response.data.result
        commit(types.BROWSE, {data: results})
    }).catch((error) => {
        Vue.toasted.error(error.response.data.errorMessage, {duration: 5000})
    })
}

export function read({dispatch, commit, rootGetters}, {id, index}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data informasi'

    if (index == null) {
        let url = 'information/' + id
        dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
        InformationHelper.read(url).then((response) => {
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
    let url = 'information/update'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        InformationHelper.edit(url, input).then(() => {
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
    let url = 'information/create'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        InformationHelper.add(url, input).then((response) => {
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

    let url = 'information/' + id + '/delete'
    return new Promise((resolve, reject) => {
        InformationHelper.delete(url)
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
