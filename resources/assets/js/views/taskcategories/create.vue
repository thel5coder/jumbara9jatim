<template>
    <div>
        <page-header :page-section="'Tambah'" :page-title="'Bidang'" :active-section="'Tambah'"
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
                                            <legend class="text-bold">Form Bidang</legend>

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
    import {mapActions} from 'vuex'
    export default {
        data(){
            return {
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexTaskCategory',title:'Kategori Penugasan'}],
                headingItems:[{url:'indexTaskCategory',title:'Kembali',icon:'icon-backward2'}],
                taskCategory:{categoryName:''},
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
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html);
            });
        },
        methods:{
            ...mapActions('TaskCategoriesStore',{createTaskCategory:'add'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.createTaskCategory({input:this.taskCategory}).then((result)=>{
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