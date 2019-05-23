<template>
    <div>
        <page-header :page-section="'Tambah Jadwal'" :page-title="'Jadwal'" :active-section="'Tambah'"
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
                                            <legend class="text-bold">Tambah Jadwal</legend>

                                            <div class="form-group" v-if="tasks">
                                                <label class="control-label col-md-3">Nama Bidang Kegiatan</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" v-validate="'required'" v-model="schedule.taskUuid" name="taskUuid">
                                                        <option value="">Pilih Bidang Kegiatan</option>
                                                        <option v-for="task in tasks" :value="task.uuid">{{task.taskTitle}}</option>
                                                    </select>
                                                    <label class="validation-error-label">{{ errors.first('taskUuid') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Hari/tanggal & waktu Kegiatan</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control pickadate-selectors"
                                                           placeholder="Masukkan hari/tanggal kegiatan" name="scheduleDate" v-validate="'required'"
                                                           id="scheduleDate" v-model="schedule.scheduleDate">
                                                    <label class="validation-error-label">{{ errors.first('scheduleDate') }}</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control startPickTime"
                                                           placeholder="jam mulai dari" v-model="schedule.scheduleTimeStart">
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="text" class="form-control finishPickTime"
                                                           placeholder="sampai jam" v-model="schedule.scheduleTimeFinish">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">PIC</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="schedule.pic"
                                                           placeholder="Masukkan PIC">
                                                </div>
                                            </div>

                                        </fieldset>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary btn-icon">
                                                <i class="icon-floppy-disk position-left"></i> Simpan
                                            </button>
                                        </div>
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
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexSchedule',title:'Jadwal Kegiatan'}],
                headingItems:[{url:'indexSchedule',title:'Kembali',icon:'icon-backward2'}],
                schedule:{
                    taskUuid:null,
                    scheduleDate:null,
                    scheduleTimeStart:null,
                    scheduleTimeFinish:null,
                    scheduleIntegerStart:null,
                    scheduleIntegerFinish:null,
                    pic:null
                },
                isTask:false,
                dtPickerOptions: {
                    format: 'LT',
                    stepping:1,
                },
                dict:{
                    custom:{
                        taskUuid:{
                            required:'Nama bidang kegiatan tidak boleh kosong'
                        },
                        scheduleDate:{
                            required:'Hari/tanggal kegiatan tidak boleh kosong'
                        },
                        scheduleTimeStart:{
                            required:'Waktu kegiatan tidak boleh kosong'
                        },
                        scheduleTimeFinish:{
                            required:'Waktu kegiatan tidak boleh kosong'
                        }
                    }
                }
            }
        },
        components:{
            datePicker
        },
        computed:{
            ...mapGetters('TasksStore',{tasks:'getTasks'})
        },
        mounted(){
            let app = this;
            this.$store.dispatch('TasksStore/browse',{url:'task'})
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html);
            });

            $('.pickadate-selectors').pickadate({
                selectYears: 10,
                selectMonths: true,
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd',
                monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'December'],
                onClose(){
                    app.schedule.scheduleDate = this.get()
                }
            });

            $('.startPickTime').pickatime({
                interval:1,
                format:'HH:i',
                onClose(){
                    if(app.schedule.scheduleDate != null){
                        let scheduleDate = app.schedule.scheduleDate +' '+this.get()
                        let scheduleTimeInteger = new Date(scheduleDate).getTime()
                        app.schedule.scheduleIntegerStart = scheduleTimeInteger
                        app.schedule.scheduleTimeStart = this.get()
                    }
                }
            });

            $('.finishPickTime').pickatime({
                interval:1,
                format:'HH:i',
                onClose(){
                    if(app.schedule.scheduleDate != null){
                        let scheduleDate = app.schedule.scheduleDate +' '+this.get()
                        let scheduleTimeInteger = new Date(scheduleDate).getTime()
                        app.schedule.scheduleIntegerFinish = scheduleTimeInteger
                        app.schedule.scheduleTimeFinish = this.get()
                    }
                }
            });


            $(".styled").uniform();

        },
        methods:{
            ...mapActions('SchedulesStore',{createSchedule:'add'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.createSchedule({input:this.schedule}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexSchedule'})
                        }).catch((error)=>{
                            console.log(error.response)
                        })
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>