<template>
    <div>
        <page-header :page-section="'Tambah Jabatan'" :page-title="'Jabatan'" :active-section="'Tambah'"
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
                                            <legend class="text-bold">Form Tambah Jabatan</legend>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">ID Jabatan</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" v-model="position.positionId"
                                                           placeholder="Masukkan id jabatan, contoh 1,2" v-validate="'required'"
                                                           name="positionId" ref="positionId" v-focus>
                                                    <label class="validation-error-label">{{ errors.first('positionId') }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Jabatan</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="position.positionName"
                                                           placeholder="Masukkan jabatan..." v-validate="'required'" name="positionName">
                                                    <label class="validation-error-label">{{ errors.first('positionName') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Aktif ?</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switchery">
                                                        <label>
                                                            <input type="checkbox" class="switchery" checked="checked" v-model="position.isActive">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary btn-icon"><i class="icon-floppy-disk position-left"></i> Simpan</button>
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
                position:{positionName:'',positionId:'',isActive:true},
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexPosition',title:'Jabatan'}],
                headingItems:[{url:'indexPosition',title:'Kembali',icon:'icon-backward2'}],
                dict:{
                    custom:{
                        positionId:{
                            required:'Id Jabatan tidak boleh kosong'
                        },
                        positionName:{
                            required:'Nama jabatan tidak boleh kosong'
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
            ...mapActions('PositionStore',{createPosition:'add'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        let response = this.createPosition({input:this.position})
                        response.then((result)=>{
                                if(result === true){
                                   this.position = {positionId:'',positionName:'',isActive:true}
                                   this.$refs.positionId.focus()
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