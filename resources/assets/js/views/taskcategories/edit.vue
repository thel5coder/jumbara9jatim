<template>
    <div>
        <page-header :page-section="'Ubah'" :page-title="'Bidang'" :active-section="'Ubah'"
                     :breadcrumb-items="breadcrumbItems" :heading-items="headingItems"></page-header>
        <div class="page-container">
            <div class="page-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12" v-if="taskCategory">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <form class="form-horizontal" @submit.prevent="validateForm()">
                                        <fieldset class="content-group">
                                            <legend class="text-bold">Form Ubah Bidang</legend>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Nama Bidang</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="taskCategory.categoryName"
                                                           placeholder="Masukan nama bidang contoh:jumpa,bakti dll" v-validate="'required'"
                                                           name="categoryName">
                                                    <label class="validation-error-label">{{ errors.first('categoryName') }}</label>
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
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexTaskCategory',title:'Kategori Penugasan'}],
                headingItems:[{url:'indexTaskCategory',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        categoryName:{
                            required:'Nama kategori penugasan tidak boleh kosong'
                        }
                    }
                }
            }
        },
        mounted(){
            console.log(this.$route.params.uuid)
            if(this.taskCategories == null){
                this.$store.dispatch('TaskCategoriesStore/read',{id:this.$route.params.uuid,index:null})
            }else{
                let index = this.taskCategories.findIndex(data => data.uuid === this.$route.params.uuid)
                this.$store.dispatch('TaskCategoriesStore/read',{id:this.$route.params.uuid,index:index})
            }
        },
        computed:{
            ...mapGetters('TaskCategoriesStore',{taskCategory:'getTaskCategory',taskCategories:'getTaskCategories'})
        },
        methods:{
            ...mapActions('TaskCategoriesStore',{updateTaskCategory:'edit'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.updateTaskCategory({input:this.taskCategory}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexTaskCategory'})
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