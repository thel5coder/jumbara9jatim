import {BaseHelper} from "./index";
import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:8000/api'

class ParticipantHelper extends BaseHelper{
    deleteDocument(url,param){
        return axios.post(url,param)
    }
}

export default new ParticipantHelper();