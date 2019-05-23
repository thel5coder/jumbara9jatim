<template>
    <div>
        <page-header :page-section="'Tambah Level Pengguna'" :page-title="'Level Pengguna'" :active-section="'Tambah'"
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
                                            <legend class="text-bold">Form Tambah Level Pengguna</legend>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Nama Level</label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" v-model="userLevel.levelName"
                                                           placeholder="Masukkan nama level pengguna seperti admin,juri, dll" v-validate="'required'"
                                                           name="levelName">
                                                    <label class="validation-error-label">{{ errors.first('levelName') }}</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Aktif ?</label>
                                                <div class="col-md-5">
                                                    <div class="checkbox checkbox-switchery">
                                                        <label>
                                                            <input type="checkbox" class="switchery" checked="checked" v-model="userLevel.isActive">
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
                breadcrumbItems:[{url:'dashboard',title:'Dashboard'},{url:'indexUserLevel',title:'Level Pengguna'}],
                headingItems:[{url:'indexUserLevel',title:'Kembali',icon:'icon-backward2'}],
                userLevel:{levelName:'',isActive:true},
                dict:{
                    custom:{
                        levelName:{
                            required:'Level pengguna tidak boleh kosong'
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
            ...mapActions('UserLevelStore',{createUserLevel:'add'}),
            validateForm(){
                let validator = this.$validator
                validator.localize('en',this.dict)

                validator.validateAll().then((result)=>{
                    if(result){
                        this.createUserLevel({input:this.userLevel}).then((result)=>{
                            this.$toasted.success(result)
                            this.$router.push({name:'indexUserLevel'})
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