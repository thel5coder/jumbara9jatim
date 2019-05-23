<template>
    <div>
        <page-header :page-section="'Data Download Web'" :page-title="'File Download'" :active-section="'File Download'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="downloads" :data="downloads" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editDownload',params:{id:props.row.id}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteDownload(props.row.id,props.row.title)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </div>
                                    </v-client-table>
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
    import {mapGetters,mapActions} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'}],
                headingItems:[{url:'createDownload',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','Judul','Di download','Aksi'],
                columns:['no','title','downloadCounter','actions'],
                options: {
                    headings: {
                        no: 'No',
                        title: 'Judul',
                        downloadCounter:'Di download',
                        actions:'Aksi'
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['title','downloadCounter'],
                    filterable: ['title']
                },
                stateName:'DownloadStore'
            }
        },
        mounted(){
            this.$store.dispatch('DownloadStore/browse',{url:'download'})
        },
        computed:{
            ...mapGetters('DownloadStore',{downloads:'getDownloads'})
        },
        methods:{
            ...mapActions('DownloadStore',{del:'del'}),
            deleteDownload(id,title){
                let index = this.downloads.findIndex(data => data.id === id)

                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus file download "+title,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if(result.value){
                        this.del({id:id,index:index}).then((result)=>{
                            this.$toasted.success(result)
                        }).catch((error)=>{
                            error.response.data.errorMessage.forEach((message)=>{
                                this.$toasted.error(message)
                            })
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>