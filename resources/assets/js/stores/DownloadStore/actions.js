import * as types from '../mutation-types';
import Vue from 'vue'
import DownloadHelper from "../../helpers/DownloadHelper";

export function browse({dispatch, commit, rootGetters},{url}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data download'


    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    DownloadHelper.browse(url).then((response) => {
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
    let loadingMessage = 'Mengambil data download'

    if (index == null) {
        let url = 'download/' + id
        dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
        DownloadHelper.read(url).then((response) => {
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
    let url = 'download/update'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        DownloadHelper.edit(url, input).then(() => {
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
    let url = 'download/create'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        DownloadHelper.add(url, input).then((response) => {
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

    let url = 'download/' + id + '/delete'
    return new Promise((resolve, reject) => {
        DownloadHelper.delete(url)
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

export function downloadFile({dispatch, commit, rootGetters}, {fileTodownload,slug}) {
    let isLoading = true
    let loadingMessage = 'Sedang mendownload data'
    let url = 'download-file/'+slug+'/'+fileTodownload

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        DownloadHelper.browse(url).then((response) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            resolve(response)
        }).catch((error) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
            reject(error)
        })
    })
}
