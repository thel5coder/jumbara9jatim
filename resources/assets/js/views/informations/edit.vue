<template>
    <div>
        <page-header :page-section="'Ubah Informasi'" :page-title="'Informasi'" :active-section="'Ubah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12" v-if="information">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Form Ubah Informasi</legend>

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
                                                                      v-on:vdropzone-success="dropzoneFeaturedImageSuccess"
                                                                      v-on:vdropzone-mounted="dropzoneFeaturedImageMounted"></vue-dropzone>
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
    import {mapActions,mapGetters} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexInformation',title:'Informasi'}],
                headingItems:[{url:'indexInformation',title:'Kembali',icon:'icon-backward2'}],
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
        mounted(){
            if(this.informations == null){
                this.$store.dispatch('InformationStore/read',{id:this.$route.params.id,index:null})
            }else{
                this.dataIndex = this.informations.findIndex(data => data.id === this.$route.params.id)
                this.$store.dispatch('InformationStore/read',{id:this.$route.params.id,index:this.dataIndex})
            }
        },
        computed:{
            ...mapGetters('InformationStore',{information:'getInformation'})
        },
        methods:{
            ...mapActions('InformationStore',{updateInformation:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.updateInformation({input:this.information}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexInformation'})
                        }).catch((error)=>{
                            if(error){
                                error.response.data.errorMessage.forEach((message)=>{
                                    this.$toasted.error(message)
                                })
                            }

                        })
                    }
                })
            },
            dropzoneFeaturedImageMounted(){
                let file = {size:123,name:this.information.featuredImage}
                console.log(this.information.featuredImage)
                let url = 'http://jumbara9jatim.info/storage/resized/'+this.information.featuredImage
                this.$refs.dropzoneFeaturedImage.manuallyAddFile(file,url)
            },
            dropzoneFeaturedImageSuccess(file,response){
                this.information.featuredImage = response.result
            },
            uploadImageTinyMceHandler(blobInfo,success,failure){
                let formData;

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                this.$store.dispatch('BaseStore/changeLoadingState',{isLoading:true,loadingMessage:'Meng-unggah gambar'})

                this.$http.post('information/upload-image',formData).then((result)=>{
                    this.$store.dispatch('BaseStore/changeLoadingState',{isLoading:false,loadingMessage:''})
                }).catch((error)=>{
                    console.log(error.response)
                })
            }
        }
    }
</script>

<style scoped>

</style>