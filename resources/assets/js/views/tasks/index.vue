<template>
    <div>
        <page-header :page-section="'Data Bidang Kegiatan'" :page-title="'Bidang Kegiatan'" :active-section="'Bidang Kegiatan'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="tasks" :data="tasks" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editTask',params:{uuid:props.row.uuid}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteTask(props.row.uuid,props.row.taskTitle)">
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
                headingItems:[{url:'createTask',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','Nama Bidang, Nama Bidang Kegiatan','Aksi'],
                columns:['no','categoryName','taskTitle','isValuation','actions'],
                options: {
                    headings: {
                        no: 'No',
                        categoryName: 'Nama Bidang',
                        taskTitle:'Nama Bidang Kegiatan',
                        isValuation:'Penilaian',
                        actions:'Aksi'
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        },
                        isValuation:function (h,row,index) {
                            if(row.isValuation == 1){
                                return 'Ya'
                            }else{
                                return 'Tidak'
                            }
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['categoryName','taskTitle'],
                    filterable: ['categoryName','taskTitle']
                },
                stateName:'TasksStore'
            }
        },
        mounted(){
            this.$store.dispatch('TasksStore/browse',{url:'task'})
        },
        computed:{
            ...mapGetters('TasksStore',{tasks:'getTasks'})
        },
        methods:{
            ...mapActions('TasksStore',{del:'del'}),
            deleteTask(id,taskTitle){
                let index = this.tasks.findIndex(data => data.uuid === id)
                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus data bidang kegiatan "+taskTitle,
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