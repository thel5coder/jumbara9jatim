<template>
    <div>
        <div class="row">

        </div>
        <div class="row">
            <div class="panel panel-flat" style="border:0px solid #ffffff !important;-webkit-box-shadow: none">
                <div class="panel-heading" style="border:0px solid #ffffff !important;margin-bottom: 0px;padding-bottom: 0px; padding-top: 0px">
                    <legend class="text-bold text-left" style="padding-bottom: 1px;border-bottom: 2px solid #ff0000">
                        Download
                    </legend>
                    <div class="heading-elements" style="margin-top: -10px;">
                        <router-link class="btn btn-link" :to="{name:'download'}">Selengkapnya</router-link>
                    </div>
                </div>

                <div class="col-md-12" v-for="download in downloads">
                    <div class="media">
                        <div class="media-left">
                            <a href="#" class="btn border-info text-indigo btn-flat btn-icon btn-rounded btn-sm legitRipple"
                               @click.prevent="downloadWIthAxios(download.fileDownload)">
                                <i class="icon-file-download2"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <a href="#" @click.prevent="downloadWIthAxios(download.fileDownload)">{{download.title}}</a>
                            </h5>
                            <!--<div class="media-annotation mt-1"><i class="icon-download4"></i> &nbsp; Di unduh {{download.downloadCounter}}</div>-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex'
    export default {
        mounted(){
            this.$store.dispatch('DownloadStore/browse',{url:'download-home'})
        },
        computed:{
            ...mapGetters('DownloadStore',{downloads:'getDownloads'})
        },
        methods:{
            ...mapActions('DownloadStore',{updateCounter:'downloadFile'}),
            downloadFile(file,slug){
                let param ={fileToDownload:file,slug:slug}
                this.updateCounter({fileTodownload:file,slug:slug}).then((response)=>{
                    let responseType = response.headers[0].toString()
                    let type = responseType.split(':')[1]
                    let url = 'http://jumbara9jatim.info/storage/download/'+file

                    this.downloadWIthAxios(url,type)
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
        }
    }
</script>

<style scoped>

</style>