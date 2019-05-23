import * as types from '../mutation-types'
import Vue from 'vue'
import SchedulesHelper from "../../helpers/SchedulesHelper"

export function browse({dispatch, commit, rootGetters},{url}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data jadwal'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    SchedulesHelper.browse(url).then((response) => {
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
    let loadingMessage = 'Mengambil data jadwal'

    if (index == null) {
        let url = 'schedule/' + id
        dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
        SchedulesHelper.read(url).then((response) => {
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
    let url = 'schedule/'+input.uuid

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        SchedulesHelper.update(url, input).then(() => {
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
    let url = 'schedule'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        SchedulesHelper.add(url, input).then((response) => {
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

    let url = 'schedule/' + id
    return new Promise((resolve, reject) => {
        SchedulesHelper.remove(url)
            .then((response) => {
                dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})
                commit(types.DELETE, {index: index})

                resolve('Data berhasil di hapus')
            }).catch((error) => {
            dispatch('BaseStore/changeLoadingState', {isLoading: false, labelLoading: ''}, {root: true})

            reject(error.response.data)
        })
    })
}
