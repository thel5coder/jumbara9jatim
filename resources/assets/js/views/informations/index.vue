<template>
    <div>
        <page-header :page-section="'Data Informasi Web'" :page-title="'Informasi'" :active-section="'Informasi'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="informations" :data="informations" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editInformation',params:{id:props.row.id}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteInformation(props.row.id,props.row.title)">
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
                headingItems:[{url:'createInformation',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','Judul','Dilihat','Aksi'],
                columns:['no','title','viewCounter','actions'],
                options: {
                    headings: {
                        no: 'No',
                        title: 'Judul',
                        viewCounter:'Dilihat',
                        actions:'Aksi'
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['title','viewCounter'],
                    filterable: ['title']
                },
                stateName:'InformationStore'
            }
        },
        mounted(){
            this.$store.dispatch('InformationStore/browse',{url:'information'})
        },
        computed:{
            ...mapGetters('InformationStore',{informations:'getInformations'})
        },
        methods:{
            ...mapActions('InformationStore',{del:'del'}),
            deleteInformation(id,title){
                let index = this.informations.findIndex(data => data.id === id)

                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data informasi "+title,
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