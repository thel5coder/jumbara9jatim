import * as types from '../mutation-types'
import Vue from 'vue'
import UserLevelHelper from "../../helpers/UserLevelHelper"

export function browse({dispatch, commit, rootGetters}) {
    let isLoading = true
    let loadingMessage = 'Mengambil data level pengguna'
    let url = 'user-level'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    UserLevelHelper.browse(url).then((response) => {
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
    let loadingMessage = 'Mengambil data level pengguna'

    if (index == null) {
        let url = 'user-level/' + id
        dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
        UserLevelHelper.read(url).then((response) => {
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
    let url = 'user-level/update'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        UserLevelHelper.edit(url, input).then(() => {
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
    let url = 'user-level/create'

    dispatch('BaseStore/changeLoadingState', {isLoading: isLoading, labelLoading: loadingMessage}, {root: true})
    return new Promise((resolve, reject) => {
        UserLevelHelper.add(url, input).then((response) => {
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

    let url = 'user-level/' + id + '/delete'
    return new Promise((resolve, reject) => {
        UserLevelHelper.delete(url)
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
