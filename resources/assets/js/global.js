import Vue from 'vue'
import Vuex from 'vuex'
import loading from 'vue-full-loading'
import Select2 from 'v-select2-component'
import {mapActions,mapGetters} from 'vuex'
import { Toast } from 'vuex-toast'
import PageHeader from './components/PageHeader'
import vue2Dropzone from 'vue2-dropzone'
import VueQRCodeComponent from 'vue-qrcode-component'
Vue.use(Vuex)


export const components = {
    loading,
    'select2':Select2,
    Toast,
    'page-header':PageHeader,
    vueDropzone:vue2Dropzone,
    'qr-code':VueQRCodeComponent
}

export const computed = {
    ...mapGetters('BaseStore',{
        labelLoading:'getLoadingMessage',
        isLoadingShow:'getIsLoadingShow'
    })
}

export const methods = {

}