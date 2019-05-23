<template>
    <div>
        <page-header :page-section="'Tambah Kontingen'" :page-title="'Kontingen'" :active-section="'Tambah'"
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
                                            <legend class="text-bold">Form Tambah Kontingen</legend>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">ID Kontingen</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" v-model="contingent.contingentId"
                                                           placeholder="Masukkan id kontingen, contoh 1,2" v-validate="'required'"
                                                           name="contingentId" ref="contingentId" v-focus>
                                                    <label class="validation-error-label">{{ errors.first('contingentId') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Kontingen</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="contingent.contingentName"
                                                           placeholder="Masukkan kontingen..." v-validate="'required'" name="contingentName">
                                                    <label class="validation-error-label">{{ errors.first('contingentName') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Aktif ?</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switchery">
                                                        <label>
                                                            <input type="checkbox" class="switchery" checked="checked" v-model="contingent.isActive">
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
    import {mapActions} from 'vuex'
    export default {
        data(){
            return {
                contingent:{contingentName:'',contingentId:'',isActive:true},
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexContingent',title:'Kontingen'}],
                headingItems:[{url:'indexContingent',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        contingentId:{
                            required:'Id kontingen tidak boleh kosong'
                        },
                        contingentName:{
                            required:'Nama kontingen tidak boleh kosong'
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
            ...mapActions('ContingentStore',{createContingent:'add'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        let response = this.createContingent({input:this.contingent})
                        response.then((result)=>{
                                if(result === true){
                                   this.contingent = {contingentName:'',contingentId:'',isActive:true}
                                   this.$refs.contingentId.focus()
                                }
                            })

                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>