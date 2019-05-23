<template>
    <div>
        <page-header :page-section="'Data Bidang'" :page-title="'Bidang'" :active-section="'Bidang'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="taskCategories" :data="taskCategories" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editTaskCategory',params:{uuid:props.row.uuid}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteTaskCategory(props.row.uuid,props.row.categoryName)">
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
                headingItems:[{url:'createTaskCategory',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','Bidang','Aksi'],
                columns:['no','categoryName','actions'],
                options: {
                    headings: {
                        no: 'No',
                        categoryName: 'Bidang',
                        actions:'Aksi'
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['categoryName'],
                    filterable: ['categoryName']
                },
                stateName:'TaskCategoriesStore'
            }
        },
        mounted(){
            this.$store.dispatch('TaskCategoriesStore/browse')
            console.log(new Date('2019-06-05 12:00:00'))
        },
        computed:{
            ...mapGetters('TaskCategoriesStore',{taskCategories:'getTaskCategories'})
        },
        methods:{
            ...mapActions('TaskCategoriesStore',{del:'del'}),
            deleteTaskCategory(id,categoryName){
                let index = this.taskCategories.findIndex(data => data.uuid === id)
                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data kategori tugas "+categoryName,
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