<template>
    <div>
        <page-header :page-section="'Data Jadwal'" :page-title="'Jadwal Kegiatan'" :active-section="'Jadwal Kegiatan'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <v-client-table v-if="schedules" :data="schedules" :name="stateName" :columns="columns"
                                                    :options="options">
                                        <div slot="actions" class="btn-group" slot-scope="props">
                                            <router-link :to="{name:'editSchedule',params:{uuid:props.row.uuid}}" type="button"
                                                         class="btn btn-warning btn-icon legitRipple">
                                                <i class="icon-pencil3"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-icon btn-danger legitRipple"
                                                    @click="deleteSchedule(props.row.uuid,props.row.taskTitle)">
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
                headingItems:[{url:'createSchedule',title:'Tambah',icon:'icon-plus-circle2'}],
                headersData:['No','Nama Bidang Kegiatan', 'Waktu','PIC','Aksi'],
                columns:['no','taskTitle','scheduleTime','pic','actions'],
                options: {
                    headings: {
                        no: 'No',
                        taskTitle: 'Nama Bidang Kegiatan',
                        scheduleTime:'Waktu',
                        pic:'PIC',
                        actions:'Aksi'
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        },
                        scheduleTime:function (h,row,index) {
                            return row.scheduleDate +', '+ row.scheduleTimeStart +'-'+row.scheduleTimeFinish
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['taskTitle','scheduleTime'],
                    filterable: ['taskTitle','scheduleTime']
                },
                stateName:'ScheduleStores'
            }
        },
        mounted(){
            this.$store.dispatch('SchedulesStore/browse',{url:'/schedule'})
        },
        computed:{
            ...mapGetters('SchedulesStore',{schedules:'getSchedules'})
        },
        methods:{
            ...mapActions('SchedulesStore',{del:'del'}),
            deleteSchedule(id,taskTitle){
                let index = this.schedules.findIndex(data => data.uuid === id)
                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin menghapus jadwal "+taskTitle,
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