<template>
    <div>
        <page-header :page-section="'Tambah Download File'" :page-title="'File Download'" :active-section="'Tambah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Form Tambah File Download</legend>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Judul</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="download.title"
                                                           placeholder="Masukkan judul informasi" v-validate="'required'"
                                                           name="title">
                                                    <label class="validation-error-label">{{ errors.first('title') }}</label>
                                                </div>
                                            </div>
                                            <fieldset class="content-group">
                                                <legend class="text-bold">file Download </legend>
                                                <vue-dropzone ref="dropzoneFileDownload" id="dropzone" :options="dropzoneFileDownload"
                                                              v-on:vdropzone-file-added="dropzoneFileDownloadFileAdded"></vue-dropzone>
                                            </fieldset>

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
    import {mapActions} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexDownload',title:'File Download'}],
                headingItems:[{url:'indexDownload',title:'Kembali',icon:'icon-backward2'}],
                download:{title:'',fileDownload:''},
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
                    maxFilesize: 10,
                    addRemoveLinks:true,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx",
                    dictDefaultMessage: 'Klik disini untuk unggah',
                    headers:{
                        'Authorization':'Bearer '+this.$auth.token()
                    },
                    timeout:100000
                }
            }
        },
        methods:{
            ...mapActions('DownloadStore',{createDownload:'add'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.createDownload({input:this.download}).then((result)=>{
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
            dropzoneFileDownloadFileAdded(file){
                this.download.fileDownload = file.upload.filename

            }
        }
    }
</script>

<style scoped>

</style>