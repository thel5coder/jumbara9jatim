<template>
    <div>
        <page-header :page-section="'Tambah Informasi'" :page-title="'Informasi'" :active-section="'Tambah'"
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
                                            <legend class="text-bold">Form Tambah Informasi</legend>

                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Judul</label>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" v-model="information.title"
                                                                   placeholder="Masukkan judul informasi" v-validate="'required'"
                                                                   name="title">
                                                            <label class="validation-error-label">{{ errors.first('title') }}</label>
                                                        </div>
                                                    </div>
                                                    <editor api-key="ylbajoqaxen6zb21iuagarlrbbbs81668h53wccti9okccc9"
                                                            v-model="information.content"
                                                            :init="tinyMceInit"></editor>
                                                </div>
                                                <div class="col-md-3">
                                                    <fieldset class="content-group">
                                                        <legend class="text-bold">Featured Image </legend>
                                                        <vue-dropzone ref="dropzoneFeaturedImage" id="dropzone" :options="dropzoneFeaturedImage"
                                                                      v-on:vdropzone-file-added="dropzoneFeaturedImageFileAdded"></vue-dropzone>
                                                    </fieldset>

                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary btn-icon">
                                                            <i class="icon-floppy-disk position-left"></i> Simpan
                                                        </button>
                                                    </div>
                                                </div>
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
    import Editor from '@tinymce/tinymce-vue';
    import {mapActions} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexInformation',title:'Informasi'}],
                headingItems:[{url:'indexInformation',title:'Kembali',icon:'icon-backward2'}],
                information:{title:'',content:'',featuredImage:''},
                dict:{
                    custom:{
                        title:{
                            required:'Judul tidak boleh kosong'
                        },
                        content:{
                            required:'Isi konten tidak boleh kosong'
                        }
                    }
                },
                dropzoneFeaturedImage: {
                    url: 'http://jumbara9jatim.info/api/information/upload-image',
                    thumbnailWidth: 150,
                    paramName: "file",
                    maxFilesize: 1,
                    addRemoveLinks:true,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    dictDefaultMessage: 'Klik disini untuk unggah',
                    headers:{
                        'Authorization':'Bearer '+this.$auth.token()
                    },
                    renameFile(file){
                        let fileType = file.type
                        let extension = fileType.toString().split('/')
                        let uniqe = new Date()
                        return 'f'+uniqe.getTime()+'.'+extension[1]
                    }
                },
                tinyMceInit:{
                    plugins:'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste tinymcespellchecker',
                    toolbar:'a11ycheck casechange checklist code formatpainter insertfile pageembed permanentpen',
                    images_upload_handler: this.uploadImageTinyMceHandler,
                    tinydrive_token_provider: 'auth/refresh'
                }
            }
        },
        components:{
            'editor':Editor
        },
        methods:{
            ...mapActions('InformationStore',{createInformation:'add'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.createInformation({input:this.information}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexInformation'})
                        }).catch((error)=>{
                            console.log(error.response.data)

                        })
                    }
                })
            },
            dropzoneFeaturedImageFileAdded(file){
                this.information.featuredImage = file.upload.filename
                console.log(this.information.featuredImage)
            },
            uploadImageTinyMceHandler(blobInfo,success,failure){
                let formData;

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                this.$http.post('information/upload-image',formData).then((result)=>{

                }).catch((error)=>{
                    console.log(error.response)
                })
            }
        }
    }
</script>

<style scoped>

</style>