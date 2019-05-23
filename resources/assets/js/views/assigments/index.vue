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
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <v-client-table v-if="participantTasks" :data="participantTasks" :name="stateName" :columns="columns"
                                                            :options="options" ref="participantTaskTable">

                                                <select slot="assigment1" class="form-control" slot-scope="props" v-model="props.row.assigments.assigment1"
                                                        disabled>
                                                    <option value="">Pilih</option>
                                                    <option v-for="schedule in schedules" :value="schedule.taskUuid">{{schedule.taskTitle}}</option>
                                                </select>

                                                <select slot="assigment2" class="form-control" slot-scope="props" v-model="props.row.assigments.assigment2" disabled>
                                                    <option value="">Pilih</option>
                                                    <option v-for="schedule in schedules" :value="schedule.taskUuid">{{schedule.taskTitle}}</option>
                                                </select>

                                                <select slot="assigment3" class="form-control" slot-scope="props" v-model="props.row.assigments.assigment3"
                                                        @change="addParticipantTask(props.row)">
                                                    <option value="">Pilih</option>
                                                    <option v-for="task in tasks" :value="task.taskUuid">{{task.taskTitle}}</option>
                                                </select>

                                                <select slot="assigment4" class="form-control" slot-scope="props" v-model="props.row.assigments.assigment4"
                                                        @change="addParticipantTask(props.row.participantId,props.row.assigments.assigment4)">
                                                    <option value="">Pilih</option>
                                                    <option v-for="task in tasks" :value="task.taskUuid">{{task.taskTitle}}</option>
                                                </select>

                                                <select slot="assigment5" class="form-control" slot-scope="props" v-model="props.row.assigments.assigment5"
                                                        @change="addParticipantTask(props.row.participantId,props.row.assigments.assigment5)">
                                                    <option value="">Pilih</option>
                                                    <option v-for="task in tasks" :value="task.taskUuid">{{task.taskTitle}}</option>
                                                </select>

                                                <select slot="assigment6" class="form-control" slot-scope="props" v-model="props.row.assigments.assigment6"
                                                        @change="addParticipantTask(props.row.participantId,props.row.assigments.assigment6)">
                                                    <option value="">Pilih</option>
                                                    <option v-for="task in tasks" :value="task.taskUuid">{{task.taskTitle}}</option>
                                                </select>

                                                <select slot="assigment7" class="form-control" slot-scope="props" v-model="props.row.assigments.assigment7"
                                                        @change="addParticipantTask(props.row.participantId,props.row.assigments.assigment7)">
                                                    <option value="">Pilih</option>
                                                    <option v-for="task in tasks" :value="task.taskUuid">{{task.taskTitle}}</option>
                                                </select>
                                            </v-client-table>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-primary btn-icon legitRipple" @click="createAssigment">Simpan</button>
                                        </div>
                                    </div>

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
                assigment2:'8a494b8e-4181-4b8d-ada8-2fb5b2cbd2b0',
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'}],
                headingItems:[{url:'createSchedule',title:'Kunci Penugasan',icon:'icon-lock5'}],
                headersData:['No','ID Tanda Pengenal', 'Nama','Jabatan','Penugasan 1','Penugasan 2','Penugasan 3','Penugasan 4','Penugasan 5','Penugasan 6','Penugasan 7'],
                assigments:{contingentId:this.$auth.user().contingent_id,participantTasks:[]},
                columns:[
                    'no',
                    'participantId',
                    'fullName',
                    'positionName',
                    'assigment1',
                    'assigment2',
                    'assigment3',
                    'assigment4',
                    'assigment5',
                    'assigment6',
                    'assigment7'
                ],
                options: {
                    headings: {
                        no: 'No',
                        participantId: 'ID Tanda Pengenal',
                        fullName:'Nama',
                        positionName:'Jabatan',
                        assigment1:'Penugasan 1',
                        assigment2:'Penugasan 2',
                        assigment3:'Penugasan 3',
                        assigment4:'Penugasan 4',
                        assigment5:'Penugasan 5',
                        assigment6:'Penugasan 6',
                        assigment7:'Penugasan 7',
                    },
                    templates:{
                        no:function (h,row,index) {
                            return index
                        },
                        assigment1:function (h,row,index) {
                            return row.assigments.assigment1
                        },
                        assigment2:function (h,row,index) {
                            return row.assigments.assigment2
                        }
                    },
                    useVuex:true,
                    theme:'bootstrap3',
                    sortable: ['fullName'],
                    filterable: ['mis','fullName'],
                    perPageValues:[],
                    perPage:200,
                    pagination:{
                        dropdown:false
                    }
                },
                stateName:'ParticipantTasksStore'
            }
        },
        mounted(){
            var url ='';

            this.$store.dispatch('ParticipantTasksStore/browse',{url:'/participant-task/'+this.$auth.user().contingent_id})
            this.$store.dispatch('SchedulesStore/browse',{url:'/schedule-valuation/all'})
            this.$store.dispatch('TasksStore/browse',{url:'task-non-masal'})
        },
        computed:{
            ...mapGetters('ParticipantTasksStore',{participantTasks:'getParticipantTasks'}),
            ...mapGetters('SchedulesStore',{schedules:'getSchedules'}),
            ...mapGetters('TasksStore',{tasks:'getTasks'})
        },
        methods:{
            ...mapActions('ParticipantTasksStore',{createParticipantTask:'add',editParticipantTask:'edit'}),
            createAssigment(){
                this.$swal({
                    title: "Konfirmasi",
                    text: "Apakah anda yakin ingin menyimpan penugasan peserta jumbara",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if(result.value){
                        this.createParticipantTask({input:this.participantTasks}).then((result)=>{
                            this.$refs.participantTaskTable.refresh();
                        }).catch((error)=>{
                            error.response.data.errorMessage.forEach((message)=>{
                                this.$toasted.error(message)
                            })
                        })
                    }
                })
            },
            addParticipantTask(input){
                let index = this.participantTasks.findIndex(items => items.participantId === input.participantId)
                //
                this.editParticipantTask({index:index,input:input})
                console.log(index)
                console.log(input)
                console.log(this.participantTasks)
            }
        }
    }
</script>

<style scoped>

</style>