<template>
    <div>
        <section  style="margin-top: 50px; background-color: white;">
            <div class="row">
                <div class="col-md-3" style="background-color: #ecf5e9;">
                    <login-form></login-form>
                    <statistic></statistic>
                </div>
                <div class="col-md-9" style="background-color: white;margin-top: 20px">
                    <legend class="text-bold text-left" style="padding-bottom: 1px;border-bottom: 2px solid #ff0000;">Download</legend>
                    <div class="row" v-if="downloads">
                        <div class="col-md-4" v-for="download in downloads">
                            <div class="panel">
                                <div class="panel-body text-center">
                                    <div class="icon-object border-success text-success">
                                        <i class=" icon-file-download"></i>
                                    </div>
                                    <h5 class="text-bold">{{download.title}}</h5>
                                    <!--<p>Di Download {{download.downloadCounter}}X</p>-->
                                    <a href="#" type="button" class="btn bg-tombol btn-danger btn-rounded legitRipple"
                                       @click.prevent="downloadWIthAxios(download.fileDownload)">
                                        <b>
                                            <i class="icon-download position-left"></i>
                                            Download
                                        </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Login from '../../components/frontend/LoginForm'
    import Statistic from '../../components/frontend/Statistic'
    import {mapGetters,mapActions} from 'vuex'
    export default {
        components:{
            'login-form':Login,
            'statistic':Statistic
        },
        mounted(){
            this.$store.dispatch('DownloadStore/browse',{url:'download-home'})
        },
        computed:{
            ...mapGetters('DownloadStore',{downloads:'getDownloads'})
        },
        methods:{
            ...mapActions('DownloadStore',{updateCounter:'downloadFile'}),
            downloadFile(file,slug){
                this.updateCounter({fileTodownload:file,slug:slug}).then((response)=>{
                    console.log(response.headers[0])
                }).catch((error)=>{
                    if(error.response.data){
                        error.response.data.forEach((message)=>{
                            this.$toasted.error(message)
                        })
                    }
                })
            },
            forceFileDownload(response,file){
                const url = window.URL.createObjectURL(new Blob([response.data]))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', file) //or any other extension
                document.body.appendChild(link)
                link.click()
            },
            downloadWIthAxios(fileName){
                let url = 'http://jumbara9jatim.info/storage/download/'+fileName
                this.$http({
                    method: 'get',
                    url: url,
                    responseType: 'arraybuffer'
                }).then(response => {
                    this.forceFileDownload(response,fileName)
                }).catch(() => console.log('error occured'))
            }
        },

    }
</script>

<style scoped>
    @import 'http://jumbara9jatim.info/css/download.css';
</style>