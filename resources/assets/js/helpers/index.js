import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:8000/api'
export class BaseHelper {
    browse(url){
        return axios.get(url)
    }

    read(url){
        return axios.get(url)
    }

    edit(url,param){
        return axios.post(url,param)
    }

    add(url,param){
        return axios.post(url,param)
    }

    delete(url){
        return axios.post(url)
    }

    update(url,param){
        return axios.put(url,param);
    }

    remove(url){
        return axios.delete(url)
    }
}