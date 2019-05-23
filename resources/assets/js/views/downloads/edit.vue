<template>
    <div>
        <page-header :page-section="'Ubah Download File'" :page-title="'File Download'" :active-section="'Ubah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12" v-if="download">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Form Ubah File Download</legend>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Judul</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="download.title"
                                                           placeholder="Masukkan judul informasi" v-validate="'required'"
                                                           name="title">
                                                    <label class="validation-error-label">{{ errors.first('title') }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-xs-12">
                                                    <fieldset class="content-group">
                                                        <legend class="text-bold">file Download </legend>
                                                        <vue-dropzone ref="dropzoneFileDownload" id="dropzone" :options="dropzoneFileDownload"
                                                                      v-on:vdropzone-success="dropzoneFileDownloadSuccess"
                                                                      v-on:vdropzone-mounted="dropzoneMounted"></vue-dropzone>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary btn-icon">
                                                    <i class="icon-floppy-disk position-left"></i> Simpan
                                                </button>
                                            </div>

                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <loading
                :show="isLoadingShow"
                :label="labelLoading">
        </loading>
    </div>
</template>

<script>
    import {mapActions,mapGetters} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexDownload',title:'File Download'}],
                headingItems:[{url:'indexDownload',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        title:{
                            required:'Judul tidak boleh kosong'
                        }
                    }
                },
                dropzoneFileDownload: {
                    url: 'http://jumbara9jatim.info/api/download/upload-download-document',
                    thumbnailWidth: 150,
                    paramName: "file",
                    maxFilesize: 5,
                    addRemoveLinks:true,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx",
                    dictDefaultMessage: 'Klik disini untuk unggah',
                    headers:{
                        'Authorization':'Bearer '+this.$auth.token()
                    },
                    renameFile(file){
                       return file.name
                    }
                }
            }
        },
        mounted(){
            if(this.downloads == null){
                this.$store.dispatch('DownloadStore/read',{id:this.$route.params.id,index:null})
            }else{
                this.dataIndex = this.downloads.findIndex(data => data.id === this.$route.params.id)
                this.$store.dispatch('DownloadStore/read',{id:this.$route.params.id,index:this.dataIndex})
            }
        },
        computed:{
            ...mapGetters('DownloadStore',{download:'getDownload'})
        },
        methods:{
            ...mapActions('DownloadStore',{editDownload:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.editDownload({input:this.download}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexDownload'})
                        }).catch((error)=>{
                            if(error.response.data){
                                error.response.data.errorMessage.foreEach((message)=>{
                                    this.$toasted.error(message)
                                })
                            }

                        })
                    }
                })
            },
            dropzoneMounted(){
                let file = {size:123,name:this.download.fileDownload}
                let url = 'http://jumbara9jatim.info/storage/'+this.download.fileDownload
                this.$refs.dropzoneFileDownload.manuallyAddFile(file,url)
            },
            dropzoneFileDownloadSuccess(file,response){
                console.log(file)
                console.log(response.result)
                this.download.fileDownload = response.result
            },
        }
    }
</script>

<style scoped>

</style>