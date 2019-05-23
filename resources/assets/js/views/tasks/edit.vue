<template>
    <div>
        <page-header :page-section="'Tambah'" :page-title="'Bidang Kegiatan'" :active-section="'Tambah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12" v-if="task">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Form Tambah Bidang Kegiatan</legend>
                                            <div class="form-group" v-if="taskCategories">
                                                <label class="control-label col-md-3">Nama Bidang</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" v-model="task.taskCategoryUuid" v-validate="'required'" name="taskCategoryUuid">
                                                        <option value="">Pilih Bidang</option>
                                                        <option v-for="taskCategory in taskCategories" :value="taskCategory.uuid">
                                                            {{taskCategory.categoryName}}
                                                        </option>
                                                    </select>
                                                    <label class="validation-error-label">{{ errors.first('taskCategoryUuid') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Nama Bidang Kegiatan</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="task.taskTitle"
                                                           placeholder="Masukkan nama bidang kegiatan" v-validate="'required'"
                                                           name="taskTitle">
                                                    <label class="validation-error-label">{{ errors.first('taskTitle') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Penilaian</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switch">
                                                        <label>
                                                            <input type="checkbox" class="switch" data-on-text="Ya" data-off-text="Tidak" v-model="task.isValuation">
                                                        </label>
                                                    </div>
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
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexTask',title:'Bidang Kegiatan'}],
                headingItems:[{url:'indexTask',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        taskTitle:{
                            required:'Nama bidang kegiatan tidak boleh kosong'
                        },
                        taskCategoryUuid:{
                            required:'Nama bidang tidak boleh kosong'
                        }
                    }
                }
            }
        },
        mounted(){
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html);
            });

            $(".switch").bootstrapSwitch().on('switchChange.bootstrapSwitch',function(event,state){
                app.task.isValuation = state
            })

            this.$store.dispatch('TaskCategoriesStore/browse')

            if(this.tasks == null){
                this.$store.dispatch('TasksStore/read',{id:this.$route.params.uuid,index:null})
            }else{
                let dataIndex = this.tasks.findIndex(data => data.uuid === this.$route.params.uuid)
                this.$store.dispatch('TasksStore/read',{id:this.$route.params.uuid,index:dataIndex})
            }
        },
        computed:{
            ...mapGetters('TaskCategoriesStore',{taskCategories:'getTaskCategories'}),
            ...mapGetters('TasksStore',{tasks:'getTasks',task:'getTask'})
        },
        methods:{
            ...mapActions('TasksStore',{editTask:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.editTask({input:this.task}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexTask'})
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